<?php
/**
 * Copyright (c) 2009-2026 Arte e Informatica di Loris Modena e C. s.a.s.
 *
 * @author    Tecnoacquisti.com <helpdesk@tecnoacquisti.com>
 * @copyright 2009-2026 Arte e Informatica di Loris Modena e C. s.a.s.
 * @license   https://opensource.org/license/mit MIT License
 * @version   1.0.9
 *
 * See LICENSE.md for the complete license text.
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

class Rucingedimpactcode extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'rucingedimpactcode';
        $this->tab = 'front_office_features';
        $this->version = '1.0.9';
        $this->author = 'Tecnoacquisti.com';
        $this->need_instance = 0;

        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Reduce the impact of third-party code');
        $this->description = $this->l('Efficiently loading third-party JavaScript, Google Font e JQuery ');

        $this->ps_versions_compliancy = ['min' => '1.7', 'max' => _PS_VERSION_];
    }

    public function install()
    {
        Configuration::updateValue('RUCINGEDIMPACTCODE_GOOGLEFONT', 1);
        Configuration::updateValue('RUCINGEDIMPACTCODE_GA', 0);
        Configuration::updateValue('RUCINGEDIMPACTCODE_GTM', 0);
        Configuration::updateValue('RUCINGEDIMPACTCODE_JQUERY', 0);
        Configuration::updateValue('RUCINGEDIMPACTCODE_JQUERY_VERSION', '3.7.1');
        Configuration::updateValue('RUCINGEDIMPACTCODE_DIRECTIVES', '');
        Configuration::updateValue('RUCINGEDIMPACTCODE_POSITION', 0);


        return parent::install() &&
            $this->registerHook('displayReduceImpact') &&
            $this->registerHook('displayAfterTitleTag') &&
            $this->registerHook('displayHeader');
    }

    public function uninstall()
    {
        Configuration::deleteByName('RUCINGEDIMPACTCODE_GOOGLEFONT');
        Configuration::deleteByName('RUCINGEDIMPACTCODE_GA');
        Configuration::deleteByName('RUCINGEDIMPACTCODE_GTM');
        Configuration::deleteByName('RUCINGEDIMPACTCODE_JQUERY');
        Configuration::deleteByName('RUCINGEDIMPACTCODE_JQUERY_VERSION');
        Configuration::deleteByName('RUCINGEDIMPACTCODE_DIRECTIVES');
        Configuration::deleteByName('RUCINGEDIMPACTCODE_POSITION');
        return parent::uninstall();
    }

    /**
     * Load the configuration form
     */
    public function getContent()
    {
        $output = '';
        if (((bool)Tools::isSubmit('submitRucingedimpactcodeModule')) == true) {
            $output .= $this->postProcess();
        }

        $this->context->smarty->assign('module_dir', $this->_path);

        $output .= $this->context->smarty->fetch($this->local_path . 'views/templates/admin/configure.tpl');
        $output .= $this->renderForm();
        $output .= $this->context->smarty->fetch($this->local_path . 'views/templates/admin/copyright.tpl');

        return $output;
    }

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitRucingedimpactcodeModule';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = [
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        ];

        return $helper->generateForm([$this->getConfigForm()]);
    }

    /**
     * Create the structure of your form.
     */
    protected function getConfigForm()
    {
        return [
            'form' => [
                'legend' => [
                'title' => $this->l('Settings'),
                'icon' => 'icon-cogs',
                ],
                'input' => [
                    [
                        'type' => 'switch',
                        'label' => $this->l('Google Font'),
                        'name' => 'RUCINGEDIMPACTCODE_GOOGLEFONT',
                        'is_bool' => true,
                        'desc' => $this->l('dns-prefetch and preconnect Google Font'),
                        'values' => [
                            [
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Enabled')
                            ],
                            [
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('Disabled')
                            ]
                        ],
                    ],
                    [
                        'type' => 'switch',
                        'label' => $this->l('Google Analytics'),
                        'name' => 'RUCINGEDIMPACTCODE_GA',
                        'is_bool' => true,
                        'desc' => $this->l('dns-prefetch and preconnect Google Analytics'),
                        'values' => [
                            [
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Enabled')
                            ],
                            [
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('Disabled')
                            ]
                        ],
                    ],
                    [
                        'type' => 'switch',
                        'label' => $this->l('Google GTM'),
                        'name' => 'RUCINGEDIMPACTCODE_GTM',
                        'is_bool' => true,
                        'desc' => $this->l('dns-prefetch Google Tag Manager'),
                        'values' => [
                            [
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Enabled')
                            ],
                            [
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('Disabled')
                            ]
                        ],
                    ],
                    [
                        'type' => 'select',
                        'label' => $this->l('Load jQuery'),
                        'name' => 'RUCINGEDIMPACTCODE_JQUERY',
                        'desc' => $this->l('Select your preferred method for loading jQuery library'),
                        'options' => [
                            'query' => [
                                ['id' => '0', 'name' => $this->l("Disable")],
                                ['id' => '1', 'name' => $this->l('Load jQuery from local server')],
                                ['id' => '2', 'name' => $this->l("Load jQuery via Google CDN")],
                                ['id' => '3', 'name' => $this->l('Load jQuery via official jQuery CDN')],
                                ['id' => '4', 'name' => $this->l("Load jQuery via CDNJS CDN")],
                                ['id' => '5', 'name' => $this->l("Load jQuery via jsDelivr CDN")],
                            ],
                            'id' => 'id',
                            'name' => 'name'
                        ]
                    ],
                    [
                        'type' => 'select',
                        'label' => $this->l('jQuery version'),
                        'name' => 'RUCINGEDIMPACTCODE_JQUERY_VERSION',
                        'desc' => $this->l('Default: 3.7.1. Test theme and plugin compatibility before selecting 4.0.0. Google CDN mode uses the official jQuery CDN for 4.0.0.'),
                        'options' => [
                            'query' => [
                                ['id' => '3.7.1', 'name' => '3.7.1'],
                                ['id' => '4.0.0', 'name' => '4.0.0'],
                            ],
                            'id' => 'id',
                            'name' => 'name',
                        ],
                    ],
                    [
                        'type' => 'textarea',
                        'cols' => 40,
                        'rows' => 20,
                        'desc' => $this->l('Additional directives to place in head page'),
                        'name' => 'RUCINGEDIMPACTCODE_DIRECTIVES',
                        'label' => $this->l('Custom Directives'),
                    ],
                    [
                        'type' => 'select',
                        'label' => $this->l('Code Position'),
                        'name' => 'RUCINGEDIMPACTCODE_POSITION',
                        'desc' => $this->l('Code location, displayHeader is compatible with all PS 1.7 versions. The displayAfterTitleTag position is optimal for jQuery, but present only in the latest versions of PrestaShop and not in all templates.'),
                        'options' => [
                            'query' => [
                                ['id' => '0', 'name' => $this->l("Display Header (default)")],
                                ['id' => '1', 'name' => $this->l("Display After Title Tag")],
                                ['id' => '2', 'name' => $this->l("Customized hook Product")],
                            ],
                            'id' => 'id',
                            'name' => 'name'
                        ]
                    ],
                ],
                'submit' => [
                    'title' => $this->l('Save'),
                ],
            ],
        ];
    }

    /**
     * Set values for the inputs.
     */
    protected function getConfigFormValues()
    {
        $values = [
            'RUCINGEDIMPACTCODE_GOOGLEFONT' => Tools::getValue('RUCINGEDIMPACTCODE_GOOGLEFONT', Configuration::get('RUCINGEDIMPACTCODE_GOOGLEFONT')),
            'RUCINGEDIMPACTCODE_JQUERY' => Tools::getValue('RUCINGEDIMPACTCODE_JQUERY', Configuration::get('RUCINGEDIMPACTCODE_JQUERY')),
            'RUCINGEDIMPACTCODE_JQUERY_VERSION' => Tools::getValue('RUCINGEDIMPACTCODE_JQUERY_VERSION', $this->getJqueryVersion()),
            'RUCINGEDIMPACTCODE_DIRECTIVES' => Tools::getValue('RUCINGEDIMPACTCODE_DIRECTIVES', Configuration::get('RUCINGEDIMPACTCODE_DIRECTIVES')),
            'RUCINGEDIMPACTCODE_GA' => Tools::getValue('RUCINGEDIMPACTCODE_GA', Configuration::get('RUCINGEDIMPACTCODE_GA')),
            'RUCINGEDIMPACTCODE_GTM' => Tools::getValue('RUCINGEDIMPACTCODE_GTM', Configuration::get('RUCINGEDIMPACTCODE_GTM')),
            'RUCINGEDIMPACTCODE_POSITION' => Tools::getValue('RUCINGEDIMPACTCODE_POSITION', Configuration::get('RUCINGEDIMPACTCODE_POSITION')),

        ];

        foreach (['RUCINGEDIMPACTCODE_GOOGLEFONT', 'RUCINGEDIMPACTCODE_GA', 'RUCINGEDIMPACTCODE_GTM'] as $key) {
            if ($values[$key] === '') {
                $values[$key] = 0;
            }
        }

        return $values;
    }

    /**
     * Validate form choices before saving and report failed configuration writes.
     */
    protected function postProcess()
    {
        $form_values = $this->getConfigFormValues();
        $form = $this->getConfigForm();

        foreach ($form['form']['input'] as $input) {
            if (!in_array($input['type'], ['switch', 'select'], true)) {
                continue;
            }

            $isVersion = $input['name'] === 'RUCINGEDIMPACTCODE_JQUERY_VERSION';
            $value = Tools::getValue($input['name'], $isVersion ? $form_values[$input['name']] : null);

            if ($input['type'] === 'switch') {
                // Older forms submitted an empty string for the disabled state.
                if ($value === '' || is_bool($value)) {
                    $value = (int) $value;
                }

                $allowedValues = array_column($input['values'], 'value');
            } else {
                $allowedValues = array_column($input['options']['query'], $input['options']['id']);
            }

            $isValid = (is_string($value) || is_int($value))
                && in_array((string) $value, array_map('strval', $allowedValues), true);

            if ($isValid && !$isVersion) {
                $isValid = $input['type'] === 'switch' ? Validate::isBool($value) : Validate::isUnsignedInt($value);
            }

            if (!$isValid) {
                return $this->displayError(sprintf($this->l('Please select a valid value for "%s".'), $input['label']));
            }

            $form_values[$input['name']] = $isVersion ? (string) $value : (int) $value;
        }

        $hasErrors = false;

        foreach ($form_values as $key => $value) {
            $saved = Configuration::updateValue(
                $key,
                $key === 'RUCINGEDIMPACTCODE_DIRECTIVES' ? Tools::getValue($key) : $value,
                $key === 'RUCINGEDIMPACTCODE_DIRECTIVES'
            );

            if (!$saved) {
                $hasErrors = true;
            }
        }

        if ($hasErrors) {
            return $this->displayError($this->l('Some settings could not be saved. Please try again.'));
        }

        return $this->displayConfirmation($this->l('Settings updated'));
    }

    /**
     * Return the supported full jQuery builds and their verified SRI hashes.
     *
     * @return array Version-specific local files and CDN integrity values
     */
    protected function getJqueryVersions()
    {
        return [
            '3.7.1' => [
                'file' => 'jquery.min.js',
                'integrity' => 'sha384-1H217gwSVyLSIfaLxHbE7dRb3v4mYCKbpQvzx0cegeju1MVsGrX5xXxAvs/HgeFs',
            ],
            '4.0.0' => [
                'file' => 'jquery-4.0.0.min.js',
                'integrity' => 'sha384-fgGyf7Mo7DURSOMnOy7ed+dkq5Job205Gnzu6QIg0BOHKaqt4D76Dt8VlDCzcMHV',
            ],
        ];
    }

    /**
     * Read the selected version, defaulting existing installations to 3.7.1.
     *
     * @return string A supported jQuery version
     */
    protected function getJqueryVersion()
    {
        $version = Configuration::get('RUCINGEDIMPACTCODE_JQUERY_VERSION');
        $versions = $this->getJqueryVersions();

        return is_string($version) && isset($versions[$version]) ? $version : '3.7.1';
    }

    /**
     * Render storefront connection hints and the selected jQuery resource.
     */
    public function getReduceImpact()
    {
        $jquerySetting = Configuration::get('RUCINGEDIMPACTCODE_JQUERY');
        $jquerySetting = in_array($jquerySetting, [0, 1, 2, 3, 4, 5, '0', '1', '2', '3', '4', '5'], true)
            ? (int) $jquerySetting : 0;
        $jqueryVersion = $this->getJqueryVersion();
        $jqueryVersions = $this->getJqueryVersions();
        $url_js = '';

        switch ($jquerySetting) {
            case 1:
                $arturi = Tools::getHttpHost(true) . __PS_BASE_URI__;
                $local_uri = Tools::getMediaServer($arturi);
                if (!preg_match('#^https?://#', $local_uri)) {
                    $local_uri = Tools::getShopProtocol() . $local_uri;
                }
                $url_js = $local_uri . '/modules/' . $this->name . '/views/js/' . $jqueryVersions[$jqueryVersion]['file'];
                break;
            case 2:
                $url_js = $jqueryVersion === '3.7.1'
                    ? 'https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js'
                    : 'https://code.jquery.com/jquery-' . $jqueryVersion . '.min.js';
                break;
            case 3:
                $url_js = 'https://code.jquery.com/jquery-' . $jqueryVersion . '.min.js';
                break;
            case 4:
                $url_js = 'https://cdnjs.cloudflare.com/ajax/libs/jquery/' . $jqueryVersion . '/jquery.min.js';
                break;
            case 5:
                $url_js = 'https://cdn.jsdelivr.net/npm/jquery@' . $jqueryVersion . '/dist/jquery.min.js';
                break;
            default:
                $url_js = '';
                break;
        }

        $google_font = Configuration::get('RUCINGEDIMPACTCODE_GOOGLEFONT');
        $custom_head = Configuration::get('RUCINGEDIMPACTCODE_DIRECTIVES');
        $google_analytics = Configuration::get('RUCINGEDIMPACTCODE_GA');
        $google_tag = Configuration::get('RUCINGEDIMPACTCODE_GTM');


        $this->smarty->assign([
            'google_font' => $google_font,
            'jquery_local' => $jquerySetting,
            'url_js' => $url_js,
            'jquery_integrity' => $jquerySetting > 1 ? $jqueryVersions[$jqueryVersion]['integrity'] : '',
            'custom_head' => $custom_head,
            'google_analytics' => $google_analytics,
            'google_tag' => $google_tag

        ]);

        return $this->display(__FILE__, 'reduceimpact.tpl');

    }

    public function hookDisplayHeader()
    {
        $position = Configuration::get('RUCINGEDIMPACTCODE_POSITION');
        if ($position == 0) {
            return $this->getReduceImpact();
        }
    }

    public function hookDisplayAfterTitleTag()
    {
        $position = Configuration::get('RUCINGEDIMPACTCODE_POSITION');
        if ($position == 1) {
            return $this->getReduceImpact();
        }
    }


    public function hookDisplayReduceImpact()
    {
        $position = Configuration::get('RUCINGEDIMPACTCODE_POSITION');
        if ($position == 2) {
            return $this->getReduceImpact();
        }
    }




}

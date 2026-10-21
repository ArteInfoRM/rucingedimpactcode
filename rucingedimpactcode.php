<?php
/**
 * Copyright (c) 2009-2026 Arte e Informatica di Loris Modena e C. s.a.s.
 *
 * @author    Tecnoacquisti.com <helpdesk@tecnoacquisti.com>
 * @license   https://opensource.org/license/mit MIT License
 * @version   1.0.7
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
        $this->version = '1.0.7';
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
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ],
                            [
                                'id' => 'active_off',
                                'value' => false,
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
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ],
                            [
                                'id' => 'active_off',
                                'value' => false,
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
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ],
                            [
                                'id' => 'active_off',
                                'value' => false,
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
                                ['id' => '1', 'name' => $this->l("Load JQuery 3.7.1 from local server")],
                                ['id' => '2', 'name' => $this->l("Load jQuery via Google CDN")],
                                ['id' => '3', 'name' => $this->l("Load jQuery via Microsoft CDN")],
                                ['id' => '4', 'name' => $this->l("Load jQuery via CDNJS CDN")],
                                ['id' => '5', 'name' => $this->l("Load jQuery via jsDelivr CDN")],
                            ],
                            'id' => 'id',
                            'name' => 'name'
                        ]
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
        return [
            'RUCINGEDIMPACTCODE_GOOGLEFONT' => Tools::getValue('RUCINGEDIMPACTCODE_GOOGLEFONT', Configuration::get('RUCINGEDIMPACTCODE_GOOGLEFONT')),
            'RUCINGEDIMPACTCODE_JQUERY' => Tools::getValue('RUCINGEDIMPACTCODE_JQUERY', Configuration::get('RUCINGEDIMPACTCODE_JQUERY')),
            'RUCINGEDIMPACTCODE_DIRECTIVES' => Tools::getValue('RUCINGEDIMPACTCODE_DIRECTIVES', Configuration::get('RUCINGEDIMPACTCODE_DIRECTIVES')),
            'RUCINGEDIMPACTCODE_GA' => Tools::getValue('RUCINGEDIMPACTCODE_GA', Configuration::get('RUCINGEDIMPACTCODE_GA')),
            'RUCINGEDIMPACTCODE_GTM' => Tools::getValue('RUCINGEDIMPACTCODE_GTM', Configuration::get('RUCINGEDIMPACTCODE_GTM')),
            'RUCINGEDIMPACTCODE_POSITION' => Tools::getValue('RUCINGEDIMPACTCODE_POSITION', Configuration::get('RUCINGEDIMPACTCODE_POSITION')),

        ];
    }

    /**
     * Save form data.
     */
    protected function postProcess()
    {
        $form_values = $this->getConfigFormValues();

        foreach (array_keys($form_values) as $key) {
            if ($key == 'RUCINGEDIMPACTCODE_DIRECTIVES') {
                Configuration::updateValue($key, Tools::getValue($key), true);
            } else {
                Configuration::updateValue($key, Tools::getValue($key));
            }
        }

        $output = $this->displayConfirmation($this->l('Settings updated'));;
        return $output;
    }

    /**
    * Add the CSS & JavaScript files you want to be loaded in the BO.
    */
    public function getReduceImpact()
    {


        $jquerySetting = Configuration::get('RUCINGEDIMPACTCODE_JQUERY');
        $url_js = '';

        switch ($jquerySetting) {
            case 1:
                $arturi = Tools::getHttpHost(true) . __PS_BASE_URI__;
                $local_uri = Tools::getMediaServer($arturi);
                if (!preg_match('#^https?://#', $local_uri)) {
                    $local_uri = Tools::getShopProtocol() . $local_uri;
                }
                $url_js = $local_uri . '/modules/' . $this->name . '/views/js/jquery.min.js';
                break;
            case 2:
                $url_js = 'https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js';
                break;
            case 3:
                $url_js = 'https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.7.1.min.js';
                break;
            case 4:
                $url_js = 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js';
                break;
            case 5:
                $url_js = 'https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js';
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

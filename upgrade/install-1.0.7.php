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

/**
 * @param Module $module
 * @return bool
 */
function upgrade_module_1_0_7($module)
{

    $sql = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'rucingedimpactcode_tags` (
        `id_rucingedimpactcode_tags` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
        `custom_snippet` TEXT NOT NULL,
        `date_add` DATETIME NOT NULL,
        PRIMARY KEY (`id_rucingedimpactcode_tags`)
    ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8mb4;';

    if (!Db::getInstance()->execute($sql)) {
        return false;
    }

    $oldDirectives = Configuration::get('RUCINGEDIMPACTCODE_DIRECTIVES');

    if ($oldDirectives && $oldDirectives !== '') {
        $data = [
            'custom_snippet' => pSQL($oldDirectives, true),
            'date_add'       => date('Y-m-d H:i:s'),
        ];

        if (!Db::getInstance()->insert('rucingedimpactcode_tags', $data)) {
            return false;
        }
    }

    Configuration::deleteByName('RUCINGEDIMPACTCODE_DIRECTIVES');

    return true;
}

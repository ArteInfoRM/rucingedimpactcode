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

function upgrade_module_1_0_4($object)
{
    $object->registerHook('displayReduceImpact');
    $object->registerHook('displayHeader');
    Configuration::updateValue('RUCINGEDIMPACTCODE_POSITION', 0);
    return true;
}

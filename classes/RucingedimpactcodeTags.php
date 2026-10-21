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

class RucingedimpactcodeTags extends ObjectModel
{
    public $id_rucingedimpactcode_tags;
    public $custom_snippet;
    public $date_add;

    public static $definition = [
        'table' => 'rucingedimpactcode_tags',
        'primary' => 'id_rucingedimpactcode_tags',
        'fields' => [
            'custom_snippet' => ['type' => self::TYPE_HTML, 'validate' => 'isCleanHtml'],
            'date_add'       => ['type' => self::TYPE_DATE],
        ],
    ];
}

<?php

/**
 * [BEGIN_COT_EXT]
 * Hooks=users.details.tags
 * [END_COT_EXT]
 */
/**
 * altefolio module
 *
 * @package altefolio
 * @version 1.0.2
 * @author AlteraWeb Team
 * @copyright Copyright (c) AlteraWeb.ru
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

$id = cot_import('id', 'G', 'INT');
$al = $db->prep(cot_import('al', 'G', 'TXT'));
$c = cot_import('c', 'G', 'TXT');
$p = cot_import('page', 'G', 'INT');
$a = cot_import('a', 'G', 'TXT');
$d = $p * $maxrowsperpage;

require_once cot_incfile('folio', 'module');


if (!in_array($a, array('add', 'edit', 'preview'))) {
    if (isset($_GET['id']) || isset($_GET['al'])) {
        require_once cot_incfile('folio', 'module', "main");
    } else {
        require_once cot_incfile('alterfolio', 'plug', "list");
    }
}elseif($a == "add") {
    require_once cot_incfile('alterfolio', 'plug', "add");
}





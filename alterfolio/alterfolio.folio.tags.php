<?php

/**
 * [BEGIN_COT_EXT]
 * Hooks=folio.tags
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
$owner = $item["item_userid"];
if ($id > 0) {
    $where_prev = " item_userid='" . $owner . "' && item_id < $id ";
    $where_next = " item_userid='" . $owner . "' && item_id > $id ";
    $_t_T = "num";
} elseif (!empty($al)) {
    $cur = $db->query("SELECT item_id, item_alias FROM $db_folio WHERE item_alias = '$al' LIMIT 1 ")->fetch();
    $where_prev = " item_userid='" . $owner . "' && item_id < " . $cur['item_id'];
    $where_next = " item_userid='" . $owner . "' && item_id > " . $cur['item_id'];
    $_t_T = "abc";
}
$sql_prev = $db->query("SELECT item_id, item_alias FROM $db_folio WHERE $where_prev ORDER BY `item_id` DESC LIMIT 1 ")->fetch();
$sql_next = $db->query("SELECT item_id, item_alias FROM $db_folio WHERE $where_next ORDER BY `item_id` ASC LIMIT 1 ")->fetch();

if ($_t_T == "abc") {
    $prd_prev = $sql_prev["item_alias"];
    $prd_next = $sql_next["item_alias"];
} else {
    $prd_prev = $sql_prev["item_id"];
    $prd_next = $sql_next["item_id"];
}

if ($_t_T == "abc") {
    if (!empty($prd_prev)) {
        $t->assign("PRD_PREV", cot_url('users', 'm=details&u=' . $_GET["u"] . "&w=folio&al=" . $prd_prev));
    }
    if (!empty($prd_next)) {
        $t->assign("PRD_NEXT", cot_url('users', 'm=details&u=' . $_GET["u"] . "&w=folio&al=" . $prd_next));
    }
} else {
    if (!empty($prd_prev)) {
        $t->assign("PRD_PREV", cot_url('users', 'm=details&u=' . $_GET["u"] . "&w=folio", "?id=" . $prd_prev));
    }
    if (!empty($prd_next)) {
        $t->assign("PRD_NEXT", cot_url('users', 'm=details&u=' . $_GET["u"] . "&w=folio", "?id=" . $prd_next));
    }
}

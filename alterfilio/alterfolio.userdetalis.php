<?php

/**
 * [BEGIN_COT_EXT]
 * Hooks=users.details.tags
 * [END_COT_EXT]
 */

/**
 * folio module
 *
 * @package portfolio
 * @version 1.0.0
 * @author AlteraWeb Team
 * @copyright Copyright (c) AlteraWeb.ru
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');
require_once cot_incfile('folio', 'module');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = cot_auth('folio', 'any', 'RWA');
$maxrowsperpage = ($cfg['folio']['cat_' . $c]['maxrowsperpage']) ? $cfg['folio']['cat_' . $c]['maxrowsperpage'] : $cfg['folio']['cat___default']['maxrowsperpage'];

$id = cot_import('id', 'G', 'INT');
$al = $db->prep(cot_import('al', 'G', 'TXT'));
$c = cot_import('c', 'G', 'TXT');
$p = cot_import('page', 'G', 'INT');

$d = $p * $maxrowsperpage;

if ($id > 0 || !empty($al))
{
    
    /* === Hook === */
foreach (cot_getextplugins('folio.first') as $pl)
{
	include $pl;
}
/* ===== */

if ($id > 0 || !empty($al))
{
	$where = (!empty($al)) ? "item_alias='".$al."'" : 'item_id='.$id;
	$sql = $db->query("SELECT f.*, u.* FROM $db_folio AS f 
		LEFT JOIN $db_users AS u ON u.user_id=f.item_userid WHERE $where LIMIT 1");
}

if (!$id && empty($al) || !$sql || $sql->rowCount() == 0)
{
	cot_die_message(404, TRUE);
}
$item = $sql->fetch();
$owner = $item["user_id"];

if($id > 0){
       $where_prev = " item_userid='".$owner."' && item_id < $id ";
       $where_next = " item_userid='".$owner."' && item_id > $id ";
       $_t_T = "num";
    }elseif(!empty($al)){
       $cur = $db->query("SELECT item_id, item_alias FROM $db_folio WHERE item_alias = '$al' LIMIT 1 ")->fetch();
       $where_prev = " item_userid='".$owner."' && item_id < ".$cur['item_id'];
       $where_next = " item_userid='".$owner."' && item_id > ".$cur['item_id']; 
       $_t_T = "abc";
    }
    #$sql = $db->query(" SELECT rownumb,item_id FROM ( SELECT @rownumb := @rownumb+1 AS rownumb, item_id FROM $db_folio AS folio, (SELECT @rownumb := 0) al WHERE $where) AS src ");
    $sql_prev = $db->query("SELECT item_id, item_alias FROM $db_folio WHERE $where_prev ORDER BY `item_id` DESC LIMIT 1 ")->fetch();
    $sql_next = $db->query("SELECT item_id, item_alias FROM $db_folio WHERE $where_next ORDER BY `item_id` ASC LIMIT 1 ")->fetch();
   
    if($_t_T == "abc"){
        $prd_prev = $sql_prev["item_alias"];
        $prd_next = $sql_next["item_alias"];
    }else{
        $prd_prev = $sql_prev["item_id"];
        $prd_next = $sql_next["item_id"];
    }

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = cot_auth('folio', $item['item_cat'], 'RWA');
cot_block($usr['auth_read']);

if ($item['item_state'] == 1 && !$usr['isadmin'] && $usr['id'] != $item['item_userid'])
{
	cot_log("Attempt to directly access an un-validated", 'sec');
	cot_redirect(cot_url('message', "msg=930", '', true));
	exit;
}

if (!$usr['isadmin'] || $cfg['count_admin'])
{
	$item['item_count']++;
	$db->update($db_folio, array('item_count' => $item['item_count']), "item_id=" . (int)$item['item_id']);
}

$title_params = array(
	'TITLE' => empty($item['item_metatitle']) ? $item['item_title'] : $item['item_metatitle'],
	'CATEGORY' => $structure['folio'][$item['item_cat']]['title'],
);
$out['subtitle'] = cot_title($cfg['folio']['title_folio'], $title_params);

$out['desc'] = (!empty($item['item_metadesc'])) ? $item['item_metadesc'] : cot_cutstring(strip_tags($item['item_text']), 250);
$out['meta_keywords'] = (!empty($item['item_keywords'])) ? $item['item_keywords'] : $structure['folio'][$item['item_cat']]['keywords'];

$mskin = cot_tplfile(array('folio', $structure['folio'][$item['item_cat']]['tpl']));

/* === Hook === */
foreach (cot_getextplugins('folio.main') as $pl)
{
	include $pl;
}
/* ===== */
$t = new XTemplate(cot_tplfile('alterfolio', 'plug'));

$t->assign(cot_generate_usertags($item, 'PRD_OWNER_'));
$t->assign(cot_generate_foliotags($item, 'PRD_', $cfg['folio']['shorttextlen'], $usr['isadmin'], $cfg['homebreadcrumb']));

/* === Hook === */
foreach (cot_getextplugins('folio.tags') as $pl)
{
	include $pl;
}
/* ===== */


if ($usr['isadmin'])
{
	$t->parse('MAIN.PRD_ADMIN');
}
    
    if($_t_T == "abc"){
        if (!empty($prd_prev)) {
            $t->assign("PRD_PREV", cot_url('users', 'm=details&u=' . $_GET["u"] . "&w=folio&al=" . $prd_prev));
        }
        if (!empty($prd_next)) {
            $t->assign("PRD_NEXT", cot_url('users', 'm=details&u=' . $_GET["u"] . "&w=folio&al=" . $prd_next));
        }
    }else{
        if (!empty($prd_prev)) {
            $t->assign("PRD_PREV", cot_url('users', 'm=details&u=' . $_GET["u"] . "&w=folio", "?id=" . $prd_prev));
        }
        if (!empty($prd_next)) {
            $t->assign("PRD_NEXT", cot_url('users', 'm=details&u=' . $_GET["u"] . "&w=folio", "?id=" . $prd_next));
        }
    }
    
    
$t->parse('MAIN');
$module_body = $t->text('MAIN');
       
}else{
    $where = "item_userid='".$urr['user_id']."'";
    $sql = $db->query("SELECT f.*, u.* FROM $db_folio AS f 
                LEFT JOIN $db_users AS u ON u.user_id=f.item_userid WHERE $where LIMIT {$d}, {$maxrowsperpage}");

    $items = $sql->fetchAll();
    
    #print "<pre>";
    #print_r($urr);
    #print "</pre>";
   
    $t1 = new XTemplate(cot_tplfile('alterfolio.list', 'plug'));
    
    $i = 1;
    foreach ($items as $item){
        $t1->assign('IDX', $i++);
        $t1->assign(cot_generate_foliotags($item, 'PRD_ROW_'));
        $t1->assign('PRD_ROW_URL', cot_url('users', 'm=details&u='.$urr["user_name"]."&w=folio", "?id=".$item["item_id"]));
        $t1->assign('PRD_ROW_URL_ABC', cot_url('users', 'm=details&u='.$urr["user_name"]."&w=folio&al=".$item["item_alias"]));
        
        $t1->parse('MAIN.PRD_ROWS');
    }
    


    $t1->parse('MAIN');
    
    $t1->assign(array(
        "PRD_ADDPRD_URL" => cot_url('folio', 'm=add'),
        "RPD_ADDPRD_SHOWBUTTON" => ($usr['auth_write']) ? true : false
    ));

    $t->assign('PORTFOLIO_2', $t1->text("MAIN"));
}



<?php

require_once("./simple_html_dom.php");
error_reporting(false);

$html = file_get_html("http://www.pokepedia.fr/Liste_des_Pokémon_par_statistiques_de_base");

function cmp_num($a, $b) { return $a['num'] > $b['num']; }
function cmp_name($a, $b) { return strcmp($a['name'], $b['name']); }
function cmp_pv($a, $b) { return $a['pv'] < $b['pv']; }
function cmp_atk($a, $b) { return $a['atk'] < $b['atk']; }
function cmp_def($a, $b) { return $a['def'] < $b['def']; }
function cmp_atks($a, $b) { return $a['atks'] < $b['atks']; }
function cmp_defs($a, $b) { return $a['defs'] < $b['defs']; }
function cmp_spd($a, $b) { return $a['spd'] < $b['spd']; }
function cmp_total($a, $b) { return $a['total'] < $b['total']; }
function grep_name($var) {
	$grep_name = isset($_POST['search']) ? $_POST['search'] : '';
	if ($grep_name === '')
		return true;
	return (strpos($var['name'], $grep_name) !== false);
}

if ($html) {
	$table = $html->find('table tbody', 0);

	$pokemons = array();

	foreach($table->find('tr') as $key => $row) {
		if ($key == 0)
			continue;

		$pokemon = array(
			'num' => intval($row->children(0)->innertext),
			'name' => $row->children(2)->find('a', 0)->title,
			'href' => $row->children(2)->find('a', 0)->href,
			'pv' => intval($row->children(3)->innertext),
			'atk' => intval($row->children(4)->innertext),
			'def' => intval($row->children(5)->innertext),
			'atks' => intval($row->children(6)->innertext),
			'defs' => intval($row->children(7)->innertext),
			'spd' => intval($row->children(8)->innertext),
			'total' => intval($row->children(9)->innertext)
			);

		$pokemons[] = $pokemon;
	}

	$sort_attribute = isset($_POST['sort']) ? $_POST['sort'] : 'num';

	usort($pokemons, "cmp_".$sort_attribute);
	$pokemons = array_filter($pokemons, "grep_name");
} else {
	$pokemons = null;
}

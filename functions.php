<?php
function pagefind() {
	$chk_domains[0][0] = "Homepage";		
	$chk_domains[0][1] = get_settings('home') . "/";

	global $wpdb;

	$queryresult = $wpdb->get_results("SELECT wposts.* FROM $wpdb->posts wposts
		WHERE wposts.post_date < '" . current_time('mysql') . "'
		AND wposts.post_status = 'publish'
		ORDER BY wposts.post_date DESC
		LIMIT 12 
		");

	if (count($queryresult) > 0) {
		$n=0;
		foreach($queryresult as $postinfo) {
			$n++;
			$chk_domains[$n][0] = $postinfo->post_title;
			$chk_domains[$n][1] = get_permalink($postinfo->ID);
		}
	}
	return $chk_domains;
}

function spagefind($ssterm) {
	global $wpdb;

	$queryresult = $wpdb->get_results(search_perform($ssterm));

	if (count($queryresult) > 0) {
		$n=0;
		foreach($queryresult as $postinfo) {
			$chk_domains[$n][0] = $postinfo->post_title;
			$chk_domains[$n][1] = get_permalink($postinfo->ID);
			$n++;
		}
	}
	return $chk_domains;
}


function search_split_terms($terms){
	$terms = preg_replace("/\"(.*?)\"/e", "search_transform_term('\$1')", $terms);
	$terms = preg_split("/\s+|,/", $terms);

	$out = array();

	foreach($terms as $term){
		$term = preg_replace("/\{WHITESPACE-([0-9]+)\}/e", "chr(\$1)", $term);
		$term = preg_replace("/\{COMMA\}/", ",", $term);
		$out[] = $term;
	}
	return $out;
}

function search_transform_term($term){
	$term = preg_replace("/(\s)/e", "'{WHITESPACE-'.ord('\$1').'}'", $term);
	$term = preg_replace("/,/", "{COMMA}", $term);
	return $term;
}

function search_escape_rlike($string){
	return preg_replace("/([.\[\]*^\$])/", '\\\$1', $string);
}

function search_db_escape_terms($terms){
	$out = array();
	foreach($terms as $term){
		$out[] = '[[:<:]]'.AddSlashes(search_escape_rlike($term)).'[[:>:]]';
	}
	return $out;
}

function search_perform($terms){
	$terms = search_split_terms($terms);
	$terms_db = search_db_escape_terms($terms);
	$terms_rx = search_rx_escape_terms($terms);

	$parts = array();
	foreach($terms_db as $term_db){
		$parts[] = "(wposts.post_title RLIKE '$term_db' OR wposts.post_content RLIKE '$term_db')";
	}
	$parts = implode(' AND ', $parts);
	
	global $wpdb;
	
	$sql = "SELECT wposts.* FROM $wpdb->posts wposts
		WHERE wposts.post_date < '" . current_time('mysql') . "'
		AND wposts.post_status = 'publish'
		AND ($parts)
		ORDER BY wposts.post_date DESC
		LIMIT 8
		";
	return $sql;
}

function search_rx_escape_terms($terms){
	$out = array();
	foreach($terms as $term){
		$out[] = '\b'.preg_quote($term, '/').'\b';
	}
	return $out;
}
?>

<?php
/*
Plugin Name: PopuList
Plugin URI: http://www.johnlawrence.net/populist/
Description: Track your blogs popularity posts on social bookmarking sites reddit, stumbleupon, del.icio.us and digg
Version: 1.5.1
Author: John Lawrence
Author URI: http://www.johnlawrence.net/

Copyright (c) 2009 John Lawrence. All rights reserved.

Released under the GPL license
http://www.opensource.org/licenses/gpl-license.php

This is an add-on for WordPress
http://wordpress.org/
*/

function popu_list(){
	if(isset($_POST['s'])){ $s = $_POST['s']; }
	$slurl = get_bloginfo('wpurl') . '/wp-content/plugins/PopuList/';
	include_once('functions.php');
	include_once('style.php');
	echo '<div class="wrap">';
	echo '<h2>PopuList</h2>';
	$domain = $_SERVER['HTTP_HOST'];
	echo'<form name="searchform" action="' . "http://" . $domain . $_SERVER['REQUEST_URI'] . '" method="post" style="float: left; width: 36em; margin-right: 3em;"> 
  		<fieldset> 
  		<legend style="margin:0; padding: 0; font-size:0.9em;">Search Posts&hellip;</legend> 
  		<input type="text" name="s" value="';
	if (isset($s)) echo wp_specialchars($s, 1);
	echo '" size="27" /> 
  		<input type="submit" name="submit" class="button" value="Search"  /> 
  		</fieldset>
		</form>';
	echo '<br style="clear: both;" />';
	$populist_tc='t1s';
	if($_GET['t']=='bl'){$populist_tc='t2s';}
	echo '<ul id="tabnav" class="' . $populist_tc . '">';
        echo '<li class="tab1"><a href="index.php?page=popu-list&t=sb">Social Bookmarks</a></li>';
	echo '<li class="tab2"><a href="index.php?page=popu-list&t=bl">Backlinks</a></li>';
        echo '</ul>';

	if (isset($s)){
		$check = spagefind($s);
	}else{
		$check = pagefind();
	}

	if(!isset($check[0])){
		echo '<br style="clear: both;" /><h3>There are no posts which match your query</h3>';
		echo '<br style="clear: both;" /></div>';
	}elseif($_GET['t']=='bl'){
                echo '<div id="gooblbox" class="slmodule" >';
                echo '<h3 class="hndle"><span>Google</span></h3>';
                echo '<div class="inside">';
                echo '<div style="padding: 10px;">';
                include_once('goobl.php');
                echo '</div>';
                echo '</div>';
                echo '</div>';

                echo '<div id="yahblbox" class="slmodule" >';
                echo '<h3 class="hndle"><span>Yahoo</span></h3>';
                echo '<div class="inside">';
                echo '<div style="padding: 10px;">';
                include_once('yahoobl.php');
                echo '</div>';
                echo '</div>';
                echo '</div>';
	}else{
		echo '<div id="diggbox" class="slmodule" >';
		echo '<h3 class="hndle"><span>Digg</span></h3>';
		echo '<div class="inside">';
		echo '<div style="padding: 10px;">';
		include_once('digg.php');
		echo '</div>';
		echo '</div>';
		echo '</div>';

		echo '<div id="delbox" class="slmodule" >';
		echo '<h3 class="hndle"><span>del.icio.us</span></h3>';
		echo '<div class="inside">';
		echo '<div style="padding: 10px;">';
		include_once('delicious.php');
		echo '</div>';
		echo '</div>';
		echo '</div>';

                echo '<div id="redbox" class="slmodule" >';
                echo '<h3 class="hndle"><span>Reddit</span></h3>';
                echo '<div class="inside">';
                echo '<div style="padding: 10px;">';
                include_once('reddit.php');
                echo '</div>';
                echo '</div>';
                echo '</div>';

                echo '<div id="stmbox" class="slmodule" >';
                echo '<h3 class="hndle"><span>StumbleUpon</span></h3>';
                echo '<div class="inside">';
                echo '<div style="padding: 10px;">';
                include_once('stumble.php');
                echo '</div>';
                echo '</div>';
                echo '</div>';

?>
<div class="clear"></div>


<?php
		echo '<br style="clear: both;" /></div>';
		//echo $delscripts;
	}
}

// mt_add_pages() is the sink function for the 'admin_menu' hook
function mt_add_pages() {
    // Add a submenu to the Dashboard:
    add_submenu_page('index.php', 'PopuList', 'PopuList', 8, 'popu-list', 'popu_list');
}

// Insert the mt_add_pages() sink into the plugin hook list for 'admin_menu'
add_action('admin_menu', 'mt_add_pages');
?>

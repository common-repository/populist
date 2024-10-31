<?php
	echo '<table class="sltable">';
	foreach($check as $checkit){
	        $contents = "";
		$digg_result = fsockopen("digg.com", 80, $errno, $errstr, 12);
		fputs($digg_result, "GET /tools/diggthis.php?u=" . $checkit[1] . " HTTP/1.0\r\n");
   		fputs($digg_result, "Host: digg.com\r\n");
   		fputs($digg_result, "Referer: http://digg.com\r\n");
   		fputs($digg_result, "User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)\r\n\r\n");

		$dsc = 1;
		while (!feof($digg_result) && $dsc == 1) {
			$contents .= fread($digg_result, 8192);
			if($contents == ""){ $dsc = 0; }
		}
		
		preg_match("/<strong id=\"diggs-strong-1\">(.*)<\/strong>/Usm", $contents, $digg_count);
		if($digg_count[1]<1){$digg_count[1]=0;}
		echo '<tr><td>' . $checkit[0] . '</td><td>' . $digg_count[1] . '</td></tr>';
	}
	echo '</table>';
?>

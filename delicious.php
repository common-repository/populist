<?php
	echo '<table class="sltable">';
	foreach($check as $checkit){
	        $contents = "";
		$del_result = fsockopen("feeds.delicious.com", 80, $errno, $errstr, 12);
		fputs($del_result, "GET /v2/json/urlinfo/" . md5($checkit[1]) . " HTTP/1.0\r\n");
   		fputs($del_result, "Host: feeds.delicious.com\r\n");
   		fputs($del_result, "Referer: http://delicious.com\r\n");
   		fputs($del_result, "User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)\r\n\r\n");

		$dsc = 1;
		while (!feof($del_result) && $dsc == 1) {
			$contents .= fread($del_result, 8192);
			if($contents == ""){ $dsc = 0; }
		}
		
		preg_match("/total_posts\":(.*),\"top_tags/Usm", $contents, $del_count);
		if($del_count[1]<1){$del_count[1]=0;}
		//echo "<textarea> http://feeds.delicious.com/v2/json/urlinfo/".md5($checkit[1])."</textarea>";
		echo '<tr><td>' . $checkit[0] . '</td><td>' . $del_count[1] . '</td></tr>';
	}
	echo '</table>';
?>

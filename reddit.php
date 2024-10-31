<?php
	echo '<table class="sltable">';
	foreach($check as $checkit){
	        $contents = "";
		$del_result = fsockopen("reddit.com", 80, $errno, $errstr, 12);
		fputs($del_result, "GET /button_content?t=3&width=69&url=" . $checkit[1] . " HTTP/1.0\r\n");
   		fputs($del_result, "Host: www.reddit.com\r\n");
   		fputs($del_result, "Referer: http://reddit.com\r\n");
   		fputs($del_result, "User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)\r\n\r\n");

		$dsc = 1;
		while (!feof($del_result) && $dsc == 1) {
			$contents .= fread($del_result, 8192);
			if($contents == ""){ $dsc = 0; }
		}
		
		preg_match("/ *'(.*)'/Usm", $contents, $del_count);
		if($del_count[1]<1){$del_count[1]=0;}
		//echo "<textarea> $contents </textarea>";
		echo '<tr><td>' . $checkit[0] . '</td><td>' . $del_count[1] . '</td></tr>';
	}
	echo '</table>';
?>

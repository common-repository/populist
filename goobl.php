<?php
	echo '<table class="sltable">';
	foreach($check as $checkit){
	        $contents = "";
		$del_result = fsockopen("google.com", 80, $errno, $errstr, 12);
		fputs($del_result, "GET /search?q=link%3A" . $checkit[1] . " HTTP/1.0\r\n");
   		fputs($del_result, "Host: www.google.com\r\n");
   		fputs($del_result, "Referer: www.google.com\r\n");
   		fputs($del_result, "User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)\r\n\r\n");

		$dsc = 1;
		while (!feof($del_result) && $dsc == 1) {
			$contents .= fread($del_result, 8192);
			if($contents == ""){ $dsc = 0; }
		}
		
		preg_match("/of about <b>([0-9]*)<\/b> linking to/Usm", $contents, $del_count);
		if($del_count[1]<1){$del_count[1]=0;}
		//echo "<textarea> $contents </textarea>";
		echo '<tr><td>' . $checkit[0] . '</td><td>';
		echo '<a href="http://www.google.com/cse?cx=partner-pub-0192194019234176%3Au5o9m9nxurc&ie=ISO-8859-1&q=link%3A'.$checkit[1].'">'. $del_count[1] . '</a></td></tr>';
	}
	echo '</table>';
?>

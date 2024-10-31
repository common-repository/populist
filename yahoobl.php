<?php
	echo '<table class="sltable">';
	foreach($check as $checkit){
	        $contents = "";
		$del_result = fsockopen("search.yahooapis.com", 80, $errno, $errstr, 12);
		fputs($del_result, "GET /SiteExplorerService/V1/inlinkData?appid=UEnpCCDV34EIXlUNENxiZRzxmAb6.rqHZrfhql3RzmzK0h7nGi8c01hfpiXbOufDpBjAX5V66.ULWw--&query=" . $checkit[1] . "&results=1 HTTP/1.0\r\n");
   		fputs($del_result, "Host: search.yahooapis.com\r\n");
   		fputs($del_result, "Referer:\r\n");
   		fputs($del_result, "User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)\r\n\r\n");

		$dsc = 1;
		while (!feof($del_result) && $dsc == 1) {
			$contents .= fread($del_result, 8192);
			if($contents == ""){ $dsc = 0; }
		}
		
		preg_match("/totalResultsAvailable=\"([^\"]*)\"/Usm", $contents, $del_count);
		if($del_count[1]<1){$del_count[1]=0;}
		//echo "<textarea> $contents </textarea>";
		echo '<tr><td>' . $checkit[0] . '</td><td>';
		echo '<a href="http://siteexplorer.search.yahoo.com/search?p='.$checkit[1].'&bwm=i">'. $del_count[1] . '</a></td></tr>';
	}
	echo '</table>';
?>

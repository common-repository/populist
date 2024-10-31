<?php
function stumblecounts($url){
    $userid    = '7352625';
    $authtoken = '%2BvUFAKyU0oz%2BsSTcYotQCuQQqIk%3D';

    $contents = "";
    $eol = "\r\n";

    $data = "u=".rawurlencode($url)."&username=".$userid."&password=".$authtoken;

    $del_result = fsockopen("stumbleupon.com", 80, $errno, $errstr, 12);
    fputs($del_result, "POST /links.php?username=$userid HTTP/1.0$eol");
    fputs($del_result, "Host: www.stumbleupon.com$eol");
    fputs($del_result, "Connection: close$eol");
    fputs($del_result, "Content-Type: application/x-www-form-urlencoded$eol");
    fputs($del_result, "Content-Length: " . strlen($data) . $eol);
    fputs($del_result, "Referer: http://stumbleupon.com$eol");
    fputs($del_result, "User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)$eol$eol");
    fputs($del_result, $data);
    fputs($del_result, $eol);

    $resp = '';
    do{$resp = fgets($del_result, 10000);}while (!feof($del_result));

    if(trim($resp) == '') return false;            // URL wasn't stumbled yet
    if(preg_match('/ERROR/i',$resp)) return $resp; // some error occured

    $resp = str_replace("\t\t", "\t", $resp);
    $data = explode("\t",$resp);
    $info['comments'] = $data[0];
    $info['thumbed']  = $data[1];
    $info['score']    = $data[2];
    $info['topic']    = $data[3];
    $info['reviews']  = $data[4];

    return $info;

}

echo '<table class="sltable">';
foreach($check as $checkit){
    $stm_result = stumblecounts($checkit[1]);
    if($stm_result){
        echo '<tr><td>' . $checkit[0] . '</td><td>' . $stm_result['score'] . '</td></tr>';
    }else{
        echo '<tr><td>' . $checkit[0] . '</td><td>-</td></tr>';
    }
}
echo '</table>';
?>

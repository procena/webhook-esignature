<?php


function curl_post_async($url, $params)
{
    $post_string = http_build_query($params);
    $parts = parse_url($url);

    $fp = fsockopen(
        $parts['host'],
        isset($parts['port']) ? $parts['port'] : 80,
        $errno,
        $errstr,
        30
    );

    if (!$fp) {
        print_r($fp);
        //Perform whatever logging you want to have happen b/c this call failed!    
        $logFile = is_file(WRITEPATH . "logs/events.txt") ? fopen(WRITEPATH . "logs/events.txt", "+a") :  fopen(WRITEPATH . "logs/events.txt", "w");
        $text = sprintf("Erro time: %s - data: %s \n", date("Y-m-d H:i:s"), json_encode($params));
        fwrite($logFile, $text);
        fclose($logFile);
        return false;
    }
    $out = "POST " . $parts['path'] . " HTTP/1.1\r\n";
    $out .= "Host: " . $parts['host'] . "\r\n";
    $out .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $out .= "Content-Length: " . strlen($post_string) . "\r\n";
    $out .= "Connection: Close\r\n\r\n";
    if (isset($post_string)) $out .= $post_string;

    fwrite($fp, $out);
    fclose($fp);
    $logFile = is_file(WRITEPATH . "logs/events.txt") ? fopen(WRITEPATH . "logs/events.txt", "+a") :  fopen(WRITEPATH . "logs/events.txt", "w");
    $text = sprintf("Success time: %s - data: %s \n", date("Y-m-d H:i:s"), json_encode($params));
    fwrite($logFile, $text);
    fclose($logFile);
    return true;
}

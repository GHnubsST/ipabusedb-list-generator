<?php

$url = 'https://api.abuseipdb.com/api/v2/blacklist';
$data = array('confidenceMinimum' => '90');

$options = array(
    CURLOPT_URL => $url . '?' . http_build_query($data),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
        'Key: XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
        'Accept: application/json'
    )
);

$curl = curl_init();
curl_setopt_array($curl, $options);
$response = curl_exec($curl);
curl_close($curl);

$fp = fopen('/var/www/html/api/abuse.json', 'w');
fwrite($fp, $response);
fclose($fp);

$json_str = file_get_contents('/var/www/html/api/abuse.json');
$object = json_decode($json_str);


$str =  '/ip firewall address-list'."\n";
$str .= 'remove [find where list="ipabusedb"];'."\n";
if ($object && isset($object->data)) {
    foreach ($object->data as $item) {
        if (filter_var($item->ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
        {
            $str .= 'add address="'.$item->ipAddress.'" list="ipabusedb" disabled=no;'."\n";
        }
    }
}

$fp = fopen('/var/www/html/api/mikrotik-v6-ipabusedb.rsc', 'w');
fwrite($fp, $str);
fclose($fp);

$str =  '/ip/firewall/address-list'."\n";
$str .= 'remove [find where list="ipabusedb"];'."\n";
if ($object && isset($object->data)) {
    foreach ($object->data as $item) {
        if (filter_var($item->ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
        {
            $str .= 'add address="'.$item->ipAddress.'" list="ipabusedb" disabled=no;'."\n";
        }
    }
}

$fp = fopen('/var/www/html/api/mikrotik-v7-ipabusedb.rsc', 'w');
fwrite($fp, $str);
fclose($fp);





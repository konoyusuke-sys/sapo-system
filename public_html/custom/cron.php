<?php


$url = 'https://sapo.asia/mail_schedule';
$response = file_get_contents($url);
echo $response;
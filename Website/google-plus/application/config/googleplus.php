<?php
$config['googleplus']['application_name'] = 'TEST'; #Use must have to use same application name which you register with google. Using APIs & Auth->Consent Screen
$config['googleplus']['client_id'] = '404272247220-ds1qfevajoudmrf85ttv2qnvbjrpbkku.apps.googleusercontent.com';
$config['googleplus']['client_secret'] = '7px7cQoPhXTFtfw51PE9yRgx';
//$config['googleplus']['redirect_uri'] = 'http://localhost/google-plus/index.php/app_form/'; #Add redirect url which you add in google console.
$config['googleplus']['redirect_uri'] = 'http://localhost/google-plus/index.php/google_plus_cantroler/'; #Add redirect url which you add in google console.

$config['googleplus']['api_key'] = ''; #Add Browser Key
$config['googleplus']['scopes'] = Array('email','profile');
$config['googleplus']['actions'] = Array('http://schemas.google.com/AddActivity');
?>
<?php

//$login_data = array();
//$login_data['user_login'] = $username;
//$login_data['user_password'] = $password;
//$login_data['remember'] = $remember;
//$user_verify = wp_signon( $login_data, false );

$data = [
	'errors' => \App\LoginForm::errors(),
];

$core->render('user-login', $data);
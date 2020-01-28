<?php

$data = [
	'errors' => \App\Login\LoginForm::errors(),
];

$core->render('user-login', $data);
<?php

namespace App\Login;

use Parfaitement\FormBase;
use Parfaitement\Traits\TryAuthenticateUser;

class LoginForm extends FormBase {

	use TryAuthenticateUser;

	public function rules() {
		return [
			'username' => 'required',
			'password' => 'required',
			'remember' => 'optional',
		];
	}

	public function success() {
		return wp_redirect( site_url() );
	}

}
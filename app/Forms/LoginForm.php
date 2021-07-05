<?php

namespace App\Forms;

use Starter\Forms\FormBase;

class LoginForm extends FormBase
{
    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required',
            'remember' => 'optional',
        ];
    }

    public function success()
    {
        $user_verify = wp_signon([
            'user_login' => $this->core->request->input('username'),
            'user_password' => $this->core->request->input('password'),
            'remember' => $this->core->request->input('remember'),
        ], is_ssl());

        if (is_wp_error($user_verify)) {
            return wp_safe_redirect(
                esc_url_raw(
                    add_query_arg('status', 'failed', $this->refererUrl)
                )
            );
        }

        return wp_redirect(site_url());
    }

}
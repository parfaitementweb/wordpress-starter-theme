<?php

namespace Starter\Forms;

use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\MessageBag;
use Starter\Choke;

class FormBase
{
    private static $instance = null;
    public $core;
    public $name;
    public $validator;
    public static $formName;
    protected $refererUrl;

    protected function __construct()
    {
        $this->core = Choke::getInstance();
        $this->name = class_basename($this);
        self::$formName = $this->name;
    }

    public static function make()
    {
        if (self::$instance == null) {
            $class = get_called_class();
            self::$instance = new $class;

            add_action('admin_post_nopriv_' . self::$formName, [self::$instance, 'handle']);
            add_action('admin_post_' . self::$formName, [self::$instance, 'handle']);
        }

        return self::$instance;
    }


    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData()
    {
        return $this->core->request->input();
    }

    static public function name()
    {
        return self::$formName;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * Actions to take when form failed
     *
     */
    public function fail()
    {
        return wp_safe_redirect(
            esc_url_raw(
                add_query_arg('status', 'error', $this->refererUrl)
            )
        );
    }

    /**
     * Actions to take when form was sucessfully submitted
     *
     */
    public function success()
    {
        return wp_safe_redirect(
            esc_url_raw(
                add_query_arg('status', 'success', $this->refererUrl)
            )
        );
    }

    function handle()
    {
        if (! wp_verify_nonce($_POST['_wpnonce'], $this->name)) {
            return $this->fail();
        }

        if (empty($_POST['_wp_http_referer'])) {
            $this->refererUrl = home_url('/');
        } else {
            $this->refererUrl = esc_url_raw(wp_unslash($_POST['_wp_http_referer']));
        }
        $this->validator = $this->core->validation->make(
            $this->validationData(),
            $this->rules(),
            $this->messages(),
            $this->attributes()
        );

        if ($this->validator->fails()) {
            $this->setCookies();

            return $this->fail();
        }

        return $this->success();
    }

    protected function setCookies()
    {
        setcookie('wp_form_errors', base64_encode(json_encode($this->validator->errors())), time() + (20 * MINUTE_IN_SECONDS), COOKIEPATH, COOKIE_DOMAIN, is_ssl());
        setcookie('wp_form_old', base64_encode(json_encode($this->core->request->only(collect($this->rules())->except('password')->keys()->toArray()))), time() + (20 * MINUTE_IN_SECONDS), COOKIEPATH, COOKIE_DOMAIN, is_ssl());
    }

    static public function errors()
    {
        if (isset($_COOKIE['wp_form_errors'])) {
            $errors = json_decode(base64_decode($_COOKIE['wp_form_errors']), true);
            $bag = new ViewErrorBag();
            $messages = new MessageBag();

            foreach ($errors as $key => $error) {
                $messages->add($key, $error[0]);
            }

            $bag->put('default', $messages);

            self::clearFormErrorsCookie();

            return $bag;
        }

        return new ViewErrorBag();
    }

    static public function old()
    {
        if (! isset($_COOKIE['wp_form_old'])) {
            return [];
        }

        $old = json_decode(base64_decode($_COOKIE['wp_form_old']), true);

        self::clearFormOldCookie();

        return $old;
    }

    protected static function clearFormErrorsCookie()
    {
        setcookie('wp_form_errors', null, time() - (1 * MINUTE_IN_SECONDS), COOKIEPATH, COOKIE_DOMAIN, is_ssl());
    }

    protected static function clearFormOldCookie()
    {
        setcookie('wp_form_old', null, time() - (1 * MINUTE_IN_SECONDS), COOKIEPATH, COOKIE_DOMAIN, is_ssl());
    }
}
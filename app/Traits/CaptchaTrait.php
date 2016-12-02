<?php

namespace App\Traits;

use Illuminate\Support\Facades\Input;
use ReCaptcha\ReCaptcha;
use Config;

trait CaptchaTrait {

    public function captchaCheck()
    {
        $captcha = Input::get('g-recaptcha-response');
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $secret = Config::get('captcha.re_cap_secret');

        $recaptcha = new ReCaptcha($secret);
        $resp = $recaptcha->verify($captcha, $remoteip);
        if ($resp->isSuccess()) {
            return true;
        } else {
            return false;
        }
    }

}

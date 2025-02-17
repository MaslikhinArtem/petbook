<?php

class Captcha {
    private $url_google_captcha = 'https://www.google.com/recaptcha/api/siteverify';
    private $API_KEY_CAPTCHA = '6Lc9wtMqAAAAAMSB9zC2yEelIlooI5BE9E2hELBA';

    public function verify($response) {
        $data_captcha = [
            'secret' => $this->API_KEY_CAPTCHA,
            'response' => $response,
        ];
        $options_captcha = [
            'http' => [
                'method' => 'POST',
                'content' => http_build_query($data_captcha),
            ],
        ];
        $context_captcha = stream_context_create($options_captcha);
        $verify_captcha = file_get_contents($this->url_google_captcha, false, $context_captcha);
        return json_decode($verify_captcha);
    }
}


?>
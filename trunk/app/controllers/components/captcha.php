<?php
class CaptchaComponent extends Object
{
    function startup(&$controller)
    {
        $this->controller = $controller;
    }

    function render()
    {
        App::import("vendor",'guestbook.kcaptcha');
        $kcaptcha = new KCAPTCHA();
        $this->controller->Session->write('captcha', $kcaptcha->getKeyString());
    }
}
?>
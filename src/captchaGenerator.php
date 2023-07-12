<?php
session_start();
include "./captcha.php";
$captcha = new Captcha();

$captcha_code = $captcha->getCaptchaCode(6);
$captcha->setSession('captcha_code', $captcha_code);
$imageData = $captcha->createCaptchaImage($captcha_code);
$captcha->renderCaptchaImage($imageData);

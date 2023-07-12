<?php

include "./captcha.php";
$captcha = new Captcha();
// if (count($_POST) > 0) {
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['captcha'])) {
    $userCaptcha = $_POST["captcha"];
    $isValidCaptcha = $captcha->validateCaptcha($userCaptcha);

    if ($isValidCaptcha) {

        $username = $_POST["username"];
        $password = $_POST["password"];

        if ($username != "username" && $password != "1234") {
            echo json_encode([
                "status" => "fail",
                "message" => "Username and/or password is not correct!"
            ]);
        } else {
            $_SESSION['isLoggedIn'] = true;
            // $_SESSION['username'] = $username;

            $currentTime = time();
            $currentDate = date('dd/MM/yyyy hh:mm:ss', $currentTime);

            // Set cookie expiration time for 2 weeks
            $expirationTime = $currentTime + 24 * 60 * 60 * 14;

            if (empty($_COOKIE['username']) && empty($_COOKIE['password'])) {
                setcookie('username', $username, $expirationTime);
                setcookie('password', $password, $expirationTime);
            }
            setcookie('remember', $_POST['remember'], $expirationTime);

            echo json_encode([
                "status" => "success",
                "message" => "Login successfully!"
            ]);
        }
    } else {
        echo json_encode([
            "status" => "fail",
            "message" => "Incorrect captcha confirm!"
        ]);
    }
}

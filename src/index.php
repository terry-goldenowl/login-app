<?php
@session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login app</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="./output.css">
</head>

<body>
    <div class="flex w-full gap-3 my-6 justify-center items-start relative">
        <?php
        if (!empty($_SESSION['isLoggedIn'])) {
            header("Location: home.php");
        }
        ?>
        <form method="post" class="main bg-blue-200 rounded-xl p-6 w-80 relative" id="loginForm">
            <p class="text-center text-xl text-orange-600 font-bold">Login</p>
            <?php
            if ($_COOKIE['remember'] == 'true') {
                if (!empty($_COOKIE['username']) && !empty($_COOKIE['password'])) {
                    $username = $_COOKIE['username'];
                    $password = $_COOKIE['password'];
                }
            } else {
                $username = "";
                $password = "";
            }
            ?>
            <div class="flex flex-col gap-1 mt-2">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="<?php echo $username ?>" class="rounded-md py-1 ps-3">
            </div>
            <div class="flex flex-col gap-1 mt-2">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" value="<?php echo $password ?>" class="rounded-md py-1 ps-3">
            </div>

            <div class="flex gap-2 mt-2">
                <div class="flex flex-col gap-1 mt-2 grow">
                    <label for="captcha">Nhập captcha</label>
                    <input type="text" name="captcha" id="captcha" class="rounded-md py-1 ps-3">
                </div>
                <div class="flex flex-col gap-1 mt-2">
                    <p class="text-sm">Captcha</p>
                    <img alt="Captcha" class="rounded-md py-1" id="captchaImage">
                </div>
            </div>
            <div id="message" class="text-red-500 mt-2">

            </div>
            <div class="flex items-center">
                <div class="flex items-center gap-1">
                    <?php $check = $_COOKIE['remember'] == 'false' ? "" : "checked" ?>
                    <?php echo '<input type="checkbox" name="remember" id="remember" ' . $check . '>' ?>

                    <label for="remember" class="italic text-gray-500 text-sm hover:text-gray-700">Remember</label>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="bg-orange-500 text-white py-1 rounded-xl px-8 mt-4 hover:bg-orange-600">Login</button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $("#captchaImage").attr("src", "./captchaGenerator.php")

            $("#loginForm").on("submit", function(e) {
                e.preventDefault()

                const formData = {
                    username: $("#username").val(),
                    password: $("#password").val(),
                    captcha: $("#captcha").val(),
                    remember: $("#remember").is(":checked")
                }

                console.log(formData)
                $("#captcha").val("")

                $.post("login.php", formData).done(function(data, status) {
                    data = JSON.parse(data)
                    if (data['status'] == 'fail') {
                        $("#message").html(data['message'])
                    } else {
                        window.location.href = "home.php"
                    }
                })

                $("#captchaImage").attr("src", "./captchaGenerator.php")
            })
        })
    </script>
</body>

</html>
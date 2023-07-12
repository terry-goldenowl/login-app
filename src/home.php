<?php
@session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./output.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>
    <div class="flex w-full gap-3 my-6 justify-center items-start">
        <div class="bg-blue-200 rounded-xl p-6 w-80">
            <?php
            if (!$_SESSION['isLoggedIn']) {
                header("Location: index.php");
            } else {
                echo "<p class='text-green-600 font-bold text-center mb-3'>You have logged in</p>";
                echo "<p>Username: <span class='font-bold'>" . $_COOKIE['username'] . "</span></p>";
                echo "<p>Password: <span class='font-bold'>" . $_COOKIE['password'] . "</span></p>";
            }
            ?>
            <div class="flex justify-end mt-3">
                <a href="logout.php" class="hover:underline text-blue-600" id="logoutBtn">Log out</a>
            </div>
        </div>
    </div>
    <!-- <script>
        $(document).ready(function() {
            $("#logoutBtn").click(function() {
                window.location.href = "logout.php"
            })
        })
    </script> -->
</body>

</html>
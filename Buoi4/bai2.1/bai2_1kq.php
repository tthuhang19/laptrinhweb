<?php
   $cookie_Fname = "firstName";
   $cookie_Fname_value = htmlspecialchars($_POST["firstname"]);
   setcookie($cookie_Fname, $cookie_Fname_value, time()+(86400*30)); // 86400 = 1 ngay

   $cookie_Lname = "LastName";
   $cookie_Lname_value = htmlspecialchars($_POST["lastname"]);
   setcookie($cookie_Lname, $cookie_Lname_value, time()+(86400*30)); // 86400 = 1 ngay

   $cookie_email = "Email";
   $cookie_email_value = htmlspecialchars($_POST["email"]);
   setcookie($cookie_email, $cookie_email_value, time()+(86400*30)) // 86400 = 1 ngay
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết Quả Lấy Cookies</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        padding: 20px;
    }

    .container {
        background-color: #CCCCFF;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        max-width: 600px;
        margin: auto;
    }

    h2 {
        color: #009999;
        margin-bottom: 20px;
    }

    p {
        margin: 10px 0;
        font-size: 16px;
    }

    .highlight {
        font-weight: bold;
        color: #006666;
    }
    </style>
</head>

<body>
    <div class="container">
        <?php
           echo "<h2>THÔNG TIN NGƯỜI DÙNG LẤY TỪ COOKIE</h2>";
           echo "<h4>Nhấn F5 hoặc biểu tượng restart để lấy cookie</h4>";
           if(!isset($_COOKIE[$cookie_Fname])){
             echo "<p>Cookie firstname ". $cookie_Fname." is not set!</p>";
           }else {
            echo "<p>Cookie ". $cookie_Fname." is set!</p>";
            echo "<p>Value is: ".$_COOKIE[$cookie_Fname]." </p>";
           }

           if(!isset($_COOKIE[$cookie_Lname])){
            echo "<p>Cookie firstname ". $cookie_Lname." is not set!</p>";
           }else {
           echo "<p>Cookie ". $cookie_Lname." is set!</p>";
           echo "<p>Value is: ".$_COOKIE[$cookie_Lname]." </p>";
           }

           if(!isset($_COOKIE[$cookie_email])){
            echo "<p>Cookie firstname ". $cookie_email." is not set!</p>";
           }else {
           echo "<p>Cookie ". $cookie_email." is set!</p>";
           echo "<p>Value is: ".$_COOKIE[$cookie_email]." </p>";
           }
        ?>
    </div>
</body>

</html>
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
           echo "<h2>THÔNG TIN NGƯỜI DÙNG LẤY TỪ SESSION</h2>";
           echo "<h4>Khi nhấn F5 hoặc biểu tượng restart nỗi dung sẽ không thay đổi </h4>";
           $_SESSION["fistname"] = htmlspecialchars($_POST["firstname"]);
           $_SESSION["lastname"] = htmlspecialchars($_POST["lastname"]);
           $_SESSION["email"] = htmlspecialchars($_POST["email"]);
           
           echo "FirstName is: ". $_SESSION["fistname"] . "<br>";
           echo "LastName is: ". $_SESSION["lastname"] . "<br>";
           echo "Email is: ". $_SESSION["email"] . "<br>";

        ?>
    </div>
</body>
</html>
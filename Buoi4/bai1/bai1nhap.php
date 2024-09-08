<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>From 4</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        list-style: none;
        text-decoration: none;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        padding: 20px;
    }

    form {
        background-color: #99CCFF;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 100%;
        max-width: 600px;
        margin: 36px auto;
    }

    .form_header {
        text-align: center;
        margin-bottom: 20px;
    }

    h1 {
        color: #006666;
    }

    table {
        width: 100%;
        margin-bottom: 20px;
    }

    td {
        padding: 10px;
    }

    input[type="text"],
    input[type="checkbox"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        transition: border-color 0.3s;
    }

    input[type="text"]:focus {
        border-color: #4CAF50;
        outline: none;
    }

    input[type="checkbox"] {
        width: auto;
    }

    input[type="checkbox"]+label {
        padding-left: 5px;
    }

    .table_checkbox {
        background-color: #f9f9f9;
        border-radius: 8px;
        padding: 10px;
    }

    .table_checkbox td {
        padding: 5px 10px;
    }

    .submit_button {
        background-color: #9999FF;
        color: black;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
        transition: background-color 0.3s;
    }

    .submit_button:hover {
        background-color: #009999;
    }

    .file-upload {
        margin-bottom: 20px;
    }

    .additional-info {
        margin-bottom: 20px;
    }

    textarea {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 4px;
        transition: border-color 0.3s;
        height: 100px;
    }
    </style>
</head>

<body>
    <form action="bai1kq.php" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"
        enctype="multipart/form-data">
        <div class="form_header">
            <h1>Payment Receipt Upload Form</h1>
        </div>

        <!-- Input Fields -->
        <table class="table_input">
            <tr>
                <td colspan="2">Name</td>
            </tr>
            <tr>
                <td><input autocomplete="username" type="text" name="firstname" required placeholder="First Name"></td>
                <td><input autocomplete="username" type="text" name="lastname" required placeholder="Last Name"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>Invoice ID</td>
            </tr>
            <tr>
                <td><input autocomplete="email" type="text" name="email" required placeholder="example@exaple.com"></td>
                <td><input autocomplete="off" type="text" name="InvoiceID" required placeholder="Invoice ID"></td>
            </tr>
        </table>

        <!-- Checkbox Options -->
        <table class="table_checkbox">
            <tr>
                <td colspan="2">Pay for</td>
            </tr>
            <tr>
                <td><input name="pay_for1" type="checkbox" value="15k Category"><label> 15k Category</label></td>
                <td><input name="pay_for2" type="checkbox" value="35k Category"><label> 35k Category</label></td>
            </tr>
            <tr>
                <td><input name="pay_for3" type="checkbox" value="55k Category"><label> 55k Category</label></td>
                <td><input name="pay_for4" type="checkbox" value="75k Category"><label> 75k Category</label></td>
            </tr>
            <tr>
                <td><input name="pay_for5" type="checkbox" value="116k Category"><label> 116k Category</label></td>
                <td><input name="pay_for6" type="checkbox" value="Shuttle One Way"><label> Shuttle One Way</label></td>
            </tr>
            <tr>
                <td><input name="pay_for7" type="checkbox" value="Shuttle Two Way"><label> Shuttle Two Way</label></td>
                <td><input name="pay_for8" type="checkbox" value="Training Cap Merchandise"><label> Training Cap
                        Merchandise</label></td>
            </tr>
            <tr>
                <td><input name="pay_for9" type="checkbox" value="Compressport-T-Shirt Merchandise"><label>
                        Compressport-T-Shirt Merchandise</label></td>
                <td><input name="pay_for10" type="checkbox" value="Buf Merchandise"><label> Buf Merchandise</label></td>
            </tr>
            <tr>
                <td colspan="2"><input name="pay_for11" type="checkbox" value="Other"><label> Other</label></td>
            </tr>
            <tr>
                <td colspan="3"><label for="fileUpload">Please upload your payment receipt</label></td>
            </tr>
            <tr>
                <td> <input type="file" name="fileUpload" id="fileUpload" accept=".jpg, .jpeg, .png, .gif" required>
                </td>
            </tr>

            <tr>
                <td colspan="3">Additional Information</td>
            </tr>

            <tr>
                <td colspan="3"><textarea name="ad_inf" placeholder=" Typy here"></textarea></td>
            </tr>
        </table>
        <button type="submit" class="submit_button">Submit</button>
    </form>
</body>

</html>
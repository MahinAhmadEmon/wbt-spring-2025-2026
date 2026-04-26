<?php

$emailErr = $passErr = "";
$email = $pass = "";

function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = cleanInput($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }
}
    if (empty($_POST["pass"])) {
        $passErr = "Password is required";
    } else {
        $pass = cleanInput($_POST["pass"]);
        if (strlen($pass) < 8) {
            $passErr = "Password must be at least 8 characters";
        }
}
?>


<!DOCTYPE html>
<html>
<head>
    <style>
            body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        h2 {
            margin-bottom: 5px;
        }

        .form-table {
            border-collapse: collapse;
            width: 600px;
        }

        .form-table td {
            padding: 8px 10px;
            vertical-align: top;
        }

        .form-table td:first-child {
            width: 100px;
            font-weight: bold;
            text-align: right;
            padding-top: 10px;
        }

        .form-table input[type="text"],
        .form-table textarea {
            width: 280px;
            padding: 5px 7px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .form-table textarea {
            resize: vertical;
        }

        .error {
            color: red;
            font-size: 13px;
            display: block;
            margin-top: 3px;
        }

        .required {
            color: red;
        }

        .form-table input[type="submit"] {
            padding: 7px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 14px;
        }

        .form-table input[type="submit"]:hover {
            background-color: #45a049;
        }

        .result-table {
            border-collapse: collapse;
            width: 500px;
            margin-top: 10px;
        }

        .result-table td {
            padding: 7px 12px;
            border: 1px solid #ddd;
        }

        .result-table td:first-child {
            font-weight: bold;
            background-color: #f2f2f2;
            width: 120px;
        }
        .fieldset{
            width: 300px;
            border: 2px solid rgb(255, 121, 121);
            padding: 20px;
            margin: 20px auto;
            border-radius: 20px;
        }
        
    </style>
</head>
<body>
    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <fieldset class="fieldset">
            <h2>Welcome Back</h2>
            <h3>Login to continue<h3>
                <table class="form-table">
                    <tr>
                        <td>email<span class="required">*</span></td>
                        <td>
                            <input type="text" name="email" value="<?= $email ?>">
                            <span class="error"><?= $emailErr ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>pass<span class="required">*</span></td>
                        <td>
                            <input type="text" name="pass" value="<?= $pass ?>">
                            <span class="error"><?= $passErr ?></span>
                        </td>
                    </tr>
                        <tr>
                        <td></td>
                        <td><input type="submit" value="Login"></td>
                        </tr>
                </table>
        </fieldset>
    </form>


<?php if ($_SERVER["REQUEST_METHOD"] == "POST" &&
        !$emailErr && !$passErr): ?>
        <h3>Submitted values</h3>
        <table class="result-table">            
            <tr><td>Email</td><td><?= $email ?></td></tr>
            <tr><td>Pass</td><td><?= $pass ?></td></tr>
        </table>
    <?php endif; ?>
</body>
</html>

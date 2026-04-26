<?php
$nameErr = $emailErr = $websiteErr = $password = $passwordErr = "";
$number = $numberErr = $fname = $lname = $email = $website = $gender = $comment = "";

function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Name
    if (empty($_POST["fname"])) {
        $nameErr = "*Name is required";
    } else {
        $fname = cleanInput($_POST["fname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
            $nameErr = "*Only letters and white space allowed";
        }
    }
    if (empty($_POST["lname"])) {
        $nameErr = "*Name is required";
    } else {
        $lname = cleanInput($_POST["lname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
            $nameErr = "*Only letters and white space allowed";
        }
    }

    // Email
    if (empty($_POST["email"])) {
        $emailErr = "*Email is required";
    } else {
        $email = cleanInput($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "*Invalid email format";
        }
    }

    // Website (optional)
    $website = cleanInput($_POST["website"] ?? "");
    if (!empty($website) && !filter_var($website, FILTER_VALIDATE_URL)) {
        $websiteErr = "*Invalid URL";
    }

    // Comment (optional)
    $comment = cleanInput($_POST["comment"] ?? "");

    

    //contact no
    if (empty($_POST["number"])) {
        $numberErr = "*Number is required";
    } else {
        $number = cleanInput($_POST["number"]);
        if (!preg_match("/^[0-9]*$/", $number)) {
            $numberErr = "*Only numbers are allowed";
        }
    }

    //password validation
    if (empty($_POST["password"])) {
        $passwordErr = "*Password is required";
    } else {
        $password = cleanInput($_POST["password"]);
        if (strlen($password) < 8) {
        $passwordErr = "*Password must be at least 8 characters long";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ramim's Portfolio</title>
    <link rel="stylesheet" type="text/css" href="signup.css">
</head>

<body>
    <h1>Sign up Information</h1>
    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <fieldset class="fieldset">
            <legend>Registration form</legend>
            <table>
                <tr>
                    <td><label for="first name">First Name:</label></td>
                    <td><input type="text" id="first name" name="fname" value="<?= $fname ?>">
                    <span class="error"><?= $nameErr ?></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="last name">Last Name:</label></td>
                    <td><input type="text" id="last name" name="lname" value="<?= $lname ?>">
                    <span class="error"><?= $nameErr ?></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="text" id="email" name="email" value="<?= $email?>">
                    <span class="error"><?= $emailErr ?></span>
                </td>
                </tr>
                <tr>
                    <td><label for="number">Contact Number:</label></td>
                    <td><input type="number" min="0" id="number" name="number" value="<?= $number?>">
                    <span class="error"><?= $numberErr ?></span>
                </td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" id="password" name="password" value="<?= $password?>">
                    <span class="error"><?= $passwordErr ?></span>
                </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Register">
                        <input type="reset" value="reset">
                    </td>
                </tr>


            </table>


        </fieldset>
    </form>
    <br>

</html>
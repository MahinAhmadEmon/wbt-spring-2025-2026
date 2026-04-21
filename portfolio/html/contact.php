
<?php
$nameErr = $emailErr = $websiteErr = $genderErr = "";
$name = $email = $website = $gender = $comment = "";

function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = cleanInput($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    // Email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = cleanInput($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Website (optional)
    $website = cleanInput($_POST["website"] ?? "");
    if (!empty($website) && !filter_var($website, FILTER_VALIDATE_URL)) {
        $websiteErr = "Invalid URL";
    }

    // Comment (optional)
    $comment = cleanInput($_POST["comment"] ?? "");

    // Gender
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = cleanInput($_POST["gender"]);
    }
}
?>




<!DOCTYPE html>
<head>
    <title>
        Contact Me From
    </title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <nav class="menu">
      <ul>
        <li><a href="../index.html">Home</a></li>
        <li><a href="educations.html">Education</a></li>
        <li><a href="experience.html">Experience</a></li>
        <li><a href="projects.html">Projects</a></li>
        <li><a href="contact.html">Contact</a></li>
      </ul>
    </nav>


    <h2>Contact Me from</h2>
    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table>
            <tr>
                <td>First Name: <span class="required">*</span></td>
                <td><input type="text" name="name" value="<?= $name ?>">
                    <span style="color:red">* <?= $nameErr ?></span><br><br></td>
            </tr>
            <tr>
                <td>Last Name: <span class="required">*</span></td>
                <td><input type="text" name="name" value="<?= $name ?>">
                    <span style="color:red">* <?= $nameErr ?></span><br><br></td>
            </tr>
            <tr>
                <td>Gender <span class="required">*</span></td>
                <td><input type="radio" name="gender" value="female" <?= ($gender == "female") ? "checked" : "" ?>> Female
                    <input type="radio" name="gender" value="male" <?= ($gender == "male") ? "checked" : "" ?>> Male
                    <span style="color:red">* <?= $genderErr ?></span><br><br>
                </td>
            </tr>
            <tr>
                <td>Email <span class="required">*</span></td>
                <td><input type="text" name="email" value="<?= $email ?>">
                    <span style="color:red">* <?= $emailErr ?></span><br><br></td>
            </tr>
            <tr>
                <td>Company <span class="required">*</span></td>
                <td><input type="text" name="name" value="<?= $name ?>">
                    <span class="error"><?= $nameErr ?></span></td>
            </tr>
            <tr>
                <td>Reason for contact <span class="required">*</span></td>
                <td><input type="checkbox" value="Project">Project
                    <input type="checkbox" value="Thesis">Thesis
                    <input type="checkbox" value="Job">Job
                </td>
            </tr>

            <tr>
                <td>Topic <span class="required">*</span></td>
                <td> <input type="checkbox" value="Web Development">Web Development </td>
                <td> <input type="checkbox" value="Mobile Development">Mobile Development</td>
                <td> <input type="checkbox" value="AI/ML Development">AI/ML Development</td>
            </tr>

            <tr>
                <td>Consultion Date:</td>
                <td><input type="date" required></td>
            </tr>


        </table>

        <table>
            <tr>
                <input type="Submit" value="Register">
            </tr><br>
            <tr>
                <input type="reset" value="Reset">
            </tr>
        </table>
    </form>

    <footer class="footer">
        <h3>My socials</h3>
        <a href="https://www.linkedin.com/in/mahin-ahmad-emon-5a2ab5274/" target="_blank">
            <img src="../data/linkedin.png" alt="LinkedIn" width="35">
        </a>
        <a href="https://github.com/MahinAhmadEmon" target="_blank">
            <img src="../data/github.png" alt="GitHub" width="35">
        </a>
    </footer>

</body>


</html>
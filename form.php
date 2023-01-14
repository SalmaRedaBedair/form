<!DOCTYPE html>
<html>

<head>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>

<body>
    <?php
    $name = $email = $website = $comment = $gender = "";
    $nameErr = $emailErr = $websiteErr = $commentErr = $gendeErr = "";
    function test($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test($_POST["name"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name))
                $nameErr = "only letters and white spaces are allowed";
        }
        if (empty($_POST["email"])) {
            $emailErr = "email is required";
        } else {
            $email = test($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                $emailErr = "Invalid email format";
        }
        if (!empty($_POST["website"])) {
            $website = test($_POST["website"]);
            if (!filter_var($website, FILTER_VALIDATE_URL))
                $websiteErr = "Invalid url format";
        }
        if (empty($_POST["gender"])) {
            $gendeErr = "gender is required";
        } else
            $gender = $_POST["gender"];
        if (!empty($_POST['comment']))
            $comment = test($_POST["comment"]);
    }

    ?>
    <h2>PHP Form Validation Example</h2>
    <div class="error">
        <span>* </span>
        required field
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        </br>
        Name: <input type="text" name="name" value="<?php echo $name; ?>"><span class="error">* <?php echo $nameErr; ?></span>
        </br></br>
        E-mail: <input type="text" name="email" value="<?php echo $email; ?>"><span class="error">* <?php echo $emailErr; ?></span>
        </br></br>
        Website: <input type="text" name="website" value="<?php echo $website; ?>"><span class="error"> <?php echo $websiteErr; ?></span>
        </br></br>
        Comment: <textarea type="text" name="comment"><?php echo $comment; ?>
        </textarea>
        </br></br>
        Gender: <input type="radio" name="gender" <?php if (isset($gender) && $gender == "female") echo "checked"; ?> value="female">Female
        <input type="radio" name="gender" <?php if (isset($gender) && $gender == "male") echo "checked"; ?> value="male">Male
        <input type="radio" name="gender" <?php if (isset($gender) && $gender == "other") echo "checked"; ?> value="other">Other
        <span class="error">* <?php echo $gendeErr; ?></span>
        </br></br>
        <input type="submit" name="submit" value="submit">
    </form>
    <?php
    echo "<h2>Your Input:</h2>";
    echo $name;
    echo "<br>";
    echo $email;
    echo "<br>";
    echo $website;
    echo "<br>";
    echo $comment;
    echo "<br>";
    echo $gender;
    ?>
</body>

</html>
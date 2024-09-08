<?php

if ($_SESSION["signinstatus"] != 1 && $_SERVER["REQUEST_METHOD"] == "POST") {
    $last_name = $last_nameErr = $first_name = $first_nameErr = $username = $usernameErr = $password = $passwordErr = $re_password = $re_passwordErr = $email = $emailErr = $numberphone = $numberErr = $address = $addressErr = "";

    if (empty($_POST["last_name"])) {
        $last_nameErr = "Last Name is required";
    } else {
        $last_name = test_input($_POST["last_name"]);
    }

    if (empty($_POST["first_name"])) {
        $first_nameErr = "First Name is required";
    } else {
        $first_name = test_input($_POST["first_name"]);
    }

    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = test_input($_POST["username"]);
        $query = "SELECT username FROM user_info WHERE username = ?";
        $stmt = $Conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows != 0) {
            $usernameErr = "Username already exists.";
        }
        $stmt->close();
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
    }

    if (empty($_POST["re_password"])) {
        $re_passwordErr = "Repeat Password is required";
    } else {
        $re_password = test_input($_POST["re_password"]);
        if ($password != $re_password) {
            $re_passwordErr = "Passwords do not match.";
        }
    }

    if (empty($_POST["numberphone"])) {
        $numberErr = "Phone number is required";
    } else {
        $numberphone = test_input($_POST["numberphone"]);
        if (!preg_match("/^[0-9]*$/", $numberphone)) {
            $numberErr = "Only numbers are allowed.";
        } else {
            $query = "SELECT phone FROM user_info WHERE phone = ?";
            $stmt = $Conn->prepare($query);
            $stmt->bind_param("s", $numberphone);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows != 0) {
                $numberErr = "Phone number already exists.";
            }
            $stmt->close();
        }
    }

    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
    } else {
        $address = test_input($_POST["address"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        } else {
            $query = "SELECT email FROM user_info WHERE email = ?";
            $stmt = $Conn->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows != 0) {
                $emailErr = "Email already exists.";
            }
            $stmt->close();
        }
    }

    if (empty($last_nameErr) && empty($first_nameErr) && empty($usernameErr) && empty($passwordErr) && empty($re_passwordErr) && empty($numberErr) && empty($addressErr) && empty($emailErr)) {
        $query = "INSERT INTO user_info (first_name, last_name, username, password, email, address, phone, status) VALUES (?, ?, ?, ?, ?, ?, ?, 1)";
        $stmt = $Conn->prepare($query);
        $stmt->bind_param("sssssss", $first_name, $last_name, $username, $password, $email, $address, $numberphone);

        if ($stmt->execute()) {
            $query = "SELECT userinfo_id FROM user_info WHERE username = ?";
            $stmt = $Conn->prepare($query);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            $_SESSION["signupstatus"] = 1;
            $_SESSION["signinstatus"] = 1;
            $_SESSION["accountname"] = $username;
            $_SESSION["typeaccount"] = "user";
            $_SESSION["accountpassword"] = $password;
            $_SESSION["account_id"] = $row["userinfo_id"];
            echo '<script>alert("Created User Success!");</script>';
        } else {
            echo '<script>alert("Created User failed!");</script>';
        }
    } else {
        echo '<script>alert("You have some warnings in your information");</script>';
    }
}
?>

<div class="canvas hide">
    <div class="box">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" target="_self">
            <div class="info">
                <p>First Name</p>
                <input type="text" placeholder="First name" autocomplete="on" name="first_name"> 
                <span class="error">* <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["signinstatus"] != 1) echo $first_nameErr; ?></span>
            </div>
            <div class="info">
                <p>Last Name</p>
                <input type="text" placeholder="Last name" autocomplete="on" name="last_name">
                <span class="error">* <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["signinstatus"] != 1) echo $last_nameErr; ?></span>
            </div>
            <div class="info">
                <p>Username</p>
                <input type="text" placeholder="Username" autocomplete="on" name="username">
                <span class="error">* <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["signinstatus"] != 1) echo $usernameErr; ?></span>
            </div>
            <div class="info">
                <p>Password</p>
                <input type="password" placeholder="Password" autocomplete="on" name="password">
                <span class="error">* <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["signinstatus"] != 1) echo $passwordErr; ?></span>
            </div>
            <div class="info">
                <p>Repeat Password</p>
                <input type="password" placeholder="Repeat Password" autocomplete="on" name="re_password">
                <span class="error">* <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["signinstatus"] != 1) echo $re_passwordErr; ?></span>
            </div>
            <div class="info">
                <p>Email</p>
                <input type="text" placeholder="Email" autocomplete="on" name="email">
                <span class="error">* <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["signinstatus"] != 1) echo $emailErr; ?></span>
            </div>
            <div class="info">
                <p>Address</p>
                <input type="text" placeholder="Address" autocomplete="on" name="address">
                <span class="error">* <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["signinstatus"] != 1) echo $addressErr; ?></span>
            </div>
            <div class="info">
                <p>Phone Number</p>
                <input type="text" placeholder="Phone Number" autocomplete="on" name="numberphone">
                <span class="error">* <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["signinstatus"] != 1) echo $numberErr; ?></span>
            </div>
            <button type="submit">Sign Up</button>
        </form>
    </div>
</div>

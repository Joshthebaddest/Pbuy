<?php
    include_once __DIR__ . '/../../config/globalConfig.php';
    $dir = realpath(__DIR__);
    include($dir.'/../data.php');
    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullname = test_input($_POST["fullname"]);
        $username = test_input($_POST["username"]);
        $email = test_input($_POST["email"]);
        $country = test_input($_POST["country"]);
        $password = test_input($_POST["password"]);
        $confirmPassword = test_input($_POST["confirm_password"]);

        validate_form($fullname, $username, $email, $country, $password, $confirmPassword);

        if (empty($errors)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $rawToken = bin2hex(random_bytes(32)); // 64 characters (256 bits)
            $tokenHash = hash('sha256', $rawToken);
            $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));
                
            require_once __DIR__ . '/../models/users.php';

            try {
                User::create([
                    'fullname' => $fullname,
                    'username' => $username,
                    'email' => $email,
                    'country' => $country,
                    'password_hash' => $hashed_password,
                    'email_verification_token' => $tokenHash,
                    'email_verification_expires' => $expires_at
                ]);
                header('Location: '. BASE_PATH. 'auth/verify-email?token='.$rawToken);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            // print_r($errors); // to debug
        }
    }

    function test_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    function validate_form($fullname, $username, $email, $country, $password, $confirmPassword) {
        global $errors;

        if (empty($fullname)) {
            $errors["fullname"] = "Full Name is required";
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $fullname)) {
            $errors["fullname"] = "Only letters and white space allowed";
        }
        if (empty($username)) {
            $errors["username"] = "Username is required";
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
            $errors["username"] = "Only letters and white space allowed";
        }

        if (empty($email)) {
            $errors["email"] = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Invalid email format";
        }

        if (empty($country)) {
            $errors["country"] = "Country is required";
        }

        if (empty($password)) {
            $errors["password"] = "Password is required";
        } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).{8,}$/', $password)) {
            $errors["password"] = "Password must have uppercase, lowercase, number, special character, and be 8+ chars long.";
        }

        if (empty($confirmPassword)) {
            $errors["confirm_password"] = "Please confirm your password";
        } elseif ($confirmPassword !== $password) {
            $errors["confirm_password"] = "Passwords do not match";
        }
    }

?>

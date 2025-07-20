<?php
    require_once __DIR__ . '/../../config/globalConfig.php';
    require_once __DIR__ .'/../models/users.php';
    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userInfo = test_input($_POST["userInfo"]);
        $password = test_input($_POST["password"]);

        if(empty($_POST["userInfo"] || empty($_POST["password"]))){
            $error = "please enter a valid field";
        }else{
            try{
                $user = User::query()
                    ->select('username', 'email', 'password_hash', 'email_verified', 'role')
                    ->where('email', $userInfo)
                    ->orWhere('username', $userInfo)
                    ->first();
                if(!empty($user)){
                    if($user['email_verified'] === 1){
                        $username = $user['username'];
                        $email = $user['email'];
                        $passwordHash = $user['password_hash'];
                        $role = $user['role'];

                        $verify = password_verify($password, $passwordHash);
                        if($verify){
                            require_once __DIR__ . '/../../config/sessionConfig.php';
                            $_SESSION['user'] = $username;
                            $_SESSION['email'] = $email;
                            $_SESSION['role'] = $role;
                            $_SESSION['toast'] = [
                                'message' => 'Logged in successfully!',
                                'type' => 'success' // success | error | info
                            ];

                            // redirect to homepage
                            header("Location: " .BASE_PATH ."dashboard");
                            $_SESSION['toast'] = [
                                'message' => 'Login Successful!',
                                'type' => 'success' // success | error | info
                            ];
                            exit();
                        }else{
                            $errors['error'] = 'invalid credentials';
                        }
                    }else{
                        $rawToken = bin2hex(random_bytes(32)); // 64 characters (256 bits)
                        $tokenHash = hash('sha256', $rawToken);
                        $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));
                        $email = $user['email'];

                        User::update(['email' => $email], ['email_verification_token' => $tokenHash, 'email_verification_expires' => $expires_at]);
                        header('Location: '. BASE_PATH .'auth/verify-email?token='. urlencode($rawToken));
                        $_SESSION['toast'] = [
                            'message' => 'Email Verification Sent!',
                            'type' => 'success' // success | error | info
                        ];
                        exit();
                    }
                }
                $errors['error'] = 'invalid credentials';
                $_SESSION['toast'] = [
                    'message' => 'invalid credentials!',
                    'type' => 'error' // success | error | info
                ];
                header('Location: '. BASE_PATH . 'auth/login');
                exit();
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }

    function test_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

?>

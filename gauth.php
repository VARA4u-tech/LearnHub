<?php
session_start();
require_once 'config/database.php';
require_once 'vendor/autoload.php';
require_once 'includes/google_api_helper.php';

$database = new Database();
$pdo = $database->getConnection();

$client = get_google_client();

if (isset($_GET['code'])) {
    // Exchange authorization code for access token
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['google_access_token'] = $token;
    $client->setAccessToken($token['access_token']);

    // Get user profile information
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email = $google_account_info->email;
    $name = $google_account_info->name;

    // Check if user exists in your database
    $sql = "SELECT id, name, email FROM users WHERE email = :email";
    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        if ($stmt->execute()) {
            if ($stmt->rowCount() == 1) {
                // User exists, log them in
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $user["id"];
                $_SESSION["name"] = $user["name"];
                $_SESSION["email"] = $user["email"];

                header("location: dashboard.php");
                exit;
            } else {
                // User does not exist, register them
                $placeholder_password = password_hash(uniqid(), PASSWORD_DEFAULT);

                $sql_insert = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
                if ($stmt_insert = $pdo->prepare($sql_insert)) {
                    $stmt_insert->bindParam(":name", $name, PDO::PARAM_STR);
                    $stmt_insert->bindParam(":email", $email, PDO::PARAM_STR);
                    $stmt_insert->bindParam(":password", $placeholder_password, PDO::PARAM_STR);

                    if ($stmt_insert->execute()) {
                        // Successfully registered, now log them in
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $pdo->lastInsertId();
                        $_SESSION["name"] = $name;
                        $_SESSION["email"] = $email;
                        
                        header("location: dashboard.php");
                        exit;
                    } else {
                        echo "Something went wrong during registration. Please try again later.";
                    }
                }
            }
        }
    }
} else {
    // If not a callback, redirect to Google's login page
    $authUrl = $client->createAuthUrl();
    header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
    exit;
}
?>
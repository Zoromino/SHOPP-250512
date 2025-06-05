<?php
require_once("Models/UserDatabase.php");
require_once("Models/UserDetails.php");
require_once("Classes/Database.php");

$dotenv = Dotenv\Dotenv::createImmutable(".");
$dotenv->load();

$dbContext = new Database();

$errorMessage = "";
$username = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // $cart = new Cart($dbContext, session_id(), null);
        $dbContext->getUserDatabase()->getAuth()->login($username, $password);
        // $cart->convertSessionToUser($dbContext->getUserDatabase()->getAuth()->getUserId(),session_id());

        header('Location: /');
        exit;

    } catch (\Delight\Auth\InvalidEmailException $e) {
        die('Wrong email address');
    } catch (\Delight\Auth\InvalidPasswordException $e) {
        die('Wrong password');
    } catch (\Delight\Auth\EmailNotVerifiedException $e) {
        die('Email not verified');
    } catch (\Delight\Auth\TooManyRequestsException $e) {
        die('Too many requests');
    }
}

?>
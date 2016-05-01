<?php
/**
 * Created by PhpStorm.
 * User: Y
 * Date: 4/29/2016
 * Time: 11:20 PM
 */

require_once "Classes\\User.php";

define('ACTION_LOGIN', 'login');
define('FILE_WITH_CREDENTIALS_NAME', 'pas.txt');


session_start();
$loginFailed = false;
if (isset($_SESSION['session']) && $_SESSION['session'] === true) {
    // session is set - redirect to main page
    header('Location: http://localhost/GalleryOOP/index.php');
} elseif (isset($_POST['action']) && $_POST['action'] === ACTION_LOGIN && isset($_POST['login']) && isset($_POST['password'])) {
    // initialize User credentials handler class
    $user = new User(FILE_WITH_CREDENTIALS_NAME);

    // try to login
    if ($user->login($_POST['login'], $_POST['password'])){
        // login succeded - redirect to main page
        header('Location: http://localhost/GalleryOOP/index.php');
    } else {
        // login failed - add according message
        $loginFailed = true;

        // TODO: failed login results in adding new user
        $user->add($_POST['login'], $_POST['password']);
    }
}
?>

<link rel="stylesheet" type="text/css" href="CSS\\styleLogin.css">
<h1>Login page</h1>
<?php if ($loginFailed) echo '<span>Login failed</span>'; ?>
<form method="post">
    <input type="hidden" name="action" value="<?php echo ACTION_LOGIN;?>">

    <div>
        <label for="login">Login: </label>
        <input type="text" name="login" id="login" value="Y">
    </div>

    <div>
        <label for="password">Password: </label>
        <input type="text" name="password" id="password" value="111">
    </div>
    <br>
    <div class="container">
        <input class="centeredButton" type="submit" name="Enter">
    </div>
</form>

<?php
session_start();
$_SESSION['logged_in'] = false;
$valid_login = 'admin';
$valid_password = 'haslo123';

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header('Location: zad3.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    if ($login == $valid_login && $password == $valid_password) {
        $_SESSION['logged_in'] = true;
        $_SESSION['user'] = $login;
    } else {
        $error_message = 'Nieprawidłowy login lub hasło!';
    }
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularz logowania</title>
</head>
<body>

<?php if ($_SESSION['logged_in']): ?>
    <h1>Witaj, <?php echo $_SESSION['user']; ?>!</h1>
    <p>Jesteś zalogowany.</p>
    <a href="?action=logout">Wyloguj</a>
<?php else: ?>
    <h1>Logowanie</h1>
    <?php if (!empty($error_message)): ?>
        <p><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login">
        <br><br>
        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password">
        <br><br>
        <button type="submit">Zaloguj</button>
    </form>
<?php endif; ?>

</body>
</html>
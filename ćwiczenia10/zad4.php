<?php
session_start();

function validate_password($password) {
    return strlen($password) >= 6 &&
        preg_match('/[A-Z]/', $password) &&
        preg_match('/\d/', $password) &&
        preg_match('/[\W_]/', $password);
}

function email_exists($email) {
    if (!file_exists('users.txt')) {
        return false;
    }
    $users = file('users.txt', FILE_IGNORE_NEW_LINES);
    foreach ($users as $user) {
        $data = explode('|', $user);
        if ($data[2] === $email) {
            return true;
        }
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!$firstName || !$lastName || !$email || !$password) {
        $error = 'Wszystkie pola są wymagane!';
    } elseif (email_exists($email)) {
        $error = 'Podany adres email już istnieje!';
    } elseif (!validate_password($password)) {
        $error = 'Hasło musi mieć co najmniej 6 znaków, zawierać wielką literę, cyfrę i znak specjalny!';
    } else {
        $entry = implode('|', [$firstName, $lastName, $email, $password]);
        file_put_contents('users.txt', $entry, FILE_APPEND);
        $success = 'Rejestracja zakończona sukcesem! Możesz się teraz zalogować.';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!file_exists('users.txt')) {
        $error = 'Brak zarejestrowanych użytkowników!';
    } else {
        $users = file('users.txt', FILE_IGNORE_NEW_LINES);
        foreach ($users as $user) {
            $data = explode('|', $user);
            if ($data[2] == $email && $data[3] == $password) {
                $_SESSION['user'] = ['firstName' => $data[0], 'lastName' => $data[1], 'email' => $data[2]];
                $success = 'Zalogowano pomyślnie!';
                break;
            }
        }
        if (!isset($_SESSION['user'])) {
            $error = 'Nieprawidłowy email lub hasło!';
        }
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: auth.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja i Logowanie</title>
</head>
<body>
<h1>Rejestracja i Logowanie</h1>

<?php if (isset($error)): ?>
    <p style="color: red;"><?= $error ?></p>
<?php endif; ?>

<?php if (isset($success)): ?>
    <p style="color: green;"><?= $success ?></p>
<?php endif; ?>

<?php if (!isset($_SESSION['user'])): ?>
    <h2>Rejestracja</h2>
    <form method="POST">
        <label>
            Imię: <input type="text" name="firstName" required>
        </label><br>
        <label>
            Nazwisko: <input type="text" name="lastName" required>
        </label><br>
        <label>
            Email: <input type="email" name="email" required>
        </label><br>
        <label>
            Hasło: <input type="password" name="password" required>
        </label><br>
        <button type="submit" name="register">Zarejestruj się</button>
    </form>

    <h2>Logowanie</h2>
    <form method="POST">
        <label>
            Email: <input type="email" name="email" required>
        </label><br>
        <label>
            Hasło: <input type="password" name="password" required>
        </label><br>
        <button type="submit" name="login">Zaloguj się</button>
    </form>
<?php else: ?>
    <h2>Witaj, <?= $_SESSION['user']['firstName'] ?>!</h2>
    <p>Jesteś zalogowany jako <?= $_SESSION['user']['email'] ?></p>
    <a href="?logout">Wyloguj się</a>
<?php endif; ?>
</body>
</html>
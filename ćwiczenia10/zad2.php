<?php
session_start();

if (!isset($_SESSION['pollResults'])) {
    $_SESSION['pollResults'] = [
        'Tak' => 0,
        'Nie' => 0,
    ];
}

$pollResults = &$_SESSION['pollResults'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_COOKIE['hasVoted'])) {
    $vote = $_POST['vote'];

    if ($vote && isset($pollResults[$vote])) {
        $pollResults[$vote]++;

        setcookie('hasVoted', true, time() + (3600 * 24 ));
        $message = "Dziękujemy za głos!";
    } else {
        $message = "Nieprawidłowy wybór.";
    }
} elseif (isset($_COOKIE['hasVoted'])) {
    $message = "Oddałeś już głos. Dziękujemy!";
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sonda internetowa</title>
</head>
<body>
<h1>Sonda internetowa</h1>

<?php if (!isset($_COOKIE['hasVoted'])): ?>
    <form method="post">
        <p>Lubisz wprg?</p>
            <label>
                <input type="radio" name="vote" value="Tak">
                Tak
            </label>
        <br>
        <label>
            <input type="radio" name="vote" value="Nie">
            Nie
        </label>
        <br>
        <button type="submit">Głosuj</button>
    </form>
<?php else: ?>
    <p>Oddałeś już głos w tej sondzie.</p>
<?php endif; ?>

<h2>Wyniki</h2>
<ul>
    <?php foreach ($pollResults as $option => $votes): ?>
        <li><?php echo $option; ?>: <?php echo $votes; ?> głosów</li>
    <?php endforeach; ?>
</ul>

<?php if (isset($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
</body>
</html>
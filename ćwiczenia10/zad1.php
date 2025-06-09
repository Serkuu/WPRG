<?php
$achievement = 10;

if (isset($_POST['reset'])) {
    setcookie('visit_count', '', time() - 3600);
    header('Location: zad1.php');
    exit;
}

$visitCount = isset($_COOKIE['visit_count']) ? (int)$_COOKIE['visit_count'] : 0;

$visitCount++;
setcookie('visit_count', $visitCount, time() + 3600 * 24);

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Licznik odwiedzin</title>
</head>
<body>
<p>Liczba twoich odwiedzin: <strong><?php echo $visitCount; ?></strong></p>

<?php if ($visitCount >= $achievement){
    echo '<p>Gratulacje! Osiągnąłeś 10 odwiedzin</p>';
} ?>

<form method="post">
    <button type="submit" name="reset">Resetuj licznik odwiedzin</button>
</form>
</body>
</html>
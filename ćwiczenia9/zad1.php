<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Urodzenia</title>
</head>
<body>
<form method="GET" action="">
    <label for="birth_date">Podaj datę urodzenia:</label>
    <input type="date" id="birth_date" name="birth_date" required>
    <button type="submit">Sprawdź</button>
</form>

<?php
if (isset($_GET['birth_date'])) {
    $birthDate = $_GET['birth_date'];

    echo "<h2>Twoje dane:</h2>";
    echo "<p><strong>Data urodzenia:</strong> $birthDate</p>";
    echo "<p><strong>Dzień tygodnia:</strong> " . getDayOfWeek($birthDate) . "</p>";
    echo "<p><strong>Ukończony wiek:</strong> " . getAge($birthDate) . " lat(a)</p>";
    echo "<p><strong>Dni do najbliższych urodzin:</strong> " . getDaysToNextBirthday($birthDate) . " dni</p>";
}

function getDayOfWeek($date) {
    $daysOfWeek = ['Niedziela', 'Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota'];
    $timestamp = strtotime($date);
    return $daysOfWeek[date('w', $timestamp)];
}

function getAge($date) {
    $birthDate = new DateTime($date);
    $today = new DateTime();
    $age = $today->diff($birthDate)->y;
    return $age;
}

function getDaysToNextBirthday($date) {
    $today = new DateTime();
    $birthDate = new DateTime($date);
    $nextBirthday = (clone $birthDate)->setDate($today->format('Y'), $birthDate->format('m'), $birthDate->format('d'));

    if ($today > $nextBirthday) {
        $nextBirthday->modify('+1 year');
    }

    return $nextBirthday->diff($today)->days;
}
?>
</body>
</html>
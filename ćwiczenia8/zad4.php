<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Liczba samogłosek</title>
</head>
<body>
<form method="POST" action="">
    <label for="input">Wpisz ciąg znaków:</label>
    <br>
    <input type="text" id="input" name="input">
    <br>
    <button type="submit">Oblicz</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = $_POST['input'];

    $samogloski = ['a', 'e', 'i', 'o', 'u'];

    $samoCount = 0;

    foreach (str_split(strtolower($input)) as $char) {
        if (in_array($char, $samogloski)) {
            $samoCount++;
        }
    }

    echo "<h2>Wyniki:</h2>";
    echo "Wprowadzony ciąg:" . htmlentities($input) . "<br>";
    echo "Liczba samogłosek: " . $samoCount . "";
}
?>
</body>
</html>

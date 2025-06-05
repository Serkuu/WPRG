<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularz - Operacje na ciągu znaków</title>
</head>
<body>
<form method="post" action="">
    <label for="input">Wprowadź ciąg znaków:</label><br>
    <input type="text" id="input" name="input"><br><br>
    <button type="submit">Wyślij</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['inputText'])) {
    $input = $_POST['input'];

    echo "<p><strong>Ciąg dużymi literami:</strong> " . strtoupper($input) . "</p>";
    echo "<p><strong>Ciąg małymi literami:</strong> " . strtolower($input) . "</p>";
    echo "<p><strong>Pierwsza litera dużą literą:</strong> " . ucfirst(strtolower($input)) . "</p>";
    echo "<p><strong>Każde słowo dużą literą:</strong> " . ucwords(strtolower($input)) . "</p>";
}
?>
</body>
</html>

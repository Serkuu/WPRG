<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liczenie cyfr po przecinku</title>
</head>
<body>
<h1>Policz cyfry po przecinku</h1>

<form method="post">
    <label for="number">Wpisz liczbę zmiennoprzecinkową:</label><br>
    <input type="text" id="number" name="number" required><br><br>
    <button type="submit">Policz</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = trim($_POST["number"]);

    if (is_numeric($input)) {
        $parts = explode('.', $input);

        if (count($parts) == 2) {
            $fractionLength = strlen($parts[1]);
            echo "<p>Liczba cyfr po przecinku: <strong>$fractionLength</strong></p>";
        } else {
            echo "<p>Brak cyfr po przecinku</p>";
        }
    } else {
        echo "<p>Error</p>";
    }
}
?>
</body>
</html>

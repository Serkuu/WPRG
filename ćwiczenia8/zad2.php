<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuń niepożądane znaki</title>
</head>
<body>
<form method="post" action="">
    <label for="inputNumbers">Wprowadź ciąg liczb:</label><br>
    <input type="text" id="inputNumbers" name="inputNumbers"><br><br>
    <button type="submit">Wyślij</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['inputNumbers'])) {
    $input = $_POST['inputNumbers'];

    $sanitizedInput = preg_replace('/[\\\\\/\:\*\?\"\<\>\|\+\-\.\ ]/', '', $input);

    echo "<h2>Wynik:</h2>";
    echo "<p><strong>Oryginalny ciąg:</strong> " . $input . "</p>";
    echo "<p><strong>Ciąg bez niepożądanych znaków:</strong> " . $sanitizedInput . "</p>";
}
?>
</body>
</html>

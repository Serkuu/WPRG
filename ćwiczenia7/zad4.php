<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularz rejestracyjny</title>
</head>
<body>
<div class="form-container">
    <h2>Formularz rejestracyjny</h2>
    <form method="post" action="">
        <div class="form-row">
            <label for="imie">Imię:</label>
            <input type="text" id="imie" name="imie">
        </div>

        <div class="form-row">
            <label for="nazwisko">Nazwisko:</label>
            <input type="text" id="nazwisko" name="nazwisko">
        </div>

        <div class="form-row">
            <label for="email">Adres email:</label>
            <input type="email" id="email" name="email">
        </div>

        <div class="form-row">
            <label for="haslo">Hasło:</label>
            <input type="password" id="haslo" name="haslo">
        </div>

        <div class="form-row">
            <label for="potwierdz_haslo">Potwierdź hasło:</label>
            <input type="password" id="potwierdz_haslo" name="potwierdz_haslo">
        </div>

        <div class="form-row">
            <label for="wiek">Wiek:</label>
            <input type="text" id="wiek" name="wiek">
        </div>

        <button type="submit">Zarejestruj się</button>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['haslo'] == $_POST['potwierdz_haslo']) {
    echo "<div class='form-container' style='margin-top: 20px;'>";
    echo "<h2>Wprowadzone dane:</h2>";
    echo "<table border='1' style='width: 100%; border-collapse: collapse;'>";

        $dane = [
            "Imię" => $_POST['imie'],
            "Nazwisko" => $_POST['nazwisko'],
            "Adres email" => $_POST['email'],
            "Hasło" => str_repeat('*', strlen($_POST['haslo'])),
            "Wiek" => $_POST['wiek']
        ];

        foreach ($dane as $naglowek => $wartosc) {
            echo "<tr>";
            echo "<td style='font-weight: bold; background-color: #f2f2f2;'>$naglowek</td>";
            echo "<td>$wartosc</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</div>";
    }
    else{
        echo "Hasła sie nie zgadzaja";
    }
}
?>
</body>
</html>
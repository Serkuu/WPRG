<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator prosty i zaawansowany</title>
</head>
<style>
    body {
        background-color: #1f1f1f;
        color: lightgray;
        font-family: Arial, Helvetica, sans-serif;
    }
    .container {
        width: 20%;
        margin: 0 auto;
        padding: 10px;
        border-style: solid;
        border-width: 5px;
        border-color: cornflowerblue;
    }
</style>
<body>
<div class="container">
<h1>Kalkulator</h1>
<hr>
<h2>Prosty</h2>
<form action="" method="post">
    <label for="liczba1"></label>
    <input type="number" step="any" id="liczba1" name="liczba1">

    <label for="operacja"></label>
    <select id="operacja" name="operacja">
        <option value="+">Dodawanie</option>
        <option value="-">Odejmowanie</option>
        <option value="*">Mnożenie</option>
        <option value="/">Dzielenie</option>
    </select>

    <label for="liczba2"></label>
    <input type="number" step="any" id="liczba2" name="liczba2">

    <button type="submit" name="prosty">Oblicz</button>
</form>
<hr>
<h2>Zaawansowany</h2>
<form action="" method="post">
    <label for="wartosc"></label>
    <input type="text" id="wartosc" name="wartosc">

    <label for="dzialanie"></label>
    <select id="dzialanie" name="dzialanie">
        <option value="cos">cos</option>
        <option value="sin">sin</option>
        <option value="tan">tg</option>
        <option value="binNaDec">Binarne na dziesiętne</option>
        <option value="decNaBin">Dziesiętne na binarne</option>
        <option value="decNaHex">Dziesiętne na szesnastkowe</option>
        <option value="hexNaDec">Szesnastkowe na dziesiętne</option>
    </select>
    <button type="submit" name="zaawansowany">Oblicz</button>
</form>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['prosty'])) {
        $liczba1 = floatval($_POST['liczba1']);
        $liczba2 = floatval($_POST['liczba2']);
        $operacja = $_POST['operacja'];

        $wynik = kalkulatorProsty($liczba1, $liczba2, $operacja);
        echo "<h3>Wynik kalkulatora prostego:</h3>";
        echo "<p>$liczba1 $operacja $liczba2 = $wynik</p>";
    }

    if (isset($_POST['zaawansowany'])) {
        $typ = $_POST['dzialanie'];
        $wartosc = $_POST['wartosc'];

        if (in_array($typ, ['cos', 'sin', 'tan', 'decNaBin', 'decNaHex'])) {
            $wartosc = floatval($wartosc);
        }

        $wynik = kalkulatorZaawansowany($typ, $wartosc);
        echo "<h3>Wynik kalkulatora zaawansowanego:</h3>";
        echo "<p>Działanie: $typ, Wartość: $wartosc = $wynik</p>";
    }
}
function kalkulatorProsty($liczba1, $liczba2, $operacja)
{
    switch ($operacja) {
        case '+':
            return $liczba1 + $liczba2;
        case '-':
            return $liczba1 - $liczba2;
        case '*':
            return $liczba1 * $liczba2;
        case '/':
            if ($liczba2 == 0) {
                return "Dzielenie przez zero nie jest dozwolone.";
            }
            return $liczba1 / $liczba2;
        default:
            return "Nieznana operacja.";
    }
}

function kalkulatorZaawansowany($typ, $wartosc)
{
    switch ($typ) {
        case 'cos':
            return cos(deg2rad($wartosc));
        case 'sin':
            return sin(deg2rad($wartosc));
        case 'tan':
            return tan(deg2rad($wartosc));
        case 'binNaDec':
            return bindec($wartosc);
        case 'decNaBin':
            return decbin($wartosc);
        case 'decNaHex':
            return dechex($wartosc);
        case 'hexNaDec':
            return hexdec($wartosc);
        default:
            return "Nieznany typ działania.";
    }
}
?>
</body>
</html>
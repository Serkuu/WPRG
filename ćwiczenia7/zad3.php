<?php
function stworzTablice($a, $b, $c, $d) {
    if ($a > $b || $c > $d || ($b - $a) != ($d - $c)) {
        echo "BŁĄD: Nieprawidłowe zakresy liczb";
        return [];
    }

    $tablica = [];
    $wartosc = $c;

    for ($i = $a; $i <= $b; $i++) {
        $tablica[$i] = $wartosc;
        $wartosc++;
    }

    return $tablica;
}

$przyklad1 = stworzTablice(1, 5, 10, 14);
print_r($przyklad1);

echo "<br>";

$przyklad2 = stworzTablice(1, 4, 10, 20);
print_r($przyklad2);
?>

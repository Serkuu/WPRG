<?php
function wstawZnak(&$tablica, $n) {
    if ($n < 0 || $n > count($tablica)) {
        echo "n jest poza zakresem";
        return null;
    }

    array_splice($tablica, $n, 0, '$');

    return $tablica;
}

$tab1 = [1, 2, 3, 4];
print_r(wstawZnak($tab1, 2));

echo "<br>";

$tab2 = [10, 20];
print_r(wstawZnak($tab2, 5));
?>

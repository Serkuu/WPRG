<?php
$file = 'licznik.txt';

if (!file_exists($file)) {
    file_put_contents($file, '1');
    $visits = 1;
} else {
    $visits = (int)file_get_contents($file);
    $visits++;
    file_put_contents($file, $visits);
}

echo "Liczba odwiedzin witryny: $visits";
?>
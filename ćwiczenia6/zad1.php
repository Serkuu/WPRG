<?php
function print_primes($a, $b) {
    echo "$a, $b: \n";
    if (is_numeric($a) && is_numeric($b)) {
        if ($a > $b) {
            $x = ceil($a);
            $y = ceil($b);
        }
        else{
            $x = ceil($b);
            $y = ceil($a);
        }
        if ($x > 0 && $y > 0) {
            for ($i = $y; $i <= $x; $i++) {
                if (isPrime($i)) {
                    echo "$i\n";
                }
            }
            echo "<br>";
        } else {
            echo "Start and stop must be positive numbers";
            echo "<br>";
        }
    } else{
        echo "Start and stop must be numeric";
        echo "<br>";
    }
}
function isPrime($a) {
    if ($a==1){
        return false;
    }
    for($i = 2; $i < $a; $i++) {
        if ($a % $i == 0) {
            return false;
        }
    }
    return true;
}
print_primes(5, 10);
print_primes(10, 5);
print_primes(5.5, 10);
print_primes(-5, 10);
print_primes("prime", 10);

?>

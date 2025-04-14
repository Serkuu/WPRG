<?php
function panagram($a){
    $alfabet = range('a', 'z');
    $a = str_replace(' ','', $a);
    $a = strtolower($a);
    foreach ($alfabet as $letter) {
        if (strpos($a, $letter) === false) {
            return false;
        }
    }
    return true;
}
if (panagram("The quick brown fox jumps over the lazy dog")){
    echo "Jest panagramem";
}
else{
    echo "Nie jest panagramem";
}
?>
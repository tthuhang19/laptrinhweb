<?php
// array_functions.php

function SLN($array) {
    return max($array);
}

function SNN($array) {
    return min($array);
}

function Tong($array) {
    return array_sum($array);
}

function sapxep($array) {
    sort($array);
    return $array;
}

function check($array, $element) {
    return in_array($element, $array);
}
?>
<?php
function timGiaTriLonNhat($mang) {
    return max($mang);
}

function timGiaTriNhoNhat($mang) {
    return min($mang);
}

function tinhTong($mang) {
    return array_sum($mang);
}

function kiemTraPhanTu($mang, $giaTri) {
    return in_array($giaTri, $mang);
}

function sapXepMang(&$mang) {
    sort($mang);
}
?>

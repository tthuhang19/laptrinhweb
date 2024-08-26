<?php
function tinh_phep_tinh($pheptinh, $so1, $so2) {
    switch ($pheptinh) {
        case 'cong':
            return $so1 + $so2;
        case 'tru':
            return $so1 - $so2;
        case 'nhan':
            return $so1 * $so2;
        case 'chia':
            if ($so2 != 0) {
                return $so1 / $so2;
            } else {
                return "Không thể chia cho 0.";
            }
        default:
            return "Phép tính không hợp lệ.";
    }
}

function kiem_tra_chan_le($so) {
    return ($so % 2 == 0) ? "$so là số chẵn." : "$so là số lẻ.";
}

function kiem_tra_nguyen_to($so) {
    if ($so < 2) return "$so không phải là số nguyên tố.";
    for ($i = 2; $i <= sqrt($so); $i++) {
        if ($so % $i == 0) return "$so không phải là số nguyên tố.";
    }
    return "$so là số nguyên tố.";
}
?>

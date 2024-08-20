<?php

/**
 * すでに着席済みの席があるか判定
 * @param array $charis 着席済みか特定したい位置の座席リスト
 * @return bool 着席済みの席がある:true、着席済みの席がない:false
 */
function isSeatedChairs(array $chairs): bool {
    foreach ($chairs as $chair) {
        if ($chair) {
            return true;
        }
    }
    return false;
}

/**
 * 着席済みか特定したい位置の座席リスト取得
 * @param array $charis 座席
 * @param int $start_index 座席開始位置
 * @param int $count 人数（席数）
 * @param int $max_seat 最大座席数
 * @return array 特定したい座席リスト
 */
function getTargetChairs(array $chairs, int $start_index, int $count, int $max_seat): array {
    // 最大座席数を越えた場合
    if (($start_index + $count) > $max_seat) {
        $first_diff_index = $max_seat - $start_index;
        $second_diff_index = ($start_index + $count) - $max_seat;
        $chairs1 = array_slice($chairs, $start_index, $first_diff_index);
        $chairs2 = array_slice($chairs, 0, $second_diff_index);
        return array_merge($chairs1, $chairs2);
    }
    // 通常時
    return array_slice($chairs, $start_index, $count);
}

/**
 * 指定した範囲の未着席の席を着席状態に変更
 * @param array $chairs 座席
 * @param int $start_index 座席開始位置
 * @param int $count 人数（席数）
 * @param int $max_seat 最大座席数
 * @return array 変更した座席
 */
function setSeatedChairs(array $charis, int $start_index, int $count, int $max_seat): array {
    // 最大座席数を越えた場合
    if (($start_index + $count) > $max_seat) {
        $diff_index = ($start_index + $count) - $max_seat;
        for ($i = $start_index; $i < $max_seat; $i++) {
            $charis[$i] = true;
        }
        for ($i = 0; $i < $diff_index; $i++) {
            $charis[$i] = true;
        }
        return $charis;
    }
    // 通常時
    $counter = 0;
    while ($counter < $count) {
        $charis[$start_index] = true;
        $start_index++;
        $counter++;
    }
    return $charis;
}

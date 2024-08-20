<?php

require_once __DIR__ . '/Functions.php';

$group_length = 6;  // m（グループ数）
$max_seat = 12;  // n（最大座席数）

// 未着席でn席ぶん用意
$chairs = array_fill(0, $max_seat, false);

// グループ
$groups = [
    // [人数, 開始座席番号]
    [4, 6],
    [4, 8],
    [4, 10],
    [4, 12],
    [4, 2],
    [4, 4],
];

foreach ($groups as $group) {
    $target = getTargetChairs($chairs, $group[1] - 1, $group[0], $max_seat);
    if (!isSeatedChairs($target)) {
        $chairs = setSeatedChairs($chairs, $group[1] - 1, $group[0], $max_seat);
    }
}

// 着席済みの席を調べる
$seated = 0;
foreach ($chairs as $chair) {
    if ($chair) {
        $seated++;
    }
}

// 結果
echo $seated;

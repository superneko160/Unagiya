<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Functions.php';

class FunctionsTest extends TestCase
{
    /**
     * すでに着席済みの席があるか判定する関数（true）
     * ひとつでもtrueの席がある
     */
    public function testIsSeatedChairTrue(): void
    {
        $data = [false, true, false];
        $this->assertEquals(true, isSeatedChairs($data));
    }

    /**
     * すでに着席済みの席があるか判定する関数（false）
     * ひとつもtrueの席がない
     */
    public function testIsSeatedChairFalse(): void
    {
        $data = [false, false, false];
        $this->assertEquals(false, isSeatedChairs($data));
    }

    /**
     * 着席済みか特定したい位置の座席リスト取得する関数
     * 通常時
     */
    public function testGetTargetChairs(): void
    {
        $data = [false, true, false, true, true, false];
        $start_index = 1;
        $count = 2;
        $max_seat = 6;
        $this->assertEquals(
            [true, false],
            getTargetChairs($data, $start_index, $count, $max_seat)
        );
    }

    /**
     * 着席済みか特定したい位置の座席リスト取得する関数
     * 最大座席数を越えた場合
     */
    public function testGetTargetChairsOverMaxSeat(): void
    {
        $data = [false, true, false, true, true, false];
        $start_index = 5;
        $count = 3;
        $max_seat = 6;
        $this->assertEquals(
            [false, false, true],
            getTargetChairs($data, $start_index, $count, $max_seat)
        );
    }

    /**
     * 指定した範囲の未着席の席を着席状態に変更する関数
     * 通常時
     */
    public function testSetSeatedChairs(): void
    {
        $data = [false, false, false, false, false, false];
        $start_index = 1;
        $count = 2;
        $max_seat = 6;
        $this->assertEquals(
            [false, true, true, false, false, false],
            setSeatedChairs($data, $start_index, $count, $max_seat)
        );
    }

    /**
     * 指定した範囲の未着席の席を着席状態に変更する関数
     * 最大座席数を越えた場合
     */
    public function testSetSeatedChairsOverMaxSeat(): void
    {
        $data = [false, false, false, false, false, false];
        $start_index = 5;
        $count = 3;
        $max_seat = 6;
        $this->assertEquals(
            [true, true, false, false, false, true],
            setSeatedChairs($data, $start_index, $count, $max_seat)
        );
    }

    /**
     * 指定した範囲の未着席の席を着席状態に変更する関数
     * 最大座席数を越えた場合2
     */
    public function testSetSeatedChairsOverMaxSeat2(): void
    {
        $data = [false, true, true, true, false, false];
        $start_index = 5;
        $count = 1;
        $max_seat = 6;
        $this->assertEquals(
            [false, true, true, true, false, true],
            setSeatedChairs($data, $start_index, $count, $max_seat)
        );
    }
}

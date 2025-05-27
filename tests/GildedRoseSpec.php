<?php
require_once __DIR__ . '/../src/GildedRose.php';
use App\GildedRose;

function assertEqual($a, $b, $msg) {
    if ($a === $b) {
        echo "PASS: $msg\n";
    } else {
        echo "FAIL: $msg (Expected ".json_encode($b).", got ".json_encode($a).")\n";
    }
}

// Normal item
$item = GildedRose::of('foo', 10, 5); $item->tick();
assertEqual([$item->quality, $item->sellIn], [9, 4], 'Normal item degrades');
$item = GildedRose::of('foo', 1, 0); $item->tick();
assertEqual([$item->quality, $item->sellIn], [0, -1], 'Normal item at sell date');
$item = GildedRose::of('foo', 2, 0); $item->tick();
assertEqual([$item->quality, $item->sellIn], [0, -1], 'Normal item degrades twice after sell date');

// Aged Brie
$item = GildedRose::of('Aged Brie', 0, 2); $item->tick();
assertEqual([$item->quality, $item->sellIn], [1, 1], 'Aged Brie increases');
$item = GildedRose::of('Aged Brie', 49, 0); $item->tick();
assertEqual([$item->quality, $item->sellIn], [50, -1], 'Aged Brie caps at 50');

// Sulfuras
$item = GildedRose::of('Sulfuras, Hand of Ragnaros', 80, 0); $item->tick();
assertEqual([$item->quality, $item->sellIn], [80, 0], 'Sulfuras never changes');

// Backstage passes
$item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 20, 15); $item->tick();
assertEqual([$item->quality, $item->sellIn], [21, 14], 'Backstage pass normal');
$item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 20, 10); $item->tick();
assertEqual([$item->quality, $item->sellIn], [22, 9], 'Backstage pass 10 days or less');
$item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 20, 5); $item->tick();
assertEqual([$item->quality, $item->sellIn], [23, 4], 'Backstage pass 5 days or less');
$item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 20, 0); $item->tick();
assertEqual([$item->quality, $item->sellIn], [0, -1], 'Backstage pass after concert');

// Conjured
$item = GildedRose::of('Conjured Mana Cake', 10, 5); $item->tick();
assertEqual([$item->quality, $item->sellIn], [8, 4], 'Conjured degrades twice as fast');
$item = GildedRose::of('Conjured Mana Cake', 2, 0); $item->tick();
assertEqual([$item->quality, $item->sellIn], [0, -1], 'Conjured degrades twice as fast after sell date'); 
<?php
/**
 * GildedRose Kata - Refactored OOP Solution
 *
 * Supports all standard rules and the new 'Conjured' item type.
 *
 * Usage: See tests/GildedRoseSpec.php for test cases.
 */

namespace App;

abstract class ItemUpdater
{
    protected $item;
    public function __construct(GildedRose $item) { $this->item = $item; }
    abstract public function update();
    protected function increaseQuality($amount = 1) {
        $this->item->quality = min(50, $this->item->quality + $amount);
    }
    protected function decreaseQuality($amount = 1) {
        $this->item->quality = max(0, $this->item->quality - $amount);
    }
}

class NormalItemUpdater extends ItemUpdater
{
    public function update() {
        $this->decreaseQuality();
        $this->item->sellIn--;
        if ($this->item->sellIn < 0) {
            $this->decreaseQuality();
        }
    }
}

class AgedBrieUpdater extends ItemUpdater
{
    public function update() {
        $this->increaseQuality();
        $this->item->sellIn--;
        if ($this->item->sellIn < 0) {
            $this->increaseQuality();
        }
    }
}

class SulfurasUpdater extends ItemUpdater
{
    public function update() {
        // Legendary: do nothing
    }
}

class BackstagePassUpdater extends ItemUpdater
{
    public function update() {
        if ($this->item->sellIn > 0) {
            $this->increaseQuality();
            if ($this->item->sellIn <= 10) $this->increaseQuality();
            if ($this->item->sellIn <= 5) $this->increaseQuality();
        } else {
            $this->item->quality = 0;
        }
        $this->item->sellIn--;
    }
}

class ConjuredItemUpdater extends ItemUpdater
{
    public function update() {
        $this->decreaseQuality(2);
        $this->item->sellIn--;
        if ($this->item->sellIn < 0) {
            $this->decreaseQuality(2);
        }
    }
}

class GildedRose
{
    public $name;
    public $quality;
    public $sellIn;

    public function __construct($name, $quality, $sellIn)
    {
        $this->name = $name;
        $this->quality = $quality;
        $this->sellIn = $sellIn;
    }

    public static function of($name, $quality, $sellIn) {
        return new static($name, $quality, $sellIn);
    }

    public function tick()
    {
        $this->getUpdater()->update();
    }

    private function getUpdater(): ItemUpdater
    {
        if ($this->name === 'Aged Brie') return new AgedBrieUpdater($this);
        if ($this->name === 'Sulfuras, Hand of Ragnaros') return new SulfurasUpdater($this);
        if ($this->name === 'Backstage passes to a TAFKAL80ETC concert') return new BackstagePassUpdater($this);
        if (stripos($this->name, 'Conjured') === 0) return new ConjuredItemUpdater($this);
        return new NormalItemUpdater($this);
    }
} 
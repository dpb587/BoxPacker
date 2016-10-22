<?php
/**
 * Box packing (3D bin packing, knapsack problem)
 * @package BoxPacker
 * @author Doug Wright
 */
namespace DVDoug\BoxPacker;

/**
 * A "box" with items
 * @author Doug Wright
 * @package BoxPacker
 */
class PackedBox
{

    /**
     * Box used
     * @var Box
     */
    protected $box;

    /**
     * Items in the box
     * @var ItemList
     */
    protected $items;

    /**
     * Total weight of box
     * @var int
     */
    protected $weight;

    /**
     * Total value of box
     * @var float
     */
    protected $value;

    /**
     * Remaining width inside box for another item
     * @var int
     */
    protected $remainingWidth;

    /**
     * Remaining length inside box for another item
     * @var int
     */
    protected $remainingLength;

    /**
     * Remaining depth inside box for another item
     * @var int
     */
    protected $remainingDepth;

    /**
     * Remaining weight inside box for another item
     * @var int
     */
    protected $remainingWeight;

    /**
     * Remaining value for another item
     * @var float
     */
    protected $remainingValue;

    /**
     * Get box used
     * @return Box
     */
    public function getBox()
    {
        return $this->box;
    }

    /**
     * Get items packed
     * @return ItemList
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Get packed weight
     * @return int weight in grams
     */
    public function getWeight()
    {

        if (!is_null($this->weight)) {
            return $this->weight;
        }

        $this->weight = $this->box->getEmptyWeight();
        $items = clone $this->items;
        foreach ($items as $item) {
            $this->weight += $item->getWeight();
        }
        return $this->weight;
    }

    /**
     * Get content value
     * @return float currency
     */
    public function getValue()
    {
        if (!is_null($this->value)) {
            return $this->value;
        }

        $this->value = 0;
        $items = clone $this->items;
        foreach ($items as $item) {
            $this->value += $item->getValue();
        }
        return $this->value;
    }

    /**
     * Get remaining width inside box for another item
     * @return int
     */
    public function getRemainingWidth()
    {
        return $this->remainingWidth;
    }

    /**
     * Get remaining length inside box for another item
     * @return int
     */
    public function getRemainingLength()
    {
        return $this->remainingLength;
    }

    /**
     * Get remaining depth inside box for another item
     * @return int
     */
    public function getRemainingDepth()
    {
        return $this->remainingDepth;
    }

    /**
     * Get remaining weight inside box for another item
     * @return int
     */
    public function getRemainingWeight()
    {
        return $this->remainingWeight;
    }

    /**
     * Get remaining value for another item
     * @return float
     */
    public function getRemainingValue()
    {
        return $this->remainingValue;
    }

    /**
     * Get volume utilisation of the packed box
     * @return float
     */
    public function getVolumeUtilisation()
    {
        $itemVolume = 0;

        /** @var Item $item */
        foreach (clone $this->items as $item) {
            $itemVolume += $item->getVolume();
        }

        return round($itemVolume / $this->box->getInnerVolume() * 100, 1);
    }



    /**
     * Constructor
     * @param Box      $box
     * @param ItemList $itemList
     * @param int      $remainingWidth
     * @param int      $remainingLength
     * @param int      $remainingDepth
     * @param int      $remainingWeight
     * @param float    $remainingValue
     */
    public function __construct(Box $box, ItemList $itemList, $remainingWidth, $remainingLength, $remainingDepth, $remainingWeight, $remainingValue)
    {
        $this->box = $box;
        $this->items = $itemList;
        $this->remainingWidth = $remainingWidth;
        $this->remainingLength = $remainingLength;
        $this->remainingDepth = $remainingDepth;
        $this->remainingWeight = $remainingWeight;
        $this->remainingValue = $remainingValue;
    }
}

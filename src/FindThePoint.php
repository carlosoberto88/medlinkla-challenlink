<?php
/**
 * FindThePoint
 *
 * Given two sorted, comma-separated lists of numbers as strings,
 * return a comma-separated string of their intersection in sorted order,
 * or 'false' if there is no intersection.
 *
 * Usage: php src/FindThePoint.php
 */
class FindThePoint
{
    /**
     * Returns the intersection of two sorted, comma-separated number strings.
     * @param string $a
     * @param string $b
     * @return string Comma-separated intersection or 'false'
     */
    public static function intersection(string $a, string $b): string
    {
        $arr1 = array_map('trim', explode(',', $a));
        $arr2 = array_map('trim', explode(',', $b));
        $i = $j = 0;
        $result = [];
        while ($i < count($arr1) && $j < count($arr2)) {
            if ($arr1[$i] == $arr2[$j]) {
                $result[] = $arr1[$i];
                $i++;
                $j++;
            } elseif ($arr1[$i] < $arr2[$j]) {
                $i++;
            } else {
                $j++;
            }
        }
        return $result ? implode(',', $result) : 'false';
    }
}

/**
 * Challenge procedural wrapper for compatibility
 * @param array $strArr
 * @return string
 */
function findPoint($strArr)
{
    return FindThePoint::intersection($strArr[0], $strArr[1]);
}

// keep this function call here
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    echo findPoint(['1, 3, 4, 7, 13', '1, 2, 4, 13, 15']);
} 
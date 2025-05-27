<?php
/**
 * DontIterate
 *
 * Given two strings N and K, return the smallest substring of N that contains all characters in K (with correct multiplicity).
 * Uses a sliding window (two-pointer) approach for efficiency.
 *
 * Usage: php src/DontIterate.php
 */
class DontIterate
{
    /**
     * Returns the smallest substring of $n that contains all characters in $k.
     * @param string $n
     * @param string $k
     * @return string
     */
    public static function minWindow(string $n, string $k): string
    {
        $need = [];
        $have = [];
        $required = 0;
        // Count required characters
        for ($i = 0; $i < strlen($k); $i++) {
            $char = $k[$i];
            if (!isset($need[$char])) {
                $need[$char] = 0;
                $required++;
            }
            $need[$char]++;
        }
        $formed = 0;
        $l = 0;
        $minLen = PHP_INT_MAX;
        $minStart = 0;
        for ($r = 0; $r < strlen($n); $r++) {
            $char = $n[$r];
            if (isset($need[$char])) {
                if (!isset($have[$char])) $have[$char] = 0;
                $have[$char]++;
                if ($have[$char] == $need[$char]) $formed++;
            }
            while ($formed == $required) {
                if ($r - $l + 1 < $minLen) {
                    $minLen = $r - $l + 1;
                    $minStart = $l;
                }
                $leftChar = $n[$l];
                if (isset($need[$leftChar])) {
                    $have[$leftChar]--;
                    if ($have[$leftChar] < $need[$leftChar]) $formed--;
                }
                $l++;
            }
        }
        return $minLen == PHP_INT_MAX ? '' : substr($n, $minStart, $minLen);
    }
}

/**
 * Challenge procedural wrapper for compatibility
 * @param array $strArr
 * @return string
 */
function noIterate($strArr)
{
    return DontIterate::minWindow($strArr[0], $strArr[1]);
}

// keep this function call here
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    echo noIterate(["ahffaksfajeeubsne", "jefaa"]);
} 
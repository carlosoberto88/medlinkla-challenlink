<?php
require_once __DIR__ . '/../src/DontIterate.php';

function assertEqual($a, $b, $msg) {
    if ($a === $b) {
        echo "PASS: $msg\n";
    } else {
        echo "FAIL: $msg (Expected $b, got $a)\n";
    }
}

assertEqual(noIterate(["ahffaksfajeeubsne", "jefaa"]), 'aksfaje', 'Example 1');
assertEqual(noIterate(["aaffhkksemckelloe", "fhea"]), 'affhkkse', 'Example 2');
assertEqual(noIterate(["aaabaaddae", "aed"]), 'dae', 'Example 3');
assertEqual(noIterate(["aabdccdbcacd", "aad"]), 'aabd', 'Example 4');
// Edge: all chars at start
assertEqual(noIterate(["abcde", "abc"]), 'abc', 'All at start');
// Edge: all chars at end
assertEqual(noIterate(["xyzabc", "abc"]), 'abc', 'All at end');
// Edge: single char
assertEqual(noIterate(["a", "a"]), 'a', 'Single char'); 
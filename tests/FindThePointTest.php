<?php
require_once __DIR__ . '/../src/FindThePoint.php';

function assertEqual($a, $b, $msg) {
    if ($a === $b) {
        echo "PASS: $msg\n";
    } else {
        echo "FAIL: $msg (Expected ".json_encode($b).", got ".json_encode($a).")\n";
    }
}

assertEqual(findPoint(["1, 3, 4, 7, 13", "1, 2, 4, 13, 15"]), '1,4,13', 'Intersection normal case');
assertEqual(findPoint(["1, 3, 9, 10, 17, 18", "1, 4, 9, 10"]), '1,9,10', 'Intersection with multiple matches');
assertEqual(findPoint(["1, 2, 3", "4, 5, 6"]), 'false', 'No intersection');
assertEqual(findPoint(["", "1, 2, 3"]), 'false', 'Empty first list');
assertEqual(findPoint(["1, 2, 3", ""]), 'false', 'Empty second list'); 
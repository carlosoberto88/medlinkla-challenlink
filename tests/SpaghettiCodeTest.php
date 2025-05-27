<?php
require_once __DIR__ . '/../src/SpaghettiCode.php';

function assertEqual($a, $b, $msg) {
    if ($a === $b) {
        echo "PASS: $msg\n";
    } else {
        echo "FAIL: $msg (Expected $b, got $a)\n";
    }
}

assertEqual(SpaghettiCode::formatFullName('Jane', 'Smith'), 'Jane Smith', 'Full name Jane Smith');
assertEqual(SpaghettiCode::formatFullName('John', 'Doe'), 'John Doe', 'Full name John Doe'); 
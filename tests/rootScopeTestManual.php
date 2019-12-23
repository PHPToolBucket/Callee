<?php declare(strict_types = 1);

use function PHPToolBucket\CallerInfo\callerInfo;

require __DIR__ . "/../vendor/autoload.php";

$frame0 = callerInfo(0);
assert($frame0 === NULL);

$frame1 = callerInfo(0);
assert($frame1 === NULL);

function frame0($expectCaller){
    $actualCaller = callerInfo(0)["function"] ?? NULL;
    assert($actualCaller === $expectCaller);
}

function frame1(){
    frame0("frame1");
}

frame0(NULL);

frame1();

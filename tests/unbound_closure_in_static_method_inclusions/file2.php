<?php declare(strict_types = 1); // atom

use function PHPToolBucket\Bucket\calleeClassScope;

$results[] = calleeClassScope();

include(__DIR__ . "/file3.php");

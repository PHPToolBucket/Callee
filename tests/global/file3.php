<?php declare(strict_types = 1); // atom

use function PHPToolBucket\Bucket\calleeClassScope;

$results[] = calleeClassScope();

require(__DIR__ . "/file4.php");

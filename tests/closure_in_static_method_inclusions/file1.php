<?php declare(strict_types = 1); // atom

use function PHPToolBucket\Bucket\calleeClassScope;

$results[] = calleeClassScope();

require_once(__DIR__ . "/file2.php");

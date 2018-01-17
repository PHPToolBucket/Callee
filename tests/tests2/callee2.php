<?php declare(strict_types = 1); // atom

use function PHPToolBucket\Bucket\callerClassScope;

var_dump(callerClassScope());
assert(callerClassScope() === $expect);


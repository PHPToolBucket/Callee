<?php
        use function PHPToolBucket\Bucket\callerClassScope;
        assert(callerClassScope() === MyClass::CLASS);
    
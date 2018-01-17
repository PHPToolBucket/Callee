<?php declare(strict_types = 1); // atom

use function PHPToolBucket\Bucket\callerClassScope;

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

require("../vendor/autoload.php");

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

(function(){
    assert(callerClassScope() === "public");
})();

class Crap{}
(function(){
    (function(){
        assert(callerClassScope() === Crap::CLASS);
    })();
})->bindTo(NULL, Crap::CLASS)();

assert(callerClassScope() === 1);






<?php declare(strict_types = 1); // atom

use function PHPToolBucket\Bucket\calleeClassScope;

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

require("../vendor/autoload.php");

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

$results = [calleeClassScope()];
include_once(__DIR__ . "/global/file1.php");
assert(count($results) === 5);
assert(array_unique($results) === [NULL]);

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

class Rebound{}

class Klass
{
    function method(){
        $results = [calleeClassScope()];
        include_once(__DIR__ . "/method_inclusions/file1.php");
        return $results;
    }

    static function staticMethod(){
        $results = [calleeClassScope()];
        include_once(__DIR__ . "/static_method_inclusions/file1.php");
        return $results;
    }

    //[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

    function closureInMethod(){
        return (function(){
            $results = [calleeClassScope()];
            include_once(__DIR__ . "/closure_in_method_inclusions/file1.php");
            return $results;
        })();
    }

    static function closureInStaticMethod(){
        return (function(){
            $results = [calleeClassScope()];
            include_once(__DIR__ . "/closure_in_static_method_inclusions/file1.php");
            return $results;
        })();
    }

    //[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

    function reboundClosureInMethod(){
        return (function(){
            $results = [calleeClassScope()];
            include_once(__DIR__ . "/rebound_closure_in_method_inclusions/file1.php");
            return $results;
        })->call(new Rebound());
    }

    static function reboundClosureInStaticMethod(){
        return (function(){
            $results = [calleeClassScope()];
            include_once(__DIR__ . "/rebound_closure_in_static_method_inclusions/file1.php");
            return $results;
        })->call(new Rebound());
    }

    //[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

    function staticClosureInMethod(){
        return (static function(){
            $results = [calleeClassScope()];
            include_once(__DIR__ . "/unbound_closure_in_method_inclusions/file1.php");
            return $results;
        })();
    }

    static function staticClosureInStaticMethod(){
        return (static function(){
            $results = [calleeClassScope()];
            include_once(__DIR__ . "/unbound_closure_in_static_method_inclusions/file1.php");
            return $results;
        })();
    }
}

$object = new Klass();

$inclusions = $object->method();
assert(count($inclusions) === 5);
assert(array_unique($inclusions) === [Klass::CLASS]);

$inclusions = Klass::staticMethod();
assert(count($inclusions) === 5);
assert(array_unique($inclusions) === [Klass::CLASS]);

$inclusions = $object->closureInMethod();
assert(count($inclusions) === 5);
assert(array_unique($inclusions) === [Klass::CLASS]);

$inclusions = Klass::closureInStaticMethod();
assert(count($inclusions) === 5);
assert(array_unique($inclusions) === [Klass::CLASS]);

$inclusions = $object->reboundClosureInMethod();
assert(count($inclusions) === 5);
assert(array_unique($inclusions) === [Rebound::CLASS]);

$inclusions = Klass::reboundClosureInStaticMethod();
assert(count($inclusions) === 5);
assert(array_unique($inclusions) === [Rebound::CLASS]);

$inclusions = $object->staticClosureInMethod();
assert(count($inclusions) === 5);
assert(array_unique($inclusions) === [Klass::CLASS]);

$inclusions = Klass::staticClosureInStaticMethod();
assert(count($inclusions) === 5);
assert(array_unique($inclusions) === [Klass::CLASS]);

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

echo "If you read this all tests did pass";

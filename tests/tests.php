<?php declare(strict_types = 1); // atom

use function PHPToolBucket\Bucket\__callerClassScopeInternal;

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

require("../vendor/autoload.php");

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

function trailingFrames(){
    yield [];

    yield [
        ["function" => "trailing", "class" => "NotThisClass" . random_int(0, PHP_INT_MAX)],
    ];

    yield [
        ["function" => "trailing", "class" => "NotThisClass" . random_int(0, PHP_INT_MAX)],
        ["function" => "trailing", "class" => "NotThisClass" . random_int(0, PHP_INT_MAX)],
    ];

    yield [
        ["function" => "trailing", "class" => "NotThisClass" . random_int(0, PHP_INT_MAX)],
        ["function" => "trailing", "class" => "NotThisClass" . random_int(0, PHP_INT_MAX)],
        ["function" => "trailing", "class" => "NotThisClass" . random_int(0, PHP_INT_MAX)],
    ];
}

function requires(){
    yield [];

    yield [
        ["function" => "require"],
    ];

    yield [
        ["function" => "require"],
        ["function" => "require_once"],
    ];

    yield [
        ["function" => "require"],
        ["function" => "require_once"],
        ["function" => "include"],
    ];

    yield [
        ["function" => "require"],
        ["function" => "require_once"],
        ["function" => "include"],
        ["function" => "include_once"],
    ];
}

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

$trace = [];
$trace[] = ["function" => "callerClassScope"];
$trace[] = ["function" => "xxx", "class" => "Callee"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
assert(__callerClassScopeInternal(0, $trace) === "public");

$trace = [];
$trace[] = ["function" => "callerClassScope"];
$trace[] = ["function" => "xxx", "class" => "Callee"];
$trace[] = ["function" => "xxx", "class" => "Caller0"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
assert(__callerClassScopeInternal(1, $trace) === "public");

$trace = [];
$trace[] = ["function" => "callerClassScope"];
$trace[] = ["function" => "xxx", "class" => "Callee"];
$trace[] = ["function" => "xxx", "class" => "Caller0"];
$trace[] = ["function" => "xxx", "class" => "Caller1"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
assert(__callerClassScopeInternal(2, $trace) === "public");

$trace = [];
$trace[] = ["function" => "callerClassScope"];
$trace[] = ["function" => "xxx", "class" => "Callee"];
$trace[] = ["function" => "xxx", "class" => "Caller0"];
$trace[] = ["function" => "xxx", "class" => "Caller1"];
$trace[] = ["function" => "xxx", "class" => "Caller2"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
assert(__callerClassScopeInternal(3, $trace) === "public");

$trace = [];
$trace[] = ["function" => "callerClassScope"];
$trace[] = ["function" => "xxx", "class" => "Callee"];
$trace[] = ["function" => "xxx", "class" => "Caller0"];
$trace[] = ["function" => "xxx", "class" => "Caller1"];
$trace[] = ["function" => "xxx", "class" => "Caller2"];
$trace[] = ["function" => "xxx", "class" => "Caller3"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
assert(__callerClassScopeInternal(4, $trace) === "public");

$trace = [];
$trace[] = ["function" => "callerClassScope"];
$trace[] = ["function" => "xxx", "class" => "Callee"];
$trace[] = ["function" => "xxx", "class" => "Caller0"];
$trace[] = ["function" => "xxx", "class" => "Caller1"];
$trace[] = ["function" => "xxx", "class" => "Caller2"];
$trace[] = ["function" => "xxx", "class" => "Caller3"];
$trace[] = ["function" => "xxx", "class" => "Caller4"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
assert(__callerClassScopeInternal(5, $trace) === "public");

$trace = [];
$trace[] = ["function" => "callerClassScope"];
$trace[] = ["function" => "xxx", "class" => "Callee"];
$trace[] = ["function" => "xxx", "class" => "Caller0"];
$trace[] = ["function" => "xxx", "class" => "Caller1"];
$trace[] = ["function" => "xxx", "class" => "Caller2"];
$trace[] = ["function" => "xxx", "class" => "Caller3"];
$trace[] = ["function" => "xxx", "class" => "Caller4"];
$trace[] = ["function" => "xxx", "class" => "Caller5"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
assert(__callerClassScopeInternal(5, $trace) === "Caller5");

$trace = [];
$trace[] = ["function" => "callerClassScope"];
$trace[] = ["function" => "xxx", "class" => "Callee"];
$trace[] = ["function" => "xxx", "class" => "Caller0"];
$trace[] = ["function" => "xxx", "class" => "Caller1"];
$trace[] = ["function" => "xxx", "class" => "Caller2"];
$trace[] = ["function" => "xxx", "class" => "Caller3"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
assert(__callerClassScopeInternal(5, $trace) === 1);

$trace = [];
$trace[] = ["function" => "callerClassScope"];
$trace[] = ["function" => "xxx", "class" => "Callee"];
$trace[] = ["function" => "xxx", "class" => "Caller0"];
$trace[] = ["function" => "xxx", "class" => "Caller1"];
$trace[] = ["function" => "xxx", "class" => "Caller2"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
assert(__callerClassScopeInternal(5, $trace) === 2);

$trace = [];
$trace[] = ["function" => "callerClassScope"];
$trace[] = ["function" => "xxx", "class" => "Callee"];
$trace[] = ["function" => "xxx", "class" => "Caller0"];
$trace[] = ["function" => "xxx", "class" => "Caller1"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
assert(__callerClassScopeInternal(5, $trace) === 3);

$trace = [];
$trace[] = ["function" => "callerClassScope"];
$trace[] = ["function" => "xxx", "class" => "Callee"];
$trace[] = ["function" => "xxx", "class" => "Caller0"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
assert(__callerClassScopeInternal(5, $trace) === 4);

$trace = [];
$trace[] = ["function" => "callerClassScope"];
$trace[] = ["function" => "xxx", "class" => "Callee"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
$trace[] = ["function" => "require"];
assert(__callerClassScopeInternal(5, $trace) === 5);

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

foreach(requires() as $r1){
    foreach(requires() as $r2){
        $trace = [];
        $trace[] = ["function" => "callerClassScope"];
        foreach($r1 as $r){ $trace[] = $r; }
        $trace[] = ["function" => "callee",  "class" => "NotThisClass"];
        foreach($r2 as $r){ $trace[] = $r; }
                                                                                            // Caller0
        assert(__callerClassScopeInternal(0, $trace) === "public");
    }
}

foreach(trailingFrames() as $t){
    foreach(requires() as $r1){
        foreach(requires() as $r2){
            $trace = [];
            $trace[] = ["function" => "callerClassScope"];
            foreach($r1 as $r){ $trace[] = $r; }
            $trace[] = ["function" => "callee",  "class" => "NotThisClass"];
            foreach($r2 as $r){ $trace[] = $r; }
            $trace[] = ["function" => "caller0"];                                           // Caller0
            foreach($t as $tF){ $trace[] = $tF; }
            assert(__callerClassScopeInternal(0, $trace) === "public");
        }
    }
}

foreach(trailingFrames() as $t){
    foreach(requires() as $r1){
        foreach(requires() as $r2){
            $trace = [];
            $trace[] = ["function" => "callerClassScope"];
            foreach($r1 as $r){ $trace[] = $r; }
            $trace[] = ["function" => "callee",  "class" => "NotThisClass"];
            foreach($r2 as $r){ $trace[] = $r; }
            $trace[] = ["function" => "caller0", "class" => "CallerScope"];                 // Caller0
            foreach($t as $tF){ $trace[] = $tF; }
            assert(__callerClassScopeInternal(0, $trace) === "CallerScope");
        }
    }
}

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

foreach(requires() as $r1){
    foreach(requires() as $r2){
        foreach(requires() as $r3){
            $trace = [];
            $trace[] = ["function" => "callerClassScope"];
            foreach($r1 as $r){ $trace[] = $r; }
            $trace[] = ["function" => "callee",  "class" => "NotThisClass"];
            foreach($r2 as $r){ $trace[] = $r; }
            $trace[] = ["function" => "caller0", "class" => "NotThisClass"];
            foreach($r2 as $r){ $trace[] = $r; }
                                                                                            // Caller1
            assert(__callerClassScopeInternal(1, $trace) === "public");
        }
    }
}

foreach(trailingFrames() as $t){
    foreach(requires() as $r1){
        foreach(requires() as $r2){
            foreach(requires() as $r3){
                $trace = [];
                $trace[] = ["function" => "callerClassScope"];
                foreach($r1 as $r){ $trace[] = $r; }
                $trace[] = ["function" => "callee",  "class" => "NotThisClass"];
                foreach($r2 as $r){ $trace[] = $r; }
                $trace[] = ["function" => "caller0", "class" => "NotThisClass"];
                foreach($r3 as $r){ $trace[] = $r; }
                $trace[] = ["function" => "caller1"];                                       // Caller1
                foreach($t as $tF){ $trace[] = $tF; }
                assert(__callerClassScopeInternal(1, $trace) === "public");
            }
        }
    }
}

foreach(trailingFrames() as $t){
    foreach(requires() as $r1){
        foreach(requires() as $r2){
            foreach(requires() as $r3){
                $trace = [];
                $trace[] = ["function" => "callerClassScope"];
                foreach($r1 as $r){ $trace[] = $r; }
                $trace[] = ["function" => "callee",  "class" => "NotThisClass"];
                foreach($r2 as $r){ $trace[] = $r; }
                $trace[] = ["function" => "caller0", "class" => "NotThisClass"];
                foreach($r3 as $r){ $trace[] = $r; }
                $trace[] = ["function" => "caller1", "class" => "ClassScope"];              // Caller1
                foreach($t as $tF){ $trace[] = $tF; }
                assert(__callerClassScopeInternal(1, $trace) === "ClassScope");
            }
        }
    }
}


//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

foreach(requires() as $r1){
    foreach(requires() as $r2){
        foreach(requires() as $r3){
            foreach(requires() as $r4){
                $trace = [];
                $trace[] = ["function" => "callerClassScope"];
                foreach($r1 as $r){ $trace[] = $r; }
                $trace[] = ["function" => "callee",  "class" => "NotThisClass"];
                foreach($r2 as $r){ $trace[] = $r; }
                $trace[] = ["function" => "caller0", "class" => "NotThisClass"];
                foreach($r3 as $r){ $trace[] = $r; }
                $trace[] = ["function" => "caller1", "class" => "NotThisClass"];
                foreach($r4 as $r){ $trace[] = $r; }
                                                                                            // Caller2
                assert(__callerClassScopeInternal(2, $trace) === "public");
            }
        }
    }
}

foreach(trailingFrames() as $t){
    foreach(requires() as $r1){
        foreach(requires() as $r2){
            foreach(requires() as $r3){
                foreach(requires() as $r4){
                    $trace = [];
                    $trace[] = ["function" => "callerClassScope"];
                    foreach($r1 as $r){ $trace[] = $r; }
                    $trace[] = ["function" => "callee",  "class" => "NotThisClass"];
                    foreach($r2 as $r){ $trace[] = $r; }
                    $trace[] = ["function" => "caller0", "class" => "NotThisClass"];
                    foreach($r3 as $r){ $trace[] = $r; }
                    $trace[] = ["function" => "caller1", "class" => "NotThisClass"];
                    foreach($r4 as $r){ $trace[] = $r; }
                    $trace[] = ["function" => "caller2"];                                   // Caller2
                    foreach($t as $tF){ $trace[] = $tF; }
                    assert(__callerClassScopeInternal(2, $trace) === "public");
                }
            }
        }
    }
}


foreach(trailingFrames() as $t){
    foreach(requires() as $r1){
        foreach(requires() as $r2){
            foreach(requires() as $r3){
                foreach(requires() as $r4){
                    $trace = [];
                    $trace[] = ["function" => "callerClassScope"];
                    foreach($r1 as $r){ $trace[] = $r; }
                    $trace[] = ["function" => "callee",  "class" => "NotThisClass"];
                    foreach($r2 as $r){ $trace[] = $r; }
                    $trace[] = ["function" => "caller0", "class" => "NotThisClass"];
                    foreach($r3 as $r){ $trace[] = $r; }
                    $trace[] = ["function" => "caller1", "class" => "NotThisClass"];
                    foreach($r4 as $r){ $trace[] = $r; }
                    $trace[] = ["function" => "caller2", "class" => "ClassScope"];          // Caller2
                    foreach($t as $tF){ $trace[] = $tF; }
                    assert(__callerClassScopeInternal(2, $trace) === "ClassScope");
                }
            }
        }
    }
}

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

echo "End";

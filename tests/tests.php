<?php declare(strict_types = 1); // atom

use function PHPToolBucket\Bucket\callerClassScope;

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

require("../vendor/autoload.php");

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

function makeFile($code){
    $fileName = sha1($code) . ".php";
    $fileName = __DIR__ . "/" . $fileName;
    if(file_exists($fileName) === FALSE){
        file_put_contents($fileName, $code);
    }
    return $fileName;
}

function calledFromGlobalScope(){
    assert(callerClassScope() === NULL);

    //----------------------------------------------------------------------------------

    $f = makeFile('<?php
        use function PHPToolBucket\\Bucket\\callerClassScope;
        assert(callerClassScope() === NULL);
    ');

    require($f);

    //----------------------------------------------------------------------------------

    $f = makeFile('<?php
        use function PHPToolBucket\\Bucket\\callerClassScope;
        assert(callerClassScope() === NULL);
    ');

    $f = makeFile('<?php
        require(' . var_export($f, TRUE) . ');
    ');

    require($f);

    //----------------------------------------------------------------------------------

    $f = makeFile('<?php
        use function PHPToolBucket\\Bucket\\callerClassScope;
        assert(callerClassScope() === NULL);
    ');

    $f = makeFile('<?php
        require(' . var_export($f, TRUE) . ');
    ');

    $f = makeFile('<?php
        require(' . var_export($f, TRUE) . ');
    ');

    require($f);
}

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

class MyClass{}

function calledFromClass(){
    assert(callerClassScope() === MyClass::CLASS);

    //----------------------------------------------------------------------------------

    $f = makeFile('<?php
        use function PHPToolBucket\\Bucket\\callerClassScope;
        assert(callerClassScope() === MyClass::CLASS);
    ');

    require($f);

    //----------------------------------------------------------------------------------

    $f = makeFile('<?php
        use function PHPToolBucket\\Bucket\\callerClassScope;
        assert(callerClassScope() === MyClass::CLASS);
    ');

    $f = makeFile('<?php
        require(' . var_export($f, TRUE) . ');
    ');

    require($f);

    //----------------------------------------------------------------------------------

    $f = makeFile('<?php
        use function PHPToolBucket\\Bucket\\callerClassScope;
        assert(callerClassScope() === MyClass::CLASS);
    ');

    $f = makeFile('<?php
        require(' . var_export($f, TRUE) . ');
    ');

    $f = makeFile('<?php
        require(' . var_export($f, TRUE) . ');
    ');

    require($f);
}

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

try{
    callerClassScope();
}catch(Error $e){}
assert(isset($e));

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

function callFromAGlobalFunctionEqualsToNoClassScope(){ calledFromGlobalScope(); }
function callFromAGlobalFunctionEqualsToNoClassScope2(){ callFromAGlobalFunctionEqualsToNoClassScope(); }

calledFromGlobalScope();

(function(){ calledFromGlobalScope(); })();

(function(){ (function(){ calledFromGlobalScope(); })(); })();

callFromAGlobalFunctionEqualsToNoClassScope();

callFromAGlobalFunctionEqualsToNoClassScope2();

(function(){ callFromAGlobalFunctionEqualsToNoClassScope(); })->bindTo(NULL, MyClass::CLASS)();

(function(){ callFromAGlobalFunctionEqualsToNoClassScope2(); })->bindTo(NULL, MyClass::CLASS)();

(function(){ (function(){ callFromAGlobalFunctionEqualsToNoClassScope(); })(); })->bindTo(NULL, MyClass::CLASS)();

(function(){ (function(){callFromAGlobalFunctionEqualsToNoClassScope2(); })(); })->bindTo(NULL, MyClass::CLASS)();

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

(function(){
    calledFromClass();
})->bindTo(NULL, MyClass::CLASS)();

(function(){
    (function(){
        calledFromClass();
    })();
})->bindTo(NULL, MyClass::CLASS)();

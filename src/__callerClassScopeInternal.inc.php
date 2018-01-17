<?php declare(strict_types = 1);

namespace PHPToolBucket\Bucket;

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

use function assert;

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

/**
 * Returns the class name of the calling scope.
 *
 * @throws
 *
 * @param           Int                                     $depth                          `Int{NonNegative}`
 * @TODOC
 *
 * @param           Array                                   $trace                          `Array<@TODO>`
 * @TODOC
 *
 * @return          String|NULL                                                             `String|NULL`
 * Returns the class name of the calling scope.
 */
function __callerClassScopeInternal(Int $depth, Array $trace){
    assert($depth >= 0);
    $depth++;
    $i = 0;

    TEST:

    $i++;

    SKIP_MORE_INCLUSIONS:
    if(
        isset($trace[$i]) &&
        isset($trace[$i]["class"]) === FALSE && (
            $trace[$i]["function"] === "require" ||
            $trace[$i]["function"] === "include" ||
            $trace[$i]["function"] === "require_once" ||
            $trace[$i]["function"] === "include_once"
        )
    ){
        $i++;
        goto SKIP_MORE_INCLUSIONS;
    }

    if(!isset($trace[$i])){
        return $depth === 0 ? "public" : $depth;
    }

    if($depth > 0){
        $depth--;
        goto TEST;
    }

    return $trace[$i]["class"] ?? "public";
}

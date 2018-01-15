<?php declare(strict_types = 1);

namespace PHPToolBucket\Bucket;

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

use function debug_backtrace;
use const DEBUG_BACKTRACE_IGNORE_ARGS;
use Error;

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

/**
 * Returns the class name of the calling scope.
 *
 * @throws
 *
 * @return          String|NULL                                                             `String|NULL`
 * Returns the class name of the calling scope.
 */
function callerClassScope(): ?String{
    $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);

    if(count($trace) === 1){
        throw new Error("This function cannot be called from the global scope");
    }

    $i = 1;

    TEST:

    if(isset($trace[$i]) === FALSE){
        return NULL;
    }

    if(
        isset($trace[$i]["class"]) === FALSE && (
            $trace[$i]["function"] === "require" ||
            $trace[$i]["function"] === "include" ||
            $trace[$i]["function"] === "require_once" ||
            $trace[$i]["function"] === "include_once"
        )
    ){
        $i++;
        goto TEST;
    }

    return $trace[++$i]["class"] ?? NULL;
}

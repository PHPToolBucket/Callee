<?php declare(strict_types = 1);

namespace PHPToolBucket\Bucket;

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

use function debug_backtrace;
use const DEBUG_BACKTRACE_IGNORE_ARGS;

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

/**
 * Returns the class name of the calling scope.
 *
 * @return          String|NULL                                                             `String|NULL`
 * Returns the class name of the calling scope.
 */
function calleeClassScope(): ?String{
    $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);

    $framePosition = 1;
    while(
        isset($trace[$framePosition]) &&
        isset($trace[$framePosition]["class"]) === FALSE && (
            $trace[$framePosition]["function"] === "require" ||
            $trace[$framePosition]["function"] === "include" ||
            $trace[$framePosition]["function"] === "require_once" ||
            $trace[$framePosition]["function"] === "include_once"
        )
    ){
        $framePosition++;
    }

    return $trace[$framePosition]["class"] ?? NULL;
}

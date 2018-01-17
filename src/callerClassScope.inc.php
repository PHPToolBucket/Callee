<?php declare(strict_types = 1);

namespace PHPToolBucket\Bucket;

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

use function debug_backtrace;
use const DEBUG_BACKTRACE_IGNORE_ARGS;

//[][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][][]

/**
 * Returns the class name of the calling scope.
 *
 * @throws
 *
 * @param           Int                                     $depth                          `Int{NonNegative}`
 * @TODOC
 *
 * @return          String|Int                                                              `String|NULL`
 * Returns the class name of the calling scope, "public" if called from global scope,
 * otherwise the amount of depth that is not available in the stacktrace.
 */
function callerClassScope(Int $depth = 0){
    return __callerClassScopeInternal($depth, debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
}

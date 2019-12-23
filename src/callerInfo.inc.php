<?php declare(strict_types = 1);

namespace PHPToolBucket\CallerInfo;

use function debug_backtrace;
use const DEBUG_BACKTRACE_IGNORE_ARGS;
use const DEBUG_BACKTRACE_PROVIDE_OBJECT;

/**
 * Returns information about the caller.
 */
function callerInfo(
    Int $depth = 0,
    Bool $includeArguments = TRUE,
    Bool $includeObject = TRUE
): ?Array{
    $mask = 0;
    $mask |= $includeArguments ? 0 : DEBUG_BACKTRACE_IGNORE_ARGS;
    $mask |= $includeObject ? DEBUG_BACKTRACE_PROVIDE_OBJECT : 0;
    return _callerInfoInternal($depth + 1, debug_backtrace($mask));
}

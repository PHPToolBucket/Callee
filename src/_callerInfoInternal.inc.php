<?php declare(strict_types = 1);

namespace PHPToolBucket\CallerInfo;

use function assert;

function _callerInfoInternal(Int $depth, Array $trace): ?Array{
    assert($depth >= 0);
    $index = 0;

    ADVANCE:

    $index++;

    if(!isset($trace[$index])){
        return NULL;
    }

    if(
        isset($trace[$index]["class"]) === FALSE && (
            $trace[$index]["function"] === "require" ||
            $trace[$index]["function"] === "include" ||
            $trace[$index]["function"] === "require_once" ||
            $trace[$index]["function"] === "include_once" ||
            $trace[$index]["function"] === "eval"
        )
    ){
        goto ADVANCE;
    }

    if($depth > 0){
        $depth--;
        goto ADVANCE;
    }

    return $trace[$index];
}

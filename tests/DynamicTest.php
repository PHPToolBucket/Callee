<?php declare(strict_types = 1);

namespace PHPToolBucket\CallerInfoTests;

use PHPUnit\Framework\TestCase;
use function PHPToolBucket\CallerInfo\_callerInfoInternal;

class DynamicTest extends TestCase
{
    private static int $id = 0;

    public function staticMethodCaller(){
        $staticMethodCaller["class"] = 132;
        $staticMethodCaller["function"] = 132;
    }

    public function separators(){
        $separators[0]["function"] = "eval";
        $separators[1]["function"] = "require";
        $separators[2]["function"] = "require_once";
        $separators[3]["function"] = "include";
        $separators[4]["function"] = "include_once";
        return $separators;
    }

    public function separatorsSequences(){
        yield [];

        foreach($this->separators() as $separator){
            yield [$separator];
        }

        foreach($this->separators() as $separator1){
            foreach($this->separators() as $separator2){
                yield [$separator1, $separator2];
            }
        }

        foreach($this->separators() as $separator1){
            foreach($this->separators() as $separator2){
                foreach($this->separators() as $separator3){
                    yield [$separator1, $separator2, $separator3];
                }
            }
        }
    }

    public function callers(){
        $callers[] = [
            "function" => "function_name_" . ++self::$id,
        ];

        $callers[] = [
            "class" => "class_name_" . ++self::$id,
            "function" => "function_name" . ++self::$id,
            "object" => ++self::$id,
        ];

        return $callers;
    }

    public function data(){
        $baseTrace[0]["function"] = "PHPToolBucket\Bucket\__callerInfoInternal";

        foreach($this->separatorsSequences() as $separatorSequence){
            yield [array_merge($baseTrace, $separatorSequence), []];
        }

        foreach($this->separatorsSequences() as $separatorSequence){
            foreach($this->callers() as $caller1){
                yield [
                    array_merge($baseTrace, $separatorSequence, [$caller1], $separatorSequence),
                    [$caller1]
                ];
            }
        }
    }

    /** @dataProvider data */
    public function testDynamically($trace, $callers){
        for($i = count($callers); $i < count($callers) + 5; $i++){
            self::assertSame(NULL, _callerInfoInternal($i, $trace));
        }

        foreach($callers as $callerOffset => $caller){
            $frame = _callerInfoInternal($callerOffset, $trace);
            self::assertSame($caller, $frame);
        }
    }
}

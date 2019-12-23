<?php declare(strict_types = 1);

namespace PHPToolBucket\CallerInfoTests;

use PHPUnit\Framework\TestCase;

class ActualTest extends TestCase
{
    public function testActual(){
        $callerClass1 = new CallerClass1();
        $frame0 = $callerClass1->callerMethod1(0);

        self::assertSame(CallerClass1::CLASS, $frame0["class"]);
        self::assertSame($callerClass1, $frame0["object"]);
        self::assertSame("->", $frame0["type"]);
        self::assertSame("callerMethod1", $frame0["function"]);
        self::assertSame([0], $frame0["args"]);

        self::assertSame(CallerClass1::CLASS, $frame0["class"]);
        self::assertSame($callerClass1, $frame0["object"]);
        self::assertSame("->", $frame0["type"]);
        self::assertSame("callerMethod1", $frame0["function"]);
        self::assertSame([0], $frame0["args"]);
    }
}

class CallerClass1
{
    public function callerMethod1(Int $depth){
        return eval("
            return eval('
                namespace PHPToolBucket\CallerInfoTests;
                use function PHPToolBucket\CallerInfo\callerInfo;
                \$callerClass0 = new CallerClass0();
                return \$callerClass0->callerMethod0($depth);
            ');
        ");
    }
}

class CallerClass0
{
    public function callerMethod0(Int $depth){
        return eval("
            return eval('
                use function PHPToolBucket\CallerInfo\callerInfo;
                return callerInfo($depth);
            ');
        ");
    }
}

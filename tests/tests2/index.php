<?php declare(strict_types = 1); // atom

require("../../vendor/autoload.php");

class Baz{}
(function(){
    // CALLER
    $expect = Baz::CLASS;
    require(__DIR__ . "/caller1.php");

})->bindTo(NULL, Baz::CLASS)();

(function(){
    // CALLER
    $expect = "public";
    require(__DIR__ . "/caller1.php");

})();

$expect = "public";
require(__DIR__ . "/caller1.php");

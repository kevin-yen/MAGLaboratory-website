<?php

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/lib/YieldContent.php";
require __DIR__ . "/lib/LayoutEnvironment.php";

$coffeeFilter = new MtHaml\Filter\CoffeeScript(new CoffeeScript\Compiler);
$yieldFilter = new MtHaml\Filter\YieldContent();
$haml = new MtHaml\LayoutEnvironment('php', array('escape_attrs' => true), array('coffee' => $coffeeFilter, 'yield_content' => $yieldFilter));

define('TARGET', dirname(__DIR__) . '/home/protected/app/views');
chdir(__DIR__ . '/views');

require_once '/home/work/.local/lib/php/haml_compile.php';


saveDirectory();


<?php

require __DIR__ . "/vendor/autoload.php";

require_once '/home/work/.local/lib/php/haml_compile.php';

$coffeeFilter = new MtHaml\Filter\CoffeeScript(new CoffeeScript\Compiler);
$yieldFilter = new MtHaml\Filter\YieldContent();
$haml = new MtHaml\LayoutEnvironment('php', array('escape_attrs' => true, 'indent' => false), array('coffee' => $coffeeFilter, 'yield_content' => $yieldFilter));

define('TARGET', dirname(__DIR__) . '/home/protected/maglab/app/views');
chdir(__DIR__ . '/views');

outputFile($argv[1]);


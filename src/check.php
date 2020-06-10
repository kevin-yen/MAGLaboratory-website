<?php

require __DIR__ . "/vendor/autoload.php";

require_once __DIR__ . '/compilerlib/haml_compile.php';

$coffeeFilter = new MtHaml\Filter\CoffeeScript(new CoffeeScript\Compiler);
$yieldFilter = new MtHaml\Filter\YieldContent();
$yieldingFilter = new MtHaml\Filter\YieldingContent();
$haml = new MtHaml\LayoutEnvironment('php', array('escape_attrs' => true, 'indent' => false), array('coffee' => $coffeeFilter, 'yield_content' => $yieldFilter, 'yielding_content' => $yieldingFilter));

define('TARGET', dirname(__DIR__) . '/home/protected/maglab/app/views');
chdir(__DIR__ . '/views');

outputFile($argv[1]);


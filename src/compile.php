<?php

require __DIR__ . "/vendor/autoload.php";

$coffeeFilter = new MtHaml\Filter\CoffeeScript(new CoffeeScript\Compiler);
$yieldFilter = new MtHaml\Filter\YieldContent();
$haml = new MtHaml\Environment('php', array('escape_attrs' => true), array('coffee' => $coffeeFilter, 'yield_content' => $yieldFilter));

define('TARGET', dirname(__DIR__) . '/protected/app/views');
chdir(__DIR__ . '/views');

require_once '/home/work/.local/lib/php/haml_compile.php';


saveDirectory();


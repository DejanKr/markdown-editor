<?php

chdir(__DIR__);

include "../library/editor.php";
//use markdown\library;

$editor = new Editor();
var_dump($editor->getConfigs());
//var_dump($editor->saveEditor());

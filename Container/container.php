<?php

$builder = new DI\ContainerBuilder();

$builder->useAutowiring(false);
$builder->useAnnotations(false);

$builder->addDefinitions(require __DIR__ . "/dependensies.php");

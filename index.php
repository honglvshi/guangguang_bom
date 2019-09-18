<?php

require_once "./vendor/autoload.php";
use GuangBom\Directory;

$ret = new \GuangBom\Bom([
    "check_path" => [__DIR__,__DIR__]
]);

$ret->find(true);

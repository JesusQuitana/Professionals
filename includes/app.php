<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
use Dotenv\Dotenv;
use Model\ActiveRecord;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

include __DIR__ . '/functions.php';
ActiveRecord::conectarDataBase();
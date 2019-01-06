<?php


$klasse = new ReflectionClass('Logfile');
$objekt = new Logfile;

$methode = $klasse->getMethod('methode');
$methode->invoke($objekt, $objekt);


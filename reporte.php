<?php
require_once 'app/Student.php';
require_once 'app/File.php';
require_once 'app/Report.php';

use App\Report;
$students=[];

if(isset($argv[1])){
    $path =  $argv[1];
    $reporte = new Report();
    $reporte->start($path);
}else{
    die("Debes ingresar un archivo como parámetro. (php reporte.php <nombre.txt>) \n");
}



?>
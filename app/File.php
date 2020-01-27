<?php
namespace App;

class File{

    private $max_size;
    public $path;
    public $type;
    public $lines;

    function __construct($path){
        $this->max_size= 2000; // 2 Mb
        $this->path = $path;
        $this->types= ["txt"];
        $this->lines = [];
    }

    public function validate(){
        if($this->fileExist() && $this->fileType() && $this->fileSize()){
            return true;
        }
        return false;
    }
    public function fileExist(){
        if(!file_exists($this->path) && !is_file($this->path)){
            die("No existe el archivo {$this->path} \n");
        }
        return true;
    }
    public function fileType(){
        $ext = pathinfo($this->path, PATHINFO_EXTENSION);
        if(!in_array($ext,$this->types) ){
            die("El archivo debe tener extensión .txt \n");
        }
        return true;
    }
    public function fileSize(){
        $size = filesize($this->path)/1000;
        if($size > $this->max_size){
            die("El archivo no puede ser mayor a 2Mb \n");
        }
        return true;
    }
    public function convertToArray(){
        $myfile = fopen($this->path, "r") or die("Ups! no se pudo abrir el archivo \n");

        while(!feof($myfile)) {
            $line = explode(" ",fgets($myfile));
            array_push($this->lines, $line);
        }
        fclose($myfile);
        return $this->lines;

    }


}

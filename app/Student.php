<?php
namespace App;

class Student{

    public $name;
    public $minutes;
    public $days;
    function __construct(){
    }


    public function createStudent($name){

        $this->name = $this->cleanName($name);
        $this->minutes = 0;
        $this->days = [];

        return $this;
    
    }

    public function cleanName($string){
        return str_replace( array("\r\n","\r"," ","\n"), "", $string);
    }


    public function validateAndProcessData($line,$student){
       
        $start = date_create($line[3]);
        $end = date_create($line[4]);
        if($minutes = $this->validPresence($start,$end)){
            $student->minutes +=  $minutes;
            if(!in_array($line[2],(array)$student->days)){ //llenar array de dias
                array_push($student->days,$line[2]);  
            }
              
        }
        
        
        return $student;

    }
    

    private function validPresence($start,$end){
        if($this->validateStartAndEndTime($start,$end)){ //validar que fecha de fin sea mayor a la de inicio
            $minutes = $this->getMinutes($start,$end);
            if(!$this->validatePresenceDuration($minutes)){
                return false;
            }
        }else{
            return false;
        }
        return $minutes;
    }

    public function validateStartAndEndTime($start,$end){
        if($start > $end){
            return false;
        }
        return true;
    }

    public function getMinutes($start,$end){
        $diff= date_diff($end,$start);
        $hours= $diff->format('%h');
        return ($diff->format('%h')*60) + $diff->format('%i');
    }
    public function validatePresenceDuration($minutes){
        if($minutes < 5){ // ignorar presencias de menos de 5 minutos
            return false;
        }
        return true;
    }


}

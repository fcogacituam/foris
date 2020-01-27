<?php

use PHPUnit\Framework\TestCase;
use App\Student;

class StudentTest extends TestCase{

    
    public function testCleanName(){
        $student = new Student();
        $this->assertEquals($student->cleanName("   Francisco \r\n"),"Francisco");
    }

    public function testCreateStudent(){
        $student = new Student;
        $new_student = $student->createStudent("Francisco");
        $this->assertIsObject($new_student,"Not object");
    }


    public function testStartTimeLessThanEndTime(){
        $student = new Student();
        $start = "10:00";
        $end = "10:01";
        $this->assertTrue($student->validateStartAndEndTime($start,$end));
    }

    public function testValidatePresenceDuration(){
        $student = new Student();
        $minutes = 6;
        $this->assertTrue($student->validatePresenceDuration($minutes));
    }

    public function testValidateAndProcessData(){
        $line = ["Presence","Francisco", 5, "14:00" ,"15:00", "F505"];

        $expected = new Student;
        $expected->name = "Francisco";
        $expected->minutes = 60;
        $expected->days = [5];

        $student = new Student;
        $student->name = "Francisco";
        $student->minutes = 0;
        $student->days = [];

        $this->assertEquals($expected, $student->validateAndProcessData($line,$student));
    }

    public function testValidateNoInsertPresencesLessThanFiveMin(){
        $line = ["Presence","Francisco", 2, "14:00" ,"14:04", "F505"];

        $expected = new Student;
        $expected->name = "Francisco";
        $expected->minutes = 60;
        $expected->days = [];

        $student = new Student;
        $student->name = "Francisco";
        $student->minutes = 60;
        $student->days = [];

        $this->assertEquals($expected, $student->validateAndProcessData($line,$student));
    }



}
<?php

use PHPUnit\Framework\TestCase;
use App\File;

class FileTest extends TestCase{


    public function testFileExist(){
        $file = new File('example.txt');
        $this->assertTrue($file->fileExist());
    }

    public function testFileType(){
        $file = new File('example.txt');
        $this->assertTrue($file->fileType());
    }

    public function testFileSize(){
        $file = new File('example.txt');
        $this->assertTrue($file->fileSize());
    }

    public function testFileConversionToArray(){
        $file = new File('example.txt');
        $this->assertIsArray($file->convertToArray());
    }


}
<?php

class PathTest extends PHPUnit_Framework_TestCase
{
    public function setUp() {
        mkdir('tmp', 0x775);
    }
	
    public function tearDown() {
        rmdir('tmp');
    }
	
    public function testEmptyFolder() {
        $trueResult = array(
        	'path' => './tmp/'
        );
        $this->assertEquals($trueResult, Path::dirContent('./tmp'));
    }

    public function testFilesOnly() {
    	
    	file_put_contents('./tmp/test1.txt', 'test1');
    	file_put_contents('./tmp/test2.txt', 'test2');
    	
    	$trueResult = array(
        	'path' => './tmp/',
        	'files' => array('test1.txt', 'test2.txt')
        );
        $this->assertEquals($trueResult, Path::dirContent('./tmp'));
        
        unlink('./tmp/test1.txt');
        unlink('./tmp/test2.txt');
    }
    
    public function testFilesAndFolders() {
    	
    	file_put_contents('./tmp/test1.txt', 'test1');
    	file_put_contents('./tmp/test2.txt', 'test2');
    	mkdir('test_folder');
    	
    	$trueResult = array(
        	'path' => './tmp/',
        	'files' => array('test1.txt', 'test2.txt')
        );
        $this->assertEquals($trueResult, Path::dirContent('./tmp'));
        
        unlink('./tmp/test1.txt');
        unlink('./tmp/test2.txt');
        rmdir('test_folder');
    }
    
    public function testSearchMask() {
    	
    	file_put_contents('./tmp/test1.txt', 'test1');
    	file_put_contents('./tmp/test2', 'test2');
    	
    	$trueResult = array(
        	'path' => './tmp/',
        	'files' => array('test1.txt')
        );
        $this->assertEquals($trueResult, Path::dirContent('./tmp', '/\.txt/'));
        
        unlink('./tmp/test1.txt');
        unlink('./tmp/test2');
    }
}
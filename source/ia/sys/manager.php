<?php
class ia_sys_manager{
	public $baseDir, $webDir;
	
	public $dbServer= 'localhost';
	public $db= 'ima';
	public $language= 'en';
	
	private $texts;
	private $initialized;
	
	public function __construct($baseDir){
		// php Initialization
		ini_set('display_errors', 1);
		ini_set('memory_limit', -1);
		error_reporting('E_STRICT');
		
		// ia initialization
		$this->initialized= false;
		$this->baseDir= $baseDir;
		$this->webDir= substr($_SERVER['SCRIPT_FILENAME'], 0, strrpos($_SERVER['SCRIPT_FILENAME'],'/'));
		
		$envFilename= "$this->baseDir/config/environment"; 
		if (file_exists($envFilename)){
			list($this->dbServer, $this->db, $this->language)= file($envFilename, FILE_IGNORE_NEW_LINES);
			$this->initialized= true;
		}
		
		require_once("$baseDir/source/ia/sys/texts.php");
		$this->texts= new ia_sys_texts();
	}

	public function getSourceFilename($id){
		$filePath= explode('_',$id); 
		return "{$this->baseDir}/source/".implode('/',$filePath);
	}
	
	
	public function loadClass($className){
		$classModule= ($last_= strrpos($className,'_')) > 0 ? substr($className, 0, $last_): '';
		if (isset($this->texts)) {
			$this->texts->loadFile($classModule, getSourceFilename($classModule)."/texts.{$this->language}"); 
		}
		require_once $this->getSourceFilename($className).'.php';
	}
	
	public function newRequest(){
		if (!$this->initialized) include("$this->webDir/setEnvironment.php");			
	}
	
}
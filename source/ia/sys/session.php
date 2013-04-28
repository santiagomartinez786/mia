<?php
class ia_sys_session extends ia_object{
	
	
	public function __sleep(){
		return array('usuario');	
	}
	
	public function start(){
		
	}
	
	public function __construct(){
		global $_SERVER;
		
	}
}

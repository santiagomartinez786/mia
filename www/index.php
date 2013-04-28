<?php
define('BASEDIR', '/usr/local/mia');

require_once BASEDIR.'/source/ia/sys/manager.php';
$_IA_MANAGER= new ia_sys_manager(BASEDIR);
function __autoload($className){ return $_IA_MANAGER->loadClass($className); }
$_IA_MANAGER->newRequest();


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/$hook['post_controller_constructor'] = array(  
            'class' => 'Permission',  
            'function' => 'check_role_permission',  
            'filename' => 'Permission.php',  
            'filepath' => 'hooks',  
            'params' => array('element1', 'element2', 'element3')  
            );

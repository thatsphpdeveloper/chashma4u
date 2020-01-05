<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  
class Permission  {  
	public function check_role_permission(){  
        echo "Welcome to JavaTpoint. This is ";
        $CI =& get_instance();
        echo ucwords($CI->session->userdata(PREFIX."sessUserName"));
    }  
}  
?>  
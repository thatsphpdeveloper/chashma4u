<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Format class
 * Help convert between various formats such as XML, JSON, CSV, etc.
 *
 * @author    Phil Sturgeon, Chris Kacerguis, @softwarespot
 * @license   http://www.dbad-license.org/
 */
class Common_lib {	
	
	public $outputdata 	= array();
	public function __construct(){		
		$CI = &get_instance();
		//echo PREFIX;

		$language = 'english' ;
		if(isset($_REQUEST['language']) && !empty($_REQUEST['language']))
			$language =   $_REQUEST['language'];
		else if(isset($CI->session->userdata[PREFIX."sessLang"]) && !empty($CI->session->userdata[PREFIX."sessLang"])) 
			$language =  $CI->session->userdata[PREFIX."sessLang"];			
		$CI->lang->load('custom_messages',$language);		

	}

	public function directories($directory){
	    $glob = glob($directory . '/*');

	    if($glob === false)
	    {
	        return array();
	    }
		$directList = array();
		if(!empty($glob)) {
			foreach($glob as $glabDir) {
				if(is_dir($glabDir)) {
					$a =  explode('/', $glabDir);
					array_push($directList, end($a));
				}
			}
		}
		return $directList;
	}
	
	public function cleanString($string) {

		$CI = &get_instance();
		$db = get_instance()->db->conn_id;
		$string = str_replace('"','',$string);
		$detagged = trim($string);
		if(function_exists('mysqli_real_escape_string')) {
		    if(get_magic_quotes_gpc()) {
		        $stripped = stripslashes($detagged);
		        $escaped = mysqli_real_escape_string($db, $stripped);
		    } else
		        $escaped = mysqli_real_escape_string($db, $detagged);
		    $escaped = str_replace('\\\\', '', $escaped);
		    return $escaped;
		}
		else{
			return $detagged ;	    
		}
	}

	public function sanitize($input) {
		$output = is_array($input)?array():'';
	    if (is_array($input)) {
	        foreach($input as $var=>$val) {
	            $output[$var] =$this->sanitize($val);
	        }
	    }
	    else {
	        $input  = $this->cleanString($input);
	        $output = $input;
	    }
	    return $output;
	}
	public function setLangData() {
		$CI = &get_instance();
		$CI->Common_model->exequery("SET NAMES utf8");
	}
	public function slugstring($string){
	   $CI = &get_instance();
		return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
	}
	/*-------------- Generate Slug ----*/
	public function Slug($string){
	   $CI = &get_instance();
		return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));

	}
	public function check_slug_exists($slug,$table_name,$field_name,$id,$field_id){
	   $CI = &get_instance();
		$cond=($id!='' && $id > 0) ? " AND ".$field_id."!='".$id."'" : "";		
		$qry=$CI->Common_model->selRowData($table_name,"",$field_name."='$slug' AND status !=2 ".$cond."");
		// $qry=mysql_query("SELECT * FROM ".$table_name." WHERE ".$field_name."='$slug' ".$cond."");
		if($qry)
			return true;		
		else		
			return false;					
	}
	public function create_unique_slug($val,$table_name,$field_name,$id,$fieldid,$counter=0)	{	
	   $CI = &get_instance();	
		if($counter>0)		
			$slug = $this->Slug($val).'-'.$counter;		
		else		
			$slug = $this->Slug($val);	
		$check_slug_exists =$this->check_slug_exists($slug,$table_name,$field_name,$id,$fieldid);
		if($check_slug_exists){
			$counter++;
			 return $this->create_unique_slug($val,$table_name,$field_name,$id,$fieldid, $counter);	
		}
		return $slug;		
	}
	/*-------------- Generate sku ----*/

	public function check_sku_exists($sku,$id){
	   $CI = &get_instance();
		$cond=($id!='' && $id > 0) ? " AND productId !='".$id."'" : "";		
		$qry=$CI->Common_model->selRowData("ch_product","","sku='$sku' AND status !=2 ".$cond."");
		if($qry)
			return true;		
		else		
			return false;					
	}
	public function create_unique_sku($id, $counter = 0)	{	
	   $CI = &get_instance();	
		if($counter>0)		
			$sku = '100'.$id.'-'.$counter;		
		else		
			$sku = '100'.$id;	
		$check_sku_exists =$this->check_sku_exists($sku,$id);
		if($check_sku_exists){
			$counter++;
			 return $this->create_unique_sku($id,$counter);	
		}
		return $sku;		
	}

	



	public function updateOrderStatus($orderId = 0,$detailId = 0){
	   $CI = &get_instance();
	   $isUpdatedOrder = 0;
	   if($orderId == 0 && $detailId > 0)
			$orderId=$CI->Common_model->getSelectedField("ch_order_detail","orderId","detailId='".$detailId."'");
		if($orderId > 0){

			$detailData=$CI->Common_model->exequery("SELECT DISTINCT status FROM `ch_order_detail` WHERE orderId = '".$orderId."' ORDER BY status asc",1);
			if (isset($detailData->status))
				$isUpdatedOrder = $CI->Common_model->update("ch_order",array('status'=>$detailData->status),"orderId='".$orderId."'");
		}
	   
		
		if($isUpdatedOrder)
			return true;		
		else		
			return false;					
	}



	
   /* Create Authentication for user */
    function create_auth($role,$insertId,$email,$pass='',$status=0,$langSuffix='') {
    	$CI = &get_instance();	
        $responseStr = 0;

        if ($email != '') {
        // inserting authentication details
            $pass = (empty($pass))?generateStrongPassword(6,false,'lud'):$pass;
            $authData               =   array();
            $authData['emailId']    =   $email;
            $authData['password']   =   md5($pass);
            $authData['role']       =   $role;
            $authData['roleId']     =   $insertId;
		    $authData['status']     =   $status;
            $authInsert             =   $CI->Common_model->insertUnique("sk_auth", $authData);
            if ($authInsert) {
                //Send welcome email
                $settings = array();
                $settings["template"]               =   "welcome_email_tpl".$langSuffix.".html";
                $settings["email"]                  =   $email;
                $settings["subject"]                =   "Welcome to chashma4u";
                $contentarr['[[[ROLE]]]']           =   ucfirst($role);
                $contentarr['[[[USERNAME]]]']       =   $email;
                $contentarr['[[[PASSWORD]]]']       =   $pass;
                $contentarr['[[[LOGINURL]]]']       =   BASEURL."/dashboard/".$role."/login";
                $settings["contentarr"]             =   $contentarr;
                $ismailed = $this->sendMail($settings); 

                $responseStr =  $authInsert;
            }else{
                $responseStr =  0;
            }
        }
         return $responseStr;
    }


	// Upload image
	public function _doUpload($uploadSettings) {
	   $CI = &get_instance();	
		$CI->load->library('upload', $uploadSettings);
		$CI->upload->initialize($uploadSettings);
		if ( !$CI->upload->do_upload($uploadSettings['inputFieldName'])){
			$error = array('error' => $CI->upload->display_errors());
			return 0;	
		}
		else {
			$imgData = $CI->upload->data();
			if(isset($uploadSettings['createThumb']) && file_exists($uploadSettings['upload_path'] . "/". $uploadSettings['file_name'])) {
				$thumbPath = $uploadSettings['upload_path'] . "/". $uploadSettings['file_name'];
				if($uploadSettings['createThumb']) {
					$uploadSettings['thumbPath'] = $thumbPath;					
					$this->_createThumbnail($uploadSettings);
				}
			}
			return $imgData['file_name'];
		}
	}

	
	/* Send email */	
	public function sendMail($settings){
		$CI = &get_instance();
		$CI->load->library('email');
		$logoUrl				=		BASEURL."/system/static/frontend/img/logo.png";			
		$siteUrl				=		BASEURL;		
		$contactMail			=		'info@chashma4u.com';		
		
		$template 			= 	ABSSTATICPATH."/emailTemplates/".$settings["template"];
		$subject			= 	$settings["subject"];	
		$mail_content 		= 	file_get_contents($template);
		$mail_content		= 	str_replace("[[[LOGO]]]", $logoUrl, $mail_content);
		$mail_content		= 	str_replace("[[[SITEURL]]]", $siteUrl, $mail_content);
		$mail_content		= 	str_replace("[[[CONTACTMAIL]]]", $contactMail, $mail_content);

		

		if(array_key_exists('contentarr', $settings)){
			$contentarr			=		$settings["contentarr"];
			foreach($contentarr as $key=>$value){
				$mail_content		= 	str_replace($key, $value, $mail_content);
			}
		}
		$mail_content		= 	str_replace("[[[YEAR]]]",date('Y'), $mail_content);
				
		$config['protocol'] = 'sendmail';
		$config['mailtype'] = 'html';
		$CI->email->initialize($config);
		$CI->email->from('info@webcoderskull.in',"CHASHMA4U");
			
		$CI->email->to($settings["email"]); 
		$CI->email->subject($subject);
		$CI->email->message($mail_content); 
			
		if(isset($settings['attachementFlag'])&& !empty($settings['attachementFlag'])){
			if(is_array($settings['attachementFlag'])){
				foreach($settings['attachementFlag'] as $attachementfile)
					$CI->email->attach($attachementfile);
			}else
				$CI->email->attach($settings['attachementFlag']);
		}
		if($CI->email->send())
			return 1;
		else
			return $CI->email->print_debugger(array('headers'));
		
	}

		/* Generate QR code */
	public function mailcheck($cgh =''){
		$CI = &get_instance();
		$CI->load->library('email');

		$CI->email->from('thatsvivek007@gmail.com', 'Vivek');
		$CI->email->to('dsmail.vivek@gmail.com');

		$CI->email->subject('Email Test');
		$CI->email->message('Testing the email class.');

		$CI->email->send();
	}

	/* Set member session info in public veriable */
	public function setSessionVariables(){	
		$CI = &get_instance();	
		$CI->sessDashboard	=	$CI->session->userdata(PREFIX.'sessDashboard');
		/* check sessIsNotTour = 1 then redirect to tour page */
		if(($CI->sessDashboard == 'admin' && ($CI->session->userdata(PREFIX.'sessAuthId') == 1 || $CI->session->userdata(PREFIX."sessEmployeeAddedBy") == 'admin')) || ($CI->sessDashboard == 'vendor' && $CI->session->userdata(PREFIX.'sessAuthId') > 1)) {
		
			$CI->sessRole	=	$CI->session->userdata(PREFIX.'sessRole');
			$CI->sessDashboard	=	$CI->session->userdata(PREFIX.'sessDashboard');
			$CI->sessDashboardId	=	$CI->session->userdata(PREFIX.'sessDashboardId');
			$CI->sessAuthId		=	$CI->session->userdata(PREFIX.'sessAuthId');
			$CI->sessEmail		=	$CI->session->userdata(PREFIX."sessEmail");
			$CI->sessRoleId		=	$CI->session->userdata(PREFIX."sessRoleId");
			$CI->sessLang		=	$CI->session->userdata(PREFIX."sessLang");
			$CI->sessUserName	=	$CI->session->userdata(PREFIX."sessUserName");
			$CI->sessEmployeeRole	=	$CI->session->userdata(PREFIX."sessEmployeeRole");
			$CI->sessEmployeeRoleId	=	$CI->session->userdata(PREFIX."sessEmployeeRoleId");
			$CI->sessPermissions	=	$CI->session->userdata(PREFIX."sessPermissions");
			$CI->sessEmployeeAddedBy	=	$CI->session->userdata(PREFIX."sessEmployeeAddedBy");
			$CI->sessEmployeeAddedById	=	$CI->session->userdata(PREFIX."sessEmployeeAddedById");


			
		} else
			redirect(BASEURL.'/login');
	}
	/* Set member session permission */
	public function checkRolePermission($permissions = array(), $isRedirect = 1){	
		$CI = &get_instance();
		if($CI->session->userdata(PREFIX.'sessEmployeeRoleId') > 0){
			$userPermissions = (!empty($CI->session->userdata(PREFIX."sessPermissions")))?$CI->session->userdata(PREFIX."sessPermissions"):array();
			$isAllowed = 0;
			foreach ($permissions as $permission) {
				if(in_array($permission, $userPermissions))
					$isAllowed = 1;
			}
			if($isAllowed == 0){
				if($isRedirect){
					$this->setSessMsg("Unauthorised Access!", 2);
					redirect(DASHURL."/".$CI->sessDashboard."/welcome");
				}
				else
					return array("valid" => false, "msg" => "Unauthorised Access!");

				exit;
			}


			
		}
		return array("valid" => true, "msg" => "Authorised Access!");
	}
		/* Set user session info in public veriable */
	public function setUserSessionVariables(){	
		$CI = &get_instance();	
		$CI->userRole	=	$CI->session->userdata(PREFIX.'userRole');
		/* check sessIsNotTour = 1 then redirect to tour page */
		if($CI->session->userdata(PREFIX.'userAuthId') > 1) {
		
			$CI->userEmail		=	$CI->session->userdata(PREFIX."userEmail");
			$CI->userRoleId		=	$CI->session->userdata(PREFIX."userRoleId");
			$CI->userAuthId		=	$CI->session->userdata(PREFIX."userAuthId");
			$CI->userImg		=	$CI->session->userdata(PREFIX."userImg");
					
		} else
			redirect(BASEURL.'/login');
			
	}
	/* Set Admin session info in public veriable */
	public function setVendorSessionVariables(){
		$CI = &get_instance();	
		$CI->sessRole	=	$CI->session->userdata(PREFIX.'sessRole');
		/* check sessIsNotTour = 1 then redirect to tour page */
		if($CI->session->userdata(PREFIX.'sessAuthId') > 0) {
		
			$CI->sessAuthId		=	$CI->session->userdata(PREFIX.'sessAuthId');
			$CI->sessEmail		=	$CI->session->userdata(PREFIX."sessEmail");
			$CI->sessRoleId		=	$CI->session->userdata(PREFIX."sessRoleId");
			$CI->sessLang		=	$CI->session->userdata(PREFIX."sessLang");
			$CI->sessUserName	=	$CI->session->userdata(PREFIX."sessUserName");
			$CI->sessEmployeeRole	=	$CI->session->userdata(PREFIX."sessEmployeeRole");
			$CI->sessEmployeeRoleId	=	$CI->session->userdata(PREFIX."sessEmployeeRoleId");
			$CI->sessPermissions	=	$CI->session->userdata(PREFIX."sessPermissions");
			$CI->sessEmployeeAddedBy	=	$CI->session->userdata(PREFIX."sessEmployeeAddedBy");


			
		} else {
			redirect(DASHURL."/login");
		}
	}
	
	/* set all types of flash messages 
	|	 sesstype = 0 //flashdata
	|  sesstype = 1 //userdata
	*/
	public function setSessMsg($message="", $msgtype=1, $sesstype=0){
		$CI = &get_instance();		//echo 12;exit;
		$alertArray	=	array();

		if($msgtype == 1){ //Success message
			$alertArray["alertType"] = "success"; 
			$alertArray["alertMessage"] = $message; 
			$alertArray["alertMessageHtml"] = '<li onclick="javascript:$(this).fadeOut(500)" style="list-style: none;overflow: hidden; margin: 4px 0px; border-radius: 2px; border-width: 2px; border-style: solid; border-color: rgb(124, 221, 119); box-shadow: rgba(0, 0, 0, 0.1) 0px 2px 4px; background-color: rgb(188, 245, 188); color: darkgreen; cursor: pointer;" class="animated flipInX"><div class="noty_bar noty_type_success" id="noty_1432600013676628200"><div class="noty_message" style="font-size: 14px; line-height: 16px; text-align: center; padding: 10px; width: auto; position: relative;"><span class="noty_text">'.$message.'</span></div></div></li>';
		} elseif($msgtype == 2){ //Error message
			$alertArray["alertType"] = "danger"; 
			$alertArray["alertMessage"] = $message; 
			$alertArray["alertMessageHtml"] = '<li onclick="javascript:$(this).fadeOut(500)" style="list-style: none;overflow: hidden; margin: 4px 0px; border-radius: 2px; border-width: 2px; border-style: solid; border-color: rgb(226, 83, 83); box-shadow: rgba(0, 0, 0, 0.1) 0px 2px 4px; background-color: rgb(255, 129, 129); color: rgb(255, 255, 255); cursor: pointer;" class="animated flipInX"><div class="noty_bar noty_type_error" id="noty_505214828237683140"><div class="noty_message" style="font-size: 14px; line-height: 16px; text-align: center; padding: 10px; width: auto; position: relative; font-weight: bold;"><span class="noty_text">'.$message.'</span></div></div></li>';
		} elseif($msgtype == 3){ //Warning message
			$alertArray["alertType"] = "warning"; 
			$alertArray["alertMessage"] = $message; 
			$alertArray["alertMessageHtml"] = '<li onclick="javascript:$(this).fadeOut(500)" style="list-style: none;overflow: hidden; margin: 4px 0px; border-radius: 2px; border-width: 2px; border-style: solid; border-color: rgb(255, 194, 55); box-shadow: rgba(0, 0, 0, 0.1) 0px 2px 4px; background-color: rgb(255, 234, 168); color: rgb(130, 98, 0); cursor: pointer;" class="animated flipInX"><div class="noty_bar noty_type_warning" id="noty_140323524152335250"><div class="noty_message" style="font-size: 14px; line-height: 16px; text-align: center; padding: 10px; width: auto; position: relative;"><span class="noty_text"><strong>Warning!</strong> <br> '.$message.'</span></div></div></li>';
		}       
		if($sesstype==1)		
			$CI->session->set_userdata('sessMessage', $alertArray);
		else 
			$CI->session->set_flashdata('sessMessage', $alertArray);
	}	
	
	/* Show session message */
	public function showSessMsg($plainText = false){
		$CI = &get_instance();		
		$alertArray = array();
		$msg	=	"";
		if($plainText){
      if($CI->session->userdata('sessMessage') != ""){			
				$msg	=	$CI->session->userdata('sessMessage');
				$CI->session->set_userdata('sessMessage', '');			
			}else if($CI->session->flashdata('sessMessage') != ""){
				$msg	=	$CI->session->flashdata('sessMessage');
			}
		}else{
			if($CI->session->userdata('sessMessage') != ""){			
				$alertArray	=	$CI->session->userdata('sessMessage');
				$msg	=	$alertArray["alertMessageHtml"];
				$CI->session->set_userdata('sessMessage', "");			
			}else if($CI->session->flashdata('sessMessage') != ""){			
				$alertArray	=	$CI->session->flashdata('sessMessage');
				$msg	=	$alertArray["alertMessageHtml"];
			}
		}
		return $msg;
	}

	
	// Encrypt CVV Data
	function encrypt_ccv ($cvv) {
		$finalcvv = '';
		for ($i=0; $i< strlen($cvv); $i++) {
			$finalcvv .=$cvv[$i].rand(11,99); 
		}
		return $finalcvv;
	}
	// DeCrypt CVV Data
	function decrypt_ccv ($cvv) {
		$finalcvv = '';
		if(strlen($cvv) > 5)
			$finalcvv = $cvv[0].$cvv[3].$cvv[6];
        if(isset($cvv[9]))
            $cvv .= $cvv[9];
        return $finalcvv;
		
	}

	/*Change text from one langulage to another language.*/ 
	function changeLanguage($text,$source,$target){
		require_once './system/static/domParsing/simple_html_dom.php';

		$result=''; 
		try{
			if(!empty($text) && !empty($source) && !empty($target)){
				$lan=trim($source).'|'.trim($target);
				 /*Initiliza Array*/ 
				$replace_pairs = array( "\t" => '%20', " " => '%20', );
				$url='http://www.google.com/translate_t?hl=en&ie=UTF8&text='.$text.'&langpair='.$lan.'';
				$finalurl = strtr($url, $replace_pairs);
				//$data=file_get_contents();
				try {
					$html = file_get_html($finalurl);
					try {
						$result= (is_object($html->find('#result_box',0)))? $html->find('#result_box',0)->plaintext :'';
				
					}
					catch(Exception $e){ $result=''; }
				}
				catch(Exception $e){ $result=''; }
				
				/*$data=substr($data,strpos($data,"id=result_box"));
				$data=substr($data,strpos($data,">"));
				Remove All Html Tag
				$data=strip_tags($data);
				$data=str_replace('>','',$data); $result=strstr($data, '{', true); */
			}
		}
		catch(Exception $e){ $result=''; }

		return $result; 
	}


	/*------------------------ Upload Images --------------------*/

	public function uploadImageFile($files, $targetPath, $mandatory, $fieldname, $isMultiPle = 0) {
		$CI = &get_instance();
		$returnData = ( $mandatory ) ? array('valid' => false, 'msg' => 'file upload Required', 'filename' => '') : array('valid' => true, 'msg' => 'file upload Required', 'filename' => '');
		if( !$isMultiPle ) {
			if(isset($files[$fieldname]['name']) && !empty($files[$fieldname]['name'])) {
				$fileExtsion = $files[$fieldname]['name'];
				$config['upload_path'] = UPLOADDIR.'/'.$targetPath;
			    $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
			    $config['file_name'] = rand(1000,100000).time().'-'.$fileExtsion;
			    $config['overwrite'] = FALSE;
			    $config['encrypt_name'] = FALSE;
			    $config['remove_spaces'] = TRUE;

			   	if(!is_dir($config['upload_path']))
			   		mkdir($config['upload_path'], 0777, TRUE);

			    $CI->load->library('upload', $config);
			    if ($CI->upload->do_upload($fieldname)) {

			    	$imgData = $CI->upload->data();
			    	$returnData['filename'] = $imgData['file_name']; 
			    	$returnData['valid'] = true;

			    	$createThumb = array(
			    		array('w'=>200, 'h'=>200),
			    		array('w'=>295, 'h'=>320),
			    		array('w'=>290, 'h'=>280),
			    		array('w'=>305, 'h'=>305),
			    		array('w'=>585, 'h'=>230),
			    		array('w'=>600, 'h'=>645),
			    		array('w'=>730, 'h'=>600),

			    		array('w'=>285, 'h'=>310),
			    		array('w'=>290, 'h'=>270),
			    		array('w'=>295, 'h'=>295),
			    		array('w'=>345, 'h'=>270),
			    		array('w'=>370, 'h'=>250),
			    		array('w'=>370, 'h'=>370),
			    		array('w'=>370, 'h'=>450),
			    		array('w'=>370, 'h'=>525),
			    		array('w'=>765, 'h'=>300),
			    		array('w'=>148, 'h'=>122),
			    		
			    		array('w'=>290, 'h'=>295),
			    		array('w'=>350, 'h'=>220)
			    	);

					$thumbPath = $config['upload_path'] . "/". $imgData['file_name'];
					if(file_exists($thumbPath)) {
						foreach ($createThumb as $thumb) {
							$newPath = $config['upload_path'] . "/". $thumb['w'].'_'.$thumb['h'].'/';
							if(!is_dir($newPath)) mkdir($newPath, 0777, TRUE);
							$uploadSettings['upload_path'] = $newPath;	
							$uploadSettings['thumbPath'] = $thumbPath;	
							$uploadSettings['thumbWidth'] = $thumb['w'];	
							$uploadSettings['thumbHeight'] = $thumb['h'];					
							$this->_createThumbnail($uploadSettings);
							
						}
					}
			    	
				}
				else {
				
					$returnData['valid'] = false;
					$returnData['msg'] = $CI->upload->display_errors();
				}
			}
		}
		else {
			$uploaddataArray = array();
			$filesdata = $files[$fieldname];
			foreach($filesdata['name'] as $key => $image) {
				$_FILES['images']['name']= $filesdata['name'][$key];
	            $_FILES['images']['type']= $filesdata['type'][$key];
	            $_FILES['images']['tmp_name']= $filesdata['tmp_name'][$key];
	            $_FILES['images']['error']= $filesdata['error'][$key];
	            $_FILES['images']['size']= $filesdata['size'][$key];
	            $fileExtsion = $_FILES['images']['name'];//end(explode('.',$files[$fieldname]['name']));
				$config['upload_path'] = UPLOADDIR.'/'.$targetPath;
			    $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
			    $config['file_name'] = rand(1000,100000).time().'.'.$fileExtsion;
			    $config['overwrite'] = FALSE;
			    $config['encrypt_name'] = FALSE;
			    $config['remove_spaces'] = TRUE;
			   if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
			    $CI->load->library('upload', $config);
			    if ($CI->upload->do_upload('images')) {
			    	$returnData['valid'] = true;
			    	$imgData = $CI->upload->data();
			    	array_push($uploaddataArray, $imgData['file_name']);


			    	$createThumb = array(
			    		array('w'=>148, 'h'=>122)
			    	);

					$thumbPath = $config['upload_path'] . "/". $imgData['file_name'];
					if(file_exists($thumbPath)) {
						foreach ($createThumb as $thumb) {
							$newPath = $config['upload_path'] . "/". $thumb['w'].'_'.$thumb['h'].'/';
							if(!is_dir($newPath)) mkdir($newPath, 0777, TRUE);
							$uploadSettings['upload_path'] = $newPath;	
							$uploadSettings['thumbPath'] = $thumbPath;	
							$uploadSettings['thumbWidth'] = $thumb['w'];	
							$uploadSettings['thumbHeight'] = $thumb['h'];					
							$this->_createThumbnail($uploadSettings);
							
						}
					}
			    	
				}
				else {
					$returnData['valid'] = false;
					$returnData['msg'] = $CI->upload->display_errors();
				}
			}			
			$returnData['filename'] = $uploaddataArray;  
		}
		return $returnData;
	}
	/*-------------------------- End File Upload -----------------------*/

	//Create thumbnail
	public function _createThumbnail($fileSettings) {
		$CI = &get_instance();
		$CI->image_lib = null;
		/* Create thumbnail image*/   
		$config['image_library'] 	= 'gd2';
		$config['source_image']  	= $fileSettings['thumbPath'];
		$config['new_image']  	= $fileSettings['upload_path'];
		//$config['create_thumb'] 	= TRUE;
		$config['maintain_ratio'] 	= false;
		$config['quality'] 	= 100;
		$config['width'] 	= $fileSettings['thumbWidth'];
		$config['height'] 	= $fileSettings['thumbHeight'];
		$CI->load->library('image_lib', $config);
		if(! $CI->image_lib->resize()) {
			return 3;//echo  $this->image_lib->display_errors();
		} else { 
			// $CI->image_lib->clear();
			return 1;
		}
	}
	/*-------------------------- Drop Down list ------------------------*/
	function getDropDown($qry, $id = ''){
		$CI = &get_instance();
		$getData = $CI->Common_model->exequery($qry);
		$optionhtml = '';
		if( $getData ) {
			foreach( $getData as $getDataVal ) {
				$selected = ($id != '') ? (($id == $getDataVal->id) ? "selected" : "") : '';
				$optionhtml .= '<option value="'.$getDataVal->id.'" '.$selected.'>'.$getDataVal->name.'</option>';
			}
		}
		return $optionhtml;
	}
	/*-------------------------- End Drop Down list ------------------------*/	
	/*-------------------------- Count Word --------------------------------*/
	function CountWord($lenght,$data){
	 	return implode(' ', array_slice(explode(' ', strip_tags(stripslashes($data))), 0, $lenght));
	}
	
	function getUserIpAddr(){
	    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
	        //ip from share internet
	        $ip = $_SERVER['HTTP_CLIENT_IP'];
	    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
	        //ip pass from proxy
	        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    }else{
	        $ip = $_SERVER['REMOTE_ADDR'];
	    }
	    return $ip;
	}
	
	function sendMessage($number, $message){
		$response = array("valid" => false, "msg"=>"Number or message is missing.");
	    if(!empty($number) && !empty($message)){
	        
			$url='http://manage.staticking.net/index.php/smsapi/httpapi/?uname=newbrightoverseas&password=123456&sender=Chashm&receiver='.$number.'&route=TA&msgtype=1&sms='.urlencode($message);

	        try{
				$curl = curl_init();

				  curl_setopt_array($curl, array(
				  CURLOPT_URL => $url,
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "GET",
				  CURLOPT_HTTPHEADER => array(
				    "cache-control: no-cache"
				  ),
				));

				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);

			} catch(Exception $e){
				$err = $e->getMessage();
			}
			if ($err)
				$response['msg'] = $err;
			else
				$response = array("valid" => true, "msg"=>$response);
		}
		return $response;

	}

	function sendOrderPlacedNotifications($status, $generatedId){
		$CI = &get_instance();
		$userIP = $CI->common_lib->getUserIpAddr();
		$userId = ($CI->session->userdata(PREFIX.'userRoleId'))?$CI->session->userdata(PREFIX.'userRoleId'):0;
		$cartId = ($CI->session->userdata(PREFIX.'cartId'))?$CI->session->userdata(PREFIX.'cartId'):0;		
		$cond = ($cartId>0)? " AND cartId = '".$cartId."'":(($userId>0)? " AND userId = '".$userId."'":((!empty($userIP))? " AND ip = '".$userIP."'":''));
		if ($cond){
			$cartData = $CI->Common_model->exequery("SELECT * FROM ".tablePrefix."cart WHERE status ='0' $cond", 1);
			if ($cartData) {
				$CI->Common_model->del("ch_cart","cartId = ".$cartData->cartId);
				$CI->Common_model->del("ch_cart_detail","cartId = ".$cartData->cartId);
				// $CI->Common_model->del("ch_visitor","cartId = ".$cartData->cartId);
			}
		}
		
		$CI->session->unset_userdata(PREFIX.'cartItemsCount');
		$CI->session->unset_userdata(PREFIX.'cartGrandtotal');
		$CI->session->unset_userdata(PREFIX.'cartTotal');
		$CI->session->unset_userdata(PREFIX.'deliveryChargeTotal');
		$CI->session->unset_userdata(PREFIX.'cartId');
		$CI->session->unset_userdata(PREFIX.'order_transactionId');
		$CI->session->unset_userdata(PREFIX.'generatedId');


		if (!empty($status) && !empty($generatedId)) {


            $orderData = $CI->Common_model->exequery("SELECT od.*, us.firstName as user, us.email as email, us.mobile as  mobile, (SELECT GROUP_CONCAT(productName) FROM ch_product  WHERE productId IN (SELECT productId FROM ch_order_detail  WHERE orderId = od.orderId) ) as products from ".tablePrefix."order as od left join ".tablePrefix."user as us on us.userId = od.userId WHERE od.generatedId = '".$generatedId."'",1);
            $messg = '';
           
            if (!empty($orderData)) {

	            if ($status == 'order_success'){
	            	$CI->Common_model->insert(tablePrefix."notification", array("role" => 'admin', "roleId" =>0, "type" => 'new_order_recieved', "typeId" => $orderData->generatedId, "status" => 0, "addedOn" => date('Y-m-d H:i:s'), "updatedOn" => date('Y-m-d H:i:s')));
	            	
	            	$messg = "Your CHASHMA4U order $orderData->generatedId has been recieved successfully.";
	            	// $this->sendMessage($orderData->mobile, $messg);
	            	if(isset($orderData->email) && !empty($orderData->email)){
		            	$settings = array();
		                $settings["template"]               =   "order_success_tpl.html";
		                $settings["email"]                  =   $orderData->email;
		                $settings["subject"]                =   "Your CHASHMA4U order";
		                $contentarr['[[[NAME]]]']           =   ucfirst($orderData->user);
		                $contentarr['[[[GENERATEDID]]]']    =   $orderData->generatedId;
		                $contentarr['[[[ORDERURL]]]']       =   BASEURL."/user/order";
		                $settings["contentarr"]             =   $contentarr;
		                $ismailed = $this->sendMail($settings);
		            }
	            }elseif ($status == 'payment_success'){
	            	$messg = "Your CHASHMA4U order $orderData->generatedId payment recieved but we have some issue with your order , Our team will confirm your order soon.";
	            }

	            if(isset($orderData->mobile) && !empty($orderData->mobile) && !empty($messg))
	            	$this->sendMessage($orderData->mobile, $messg);
	        }
        }

 		//updating other payment
 		$CI->Common_model->update("ch_order_transaction",array("paymentStatus"=> 2), "paymentMethod !='cod' AND paymentStatus = 0 AND `addedOn` < DATE_SUB( NOW(), INTERVAL 15 MINUTE )");
                       

	}
}
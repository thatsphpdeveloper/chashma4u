<?php
 /**
  * Auth Controllers
  */
 class Auth extends CI_Controller
 {
 	
 	public $outputdata 	= array();
 	function __construct(){
		parent::__construct();
		$this->load->library('email');
		$this->load->helper('file');
	}

 	public function index($role = 'admin')
 	{
 		
		if(isset($_POST['txtEmail']) && $_POST['txtEmail']!="") {
			// Check user login 
            $dbresult	=	$this->checkLogin($_POST);
            $role = ($this->session->userdata(PREFIX.'sessDashboard'))?$this->session->userdata(PREFIX.'sessDashboard'):$role;
			if($dbresult['flag'] == 2){
				/* Set cookie for 'Remember Me' */
				$cookieName = 'cookieCHASHMA4UDashboard';
			
				if(isset($_POST['chkRemember'])) {
					$year = time() + 31536000;
					setcookie($cookieName, $_POST['txtEmail'], $year);
				}
				else if(isset($_POST['chkRemember']) && ! $_POST['chkRemember']) {
					if(isset($_COOKIE[$cookieName])) {
						$past = time() - 100;
						setcookie($cookieName, $_POST['txtEmail'], $past);
					}
				}

				$this->common_lib->setSessionVariables();

				redirect(DASHURL."/".$role."/welcome");
				
				
				
            }else if($dbresult['flag'] == 3){
			
				$this->common_lib->setSessMsg("Your Account currenctly DeActive. Please contact with admin.", 2);
                	redirect(DASHURL."/login");
            }else if($dbresult['flag'] == 4){
			
				$this->common_lib->setSessMsg("Something is wrong with your account. Please contact with admin.", 2);
                	redirect(DASHURL."/login");
            }
            else {
            	$this->common_lib->setSessMsg("Incorrect login details", 2);
                	redirect(DASHURL."/login");
            }
        }
 		$this->load->viewD('login_view',$this->outputdata);
 	}

 	// Check login is successful
	function checkLogin($data) {
		$resultarr['flag']	=	1;
		if(isset($data['txtEmail']) && $data['txtEmail']!=''){
			$email		=	trim($data['txtEmail']);
			$pass		=	trim($data['txtPassword']);
			$cond		=	array('email' => $email, 'password' => md5($pass));
			$row		=	$this->Common_model->selRowData(tablePrefix."auths", '' ,$cond);
			if($row){
				if($row->status == 0) { //User is activated
					$sessDashboard = $row->role;
					$sessDashboardId = $row->roleId;
					$sessEmployeeRole = $sessEmployeeRoleId = $sessPermissions =  $sessEmployeeAddedBy = '';
					$sessEmployeeAddedById = 0;

					if ($row->role == 'admin') {
						$row->username = 'Admin';
						$resultarr['flag']	=	2;
							
						
					}else if ($row->role == 'vendor') {
						$vendorData	=	$this->Common_model->exequery("SELECT *  from ".tablePrefix."vendor WHERE vendorId ='".$row->roleId."'",1);
						
						if(!empty($vendorData)){
							if($vendorData->status == 0){
								$row->username = $vendorData->vendorName;
								$resultarr['flag']	=	2;
							}else
								return $resultarr['flag']	=	3;
						}else
							return $resultarr['flag']	=	4;
						
					}else if ($row->role == 'employee') {
						$employeeData	=	$this->Common_model->exequery("SELECT em.*, rl.role, rl.addedBy, rl.addedById, rl.permissions  from ".tablePrefix."employee as em left join ch_role as rl on rl.roleId = em.roleId where em.employeeId ='".$row->roleId."'",1);
						
						if(!empty($employeeData)){

							if($employeeData->status == 0){
								$sessDashboard = strtolower($employeeData->addedBy);
								$sessDashboardId = $employeeData->vendorId;
								$row->role = $employeeData->role;
								$row->username = $employeeData->employeeName;
								
								$sessEmployeeAddedById = $employeeData->addedById;
								$sessEmployeeAddedBy = $employeeData->addedBy;
								$sessEmployeeRoleId = $employeeData->roleId;
								$sessPermissions = $employeeData->permissions;
								$resultarr['flag']	=	2;
							}else
								return $resultarr['flag']	=	3;
						}else
							return $resultarr['flag']	=	4;
						
					}
					if($resultarr['flag'] == 2){
		
						$this->session->set_userdata(PREFIX.'sessDashboard', $sessDashboard );
						$this->session->set_userdata(PREFIX.'sessDashboardId', $sessDashboardId );
						$this->session->set_userdata(PREFIX.'sessAuthId', $row->authId);
						$this->session->set_userdata(PREFIX.'sessEmail', $row->email);
						$this->session->set_userdata(PREFIX.'sessUserName', $row->username);
						$this->session->set_userdata(PREFIX.'sessRoleId', $row->roleId);
						$this->session->set_userdata(PREFIX.'sessRole', $row->role);
						$this->session->set_userdata(PREFIX.'sessLang', 'english');
						$this->session->set_userdata(PREFIX.'sessEmployeeRole', $sessEmployeeRole);
						$this->session->set_userdata(PREFIX.'sessEmployeeRoleId', $sessEmployeeRoleId);
						$this->session->set_userdata(PREFIX.'sessEmployeeAddedBy', $sessEmployeeAddedBy);
						$this->session->set_userdata(PREFIX.'sessEmployeeAddedById', $sessEmployeeAddedById);
						$this->session->set_userdata(PREFIX.'sessPermissions', ($sessPermissions)?array_keys(unserialize($sessPermissions)):array());
						$resultarr['flag']	=	2;
						$this->Common_model->update(tablePrefix."auths", array("lastAccessIp" => $_SERVER['REMOTE_ADDR'] ) , " authId = ".$row->authId);
						// $this->Common_model->insert(tablePrefix."ipaddress", array("role" => $row->role, "roleId" => $row->roleId, "lastAccessIp" => $_SERVER['REMOTE_ADDR'], "addedOn" => date('Y-m-d H:i:s')));

						return $resultarr;
					}
				}
				else if($row->status == 1)
					$resultarr['flag']	=	3;
			}
			
		}
		//Email is not registered with us
		$this->session->unset_userdata(PREFIX.'sessRole');
		$this->session->unset_userdata(PREFIX.'sessDashboard');
		$this->session->unset_userdata(PREFIX.'sessDashboardId');
		$this->session->unset_userdata(PREFIX.'sessAuthId');
		$this->session->unset_userdata(PREFIX.'sessEmail');
		$this->session->unset_userdata(PREFIX.'sessRoleId');
		$this->session->unset_userdata(PREFIX.'sessLang');
		$this->session->unset_userdata(PREFIX.'sessUserName');
		$this->session->unset_userdata(PREFIX.'sessEmployeeRole');
		$this->session->unset_userdata(PREFIX.'sessEmployeeRoleId');
		$this->session->unset_userdata(PREFIX.'sessPermissions');	
		$this->session->unset_userdata(PREFIX.'sessEmployeeAddedBy');
		$this->session->unset_userdata(PREFIX.'sessEmployeeAddedById');
		return $resultarr;
	}

	function logout() {
		if($this->session->userdata(PREFIX.'sessAuthId') > 0) {
			$this->session->unset_userdata(PREFIX.'sessRole');
			$this->session->unset_userdata(PREFIX.'sessDashboard');
			$this->session->unset_userdata(PREFIX.'sessDashboardId');
			$this->session->unset_userdata(PREFIX.'sessAuthId');
			$this->session->unset_userdata(PREFIX.'sessEmail');
			$this->session->unset_userdata(PREFIX.'sessRoleId');
			$this->session->unset_userdata(PREFIX.'sessLang');
			$this->session->unset_userdata(PREFIX.'sessUserName');
			$this->session->unset_userdata(PREFIX.'sessEmployeeRole');
			$this->session->unset_userdata(PREFIX.'sessEmployeeRoleId');
			$this->session->unset_userdata(PREFIX.'sessPermissions');	
			$this->session->unset_userdata(PREFIX.'sessEmployeeAddedBy');
			$this->session->unset_userdata(PREFIX.'sessEmployeeAddedById');		
			redirect(DASHURL."/auth");
		} 
	}
   
 }
?>
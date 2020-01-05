<?php
 /**
  * Zone Controllers
  */
 class Zone extends CI_Controller
 {
 	
	public $menu		= 2;
	public $subMenu		= 21;
 	public $outputdata 	= array();
 	function __construct(){
		parent::__construct();
		$this->session->set_userdata(PREFIX.'sessDashboard', "admin");
		$this->common_lib->setSessionVariables();
	}

 	public function index()
 	{	

		$this->menu		=	2;
		$this->subMenu	=	21;

 		$this->common_lib->checkRolePermission(['can_manage_all_zone','can_view_zone']);
 		/************************* Custom CSS Or header Element *******************************/
 		$this->outputdata['headScript'] = '<link rel="stylesheet" href="'.base_url().'system/static/dashboard/admin/css/bootstrap.css"><link rel="stylesheet" href="'.base_url().'system/static/dashboard/admin/css/bootstrap-datetimepicker.css">';

 		/************************* Custom JS Or Footer Element *********************************/
 		$this->outputdata['footerScript'] = '<script type="text/javascript" src="'.DASHSTATIC.'/admin/js/plugins/moment-with-locales.js"></script><script type="text/javascript" src="'.DASHSTATIC.'/admin/js/plugins/bootstrap-datetimepicker.js"></script><script type="text/javascript">$(document).ready(function(){ $(".timePicker").datetimepicker({
		        format: "LT"
		    }); });</script>';
 		$this->load->viewD('admin/addzone_view',$this->outputdata);
 	}
 	public function zonejson(){
 		$zoneList = $this->Common_model->exequery("SELECT zoneId as value, zoneName as `text`, 'Asia' as continent FROM ".tablePrefix."zone WHERE status !='2' order by zoneName asc");
 		echo ($zoneList) ? json_encode($zoneList) : json_encode(array());
 	}
 	public function pincodejson(){
 		$pincodeList = $this->Common_model->exequery("SELECT pincodeId as value, pincode as `text` FROM ".tablePrefix."pincode WHERE status !='2' order by pincode asc");
 		echo ($pincodeList) ? json_encode($pincodeList) : json_encode(array());
 	}
 	public function addpincode($pincodeId = '')
 	{
		$this->menu		=	2;
		$this->subMenu	=	23;
 		$this->common_lib->checkRolePermission(['can_manage_all_pincode',($pincodeId)?'can_edit_pincode':'can_create_pincode']);
 		$countDelivery = 0;
 		$countTimeSlots = 0;
 		$zoneId = 0;
 		if( $pincodeId > 0 ) {
 			$getPincodeDetails = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."pincode WHERE status != 2 AND pincodeId = ".$pincodeId, true);
 			if( $getPincodeDetails ) {
 				$zoneId = $getPincodeDetails->zoneId;
 				$deliveryType = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."delivery_service WHERE status != 2 AND pincodeId = ".$pincodeId);
 				$this->outputdata['getPincodeDetails'] = $getPincodeDetails;
 				if( $deliveryType ) { 					
 					$deliverySectionHtml = '';
 					foreach( $deliveryType 	as $key => $deliveryData ) {
 						$deliverySectionHtml .= '<div class="deliverySection" data-counter="'.$countDelivery.'">
					                                <div class="form-group col-md-6">
					                                  <label for="deliveryType">Delivery Type</label>
					                                  <input type="text" class="form-control" id="deliveryType" placeholder="Delivery Type" name="deliveryType['.$countDelivery.']" value="'.$deliveryData->deliveryType.'" required>
					                                </div>
					                                <div class="form-group col-md-6">
					                                  <label for="deliveryAmount">Delivery Amount</label>
					                                  <input type="text" class="form-control" id="deliveryAmount" placeholder="Delivery Amount" name="deliveryAmount['.$countDelivery.']" value="'.$deliveryData->deliveryAmount.'" required>
					                                  <input type="hidden" class="form-control"  name="deliveryId['.$countDelivery.']" value="'.$deliveryData->deliveryTimeSlotId.'">
					                                </div>  
					                                <div class="col-md-12 timeslotsSection">';
					    $deliveryTimeSlotsHtml = '';

					    $deliveryTimeSlots = $this->Common_model->exequery("SELECT * FROM ".tablePrefix."delivery_time_slots WHERE status != 2 AND deliveryId = ".$deliveryData->deliveryTimeSlotId);

					    if($deliveryTimeSlots) {
					    	foreach ($deliveryTimeSlots as $keyItem => $deliveryTimeSlotsData) {
					    		$deliveryTimeSlotsHtml .= '<div class="slotsItems">
						                                    <div class="form-group col-md-3">
						                                      <label for="startTime">Start Time</label>
						                                      <input type="text" class="form-control timePicker"  placeholder="Start Time" name="startTime['.$countDelivery.']['.$countTimeSlots.']" value="'.date('H:i A',strtotime($deliveryTimeSlotsData->startTime)).'" required>
						                                    </div>
						                                    <div class="form-group col-md-3">    
						                                      <label for="endTime">End Time</label>
						                                      <input type="text" class="form-control timePicker" name="endTime['.$countDelivery.']['.$countTimeSlots.']" value="'.date('H:i A',strtotime($deliveryTimeSlotsData->endTime)).'" placeholder="End Time" required>                                      
						                                    </div>
						                                    <div class="form-group col-md-4">
						                                      <label for="numberOfDelivery">Number of Delivery</label>
						                                      <input type="text" class="form-control" placeholder="Number of Delivery" name="numberOfDelivery['.$countDelivery.']['.$countTimeSlots.']" onkeydown="OnlyNumericKey(event)" value="'.$deliveryTimeSlotsData->numberofDelivery.'" required>
						                                      <input type="hidden" class="form-control"  name="timeslotId['.$countDelivery.']['.$countTimeSlots.']" value="'.$deliveryTimeSlotsData->timeslotId.'">
						                                    </div>
						                                    <div class="form-group col-md-2"><button class="btn btn-icons btn-rounded btn-light removeSlotsItem" title="Remove" type="button"><i class="fa fa-times"></i></button></div><div class="clearfix"></div>
						                                  </div>';
						                                $countTimeSlots++;
					    	}
					    }                            

                        $deliverySectionHtml .= $deliveryTimeSlotsHtml.'<button type="button" class="btn btn-success addMoreSlots"><i class="fa fa-plus"></i> Add More</button></div><button type="button" class="btn btn-success removeDeliverySection"><i class="fa fa-times"></i> Remove</button></div>';
 						$countDelivery++;
 					}
 					$this->outputdata['deliverySectionHtml'] = $deliverySectionHtml;
 				}
 			}
 			else
 				redirect(DASHURL."/admin/zone/list");
 		}
 		$this->outputdata['countDelivery'] = $countDelivery;
 		$this->outputdata['countTimeSlots'] = $countTimeSlots;
 		$this->outputdata['zoneDropDown'] = $this->common_lib->getDropDown("SELECT zoneId as id, zoneName as name FROM ".tablePrefix."zone WHERE status !='2' order by zoneName asc", $zoneId);
 		/************************* Custom CSS Or header Element *******************************/
 		$this->outputdata['headScript'] = '<link rel="stylesheet" href="'.base_url().'system/static/dashboard/admin/css/bootstrap.css"><link rel="stylesheet" href="'.base_url().'system/static/dashboard/admin/css/bootstrap-datetimepicker.css">';

 		/************************* Custom JS Or Footer Element *********************************/
 		$this->outputdata['footerScript'] = '<script type="text/javascript" src="'.DASHSTATIC.'/admin/js/plugins/moment-with-locales.js"></script><script type="text/javascript" src="'.DASHSTATIC.'/admin/js/plugins/bootstrap-datetimepicker.js"></script><script type="text/javascript">$(document).ready(function(){ $(".timePicker").datetimepicker({
		        format: "LT"
		    }); });</script>';
 		$this->load->viewD('admin/add_pincode_view',$this->outputdata);
 	}
   	
   	public function pincode()
 	{
		$this->menu		=	2;
		$this->subMenu	=	22;
 		$this->common_lib->checkRolePermission(['can_manage_all_pincode','can_view_pincode']);
 		$this->load->viewD('admin/pincode_list_view',$this->outputdata);
 	}
 }
?>
<?php
 /**
  * Dashboard Controllers
  */
 class Welcome extends CI_Controller
 {
 	
	public $menu		= 1;
	public $subMenu		= 11;
 	public $outputdata 	= array();
 	function __construct(){
		parent::__construct();
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
		$this->session->set_userdata(PREFIX.'sessDashboard', "admin");
		$this->common_lib->setSessionVariables();
	}

 	public function index(){
		
		$query	=	"SELECT count(*) as totalOrder,
		(SELECT Sum(paidAmt) FROM ch_order_transaction where paymentStatus = '1' and (SELECT status FROM ch_order where ch_order.orderId = ch_order_transaction.orderId limit 0, 1) = 5  AND date(addedOn) = date(now())) as totalRevenue,
		(SELECT count(*) FROM ch_order where status = 5  AND date(addedOn) = date(now()) ) as totalSuccess,
		(SELECT count(*) FROM ch_order where status > 5  AND date(addedOn) = date(now()) ) as totalFailed
		from ch_order where orderId > 0  AND date(addedOn) = date(now())";


		$this->outputdata['filterData'] =	$this->Common_model->exequery($query,1);


		$query	=	"SELECT count(*) as totalOrders,
		(SELECT Sum(grandTotal) FROM ch_order where status = '4') as totalOrderRevenue,
		(SELECT count(*) FROM ch_vendor WHERE status !=2 ) as totalVendors,
		(SELECT count(*) FROM ch_employee WHERE status !=2 ) as totalEmployees,
		(SELECT SUM(`grandTotal`) FROM ch_order where YEAR(`addedOn`) = YEAR(NOW())) as currentYearOrderRevenue,
		(SELECT SUM(`grandTotal`) FROM ch_order WHERE YEAR(`addedOn`) = YEAR(NOW()) -1) as LastYearOrderRevenue
		from ch_order";

		$this->outputdata['statisticsData'] =	'';//$this->Common_model->exequery($query,1);
		$this->outputdata['chartData']['2018'] = array('totalDelivered'=>0, 'totalCanceled'=>0);
		$yrs = $this->Common_model->exequery("SELECT DISTINCT YEAR(addedOn) as year FROM ch_order");
		if (!empty($yrs)) {
			foreach ($yrs as $y) {
				$cData = $this->Common_model->exequery("SELECT count(*) as totalDelivered,
					(SELECT count(*) from ch_order WHERE status = 5 AND YEAR(`addedOn`) = $y->year) as totalCanceled
					from ch_order WHERE status = 4 AND YEAR(`addedOn`) = $y->year",1);
				if(!empty($cData))
					$this->outputdata['chartData'][$y->year] = $cData;
			}
		}
		if (!isset($this->outputdata['chartData']['2020']) || empty($this->outputdata['chartData']['2020']))
			$this->outputdata['chartData']['2020'] = array('totalDelivered'=>0, 'totalCanceled'=>0);
		

 		$this->load->viewD('admin/dashboard_view',$this->outputdata);
 	}

 	public function cropimg(){
		$queryData = $this->Common_model->exequery("SELECT * from ch_images where status != 2");
		if ($queryData) {
			echo "got data";
			foreach ($queryData as $image) {
			echo "started-";
				if ($image->imageName) {
			echo "Not empty-";
					$thumbPath = UPLOADDIR.'/images/'.$image->imageName;
			    	$createThumb = array(
			    		
			    		array('w'=>350, 'h'=>220)
			    	);

					if(file_exists($thumbPath)) {
						echo "path exist-";
						foreach ($createThumb as $thumb) {
							$newPath = UPLOADDIR.'/images/' .  $thumb['w'].'_'.$thumb['h'].'/';
							echo "thumb started-".$newPath.$image->imageName.'**';
							if(!file_exists($newPath.$image->imageName)) {
								if(!is_dir($newPath)) mkdir($newPath, 0777, TRUE);
								$uploadSettings['upload_path'] = $newPath;	
								$uploadSettings['thumbPath'] = $thumbPath;	
								$uploadSettings['thumbWidth'] = $thumb['w'];	
								$uploadSettings['thumbHeight'] = $thumb['h'];					
								$sts = $this->common_lib->_createThumbnail($uploadSettings);
								if ($sts)
									echo "status--1<br>";
								else
									echo "status--2<br>";
							}else
									echo "Already Exit;<br>";
							
						}
					}else
						echo $thumbPath."--path not exist";
				}
			echo "<br>";
			}

			echo "<br>";
		}
		echo "*******************Happy Ending****************************";
 	}

 	function neworder(){
 		$res = $this->common_lib->sendOrderPlacedNotifications('order_success', 'OD3547157751607315');
 		print_r($res);
 	}




   
 }
?>
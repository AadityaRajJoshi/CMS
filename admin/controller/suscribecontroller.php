<?php 
require_once __dir__.'/../model/model.php';
$suscriber = new model;
require 'setting.php';
global $site_url;

/**
 * 
 */
class suscribeController extends model
{
	
	public function insertSuscriber(){
		$data = array(
			'Email' => $_POST['email'],
			'Date' => date("Y/m/d")
		);
		$this-> Insert('suscriber', $data);
		header('location:'. $site_url.'sucess');
	}

	public function selectSuscriber(){
		$data = array(
			'*'
		);
		$suscriber = $this-> select('suscriber', $data);
		$fetch_suscriber = $this->fetch($suscriber);
		return $fetch_suscriber;
	}

	public function deleteSuscriber(){
		$id = $_POST['delete'];
		$condition = array(
			'id' => $id
		);
		$this-> delete('suscriber', $condition);
		header('location:'. $site_url.'suscriber');
	}

	public function exportToExcel(){
		//echo "hello"; die;
		$data = array(
			'*'
		);
		$suscriber = $this-> select('suscriber', $data);
		$suscriber_fetch = $this->fetch($suscriber);
		// var_dump($suscriber_fetch);
		// die;
		 header("Content-Type: text/plain");
		 ob_clean();
		 $filename = "sucriber_list" . date('Ymd') . ".xls";

  		header("Content-Disposition: attachment; filename=\"$filename\"");
  		header("Content-Type: application/vnd.ms-excel");
		  $flag = false;
		  foreach($suscriber_fetch as $row) {

		    if(!$flag) {
		      // display field/column names as first row
		      echo implode("\t", array_keys($row)) . "\r\n";
		      $flag = true;
		    }
		    $this -> cleanData($row, __NAMESPACE__); 
		    echo implode("\t", array_values($row)) . "\r\n";
		  }
		  exit;
	}

	public function cleanData($data){
		$str = preg_replace("/\t/", "\\t", $data);
   		$str = implode(preg_replace("/\r?\n/", "\\n", $data));
   		//var_dump($str);die;
   		if(strstr($str, '""')){
   		 $str = '"' . str_replace('"', '""', $str) . '"';
   		}
   		
	}
}
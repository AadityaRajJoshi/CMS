<?php 
require_once __dir__.'/../model/model.php';
$quotecontroller = new model;


class ajaxData extends model{

	public function state(){
		var_dump($_POST);
			$country_id = $_POST['country_id'];

			$data = array('*');
			$condition = array(
				'country_id' => $country_id,
			);
			$query = $this->select('tbl_province', $data, $condition);
			
			$rowCount = $query->num_rows;
			//var_dump($rowCount);die;
			if($rowCount > 0){
				echo '<option value = "">select state</option>';
				while($row = $query->fetch_assoc()){
					echo '<option value = "'.$row['id'].'">'.$row['name'].'</option>';
				}
			}else{
				echo '<option value = "">no district found</option>';
			}

		

		
        }
    }
    $state = new ajaxData;
    $state->state();
   

		
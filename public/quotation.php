
<?php 
	include('header.php');
	include('../admin/controller/quotecontroller.php');
	

	$quote = new quote;
	$fetch_country = $quote -> selectCountry();

	if(isset($_POST['submit'])){
    $quote->quoteMail();
}

	//$fetch_state = $quote -> selectState();

?>

	<div class="container">
	<form method="POST" enctype="multipart/form-data" class="mt-5 border p-4 bg-light rounded">

  	<div class="form-group">
    	<label for="exampleInputEmail1">First Name</label>
    	<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter first Name" name="firstname" required>
  	</div>

  	
  	<div class="form-group">
    	<label for="exampleInputEmail1">Last Name</label>
    	<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter last name" name="lastname" required>
  	</div>

  	<div class="form-group">
    	<label for="exampleInputEmail1">Phone number</label>
    	<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter phone number" name="phoneno" required>
  	</div>

  	<div class="form-group">
    	<label for="exampleInputEmail1">email</label>
    	<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter valid email" name="email">
    	
  	</div>

  	<div class="form-group">
    	<label for="exampleInputEmail1">Permanant Address</label>
    	<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter permanant address" name="paddress">
  	</div>
  	

  	<div class="form-group">
    	<label for="exampleInputEmail1">Temporary Address</label>
    	<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter permanant address" name="taddress">
  	</div>

  	<div class="form-group">
      <label for="sel1">country</label>
      <select class="form-control" id="country" name="country">
        <option></option>
        <?php foreach ($fetch_country as $key => $value) {
        	echo '<option value=" '.$value['id'].' "> '. $value['name'] .'</option>';
        } ?>
      </select>
     </div>

     <div class="form-group">
      <label for="sel1">province/state</label>
      <select class="form-control" id="state" name="state">
        <option></option>        
      </select>
     </div>

     <div class="form-group">
    	<label for="exampleInputEmail1">City</label>
    	<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter city" name="city">
  	</div>

  	<div class="form-group">
    	<label for="exampleInputEmail1">Postal Code</label>
    	<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter postal code"  name="pcode">
  	</div>

  	<div class="form-group"><label for="start">Date Response:</label>
		<input type="date" id="start" name="date"
       value="2019-07-22"
       min="2019-01-01" max="2019-12-31">
  	</div>

  	<div class="form-group">
        <label for="contact"> Contact me via</label><br>
          <input type="checkbox" name="contact" value="email"> Email<br>
          <input type="checkbox" name="contact" value="phone"> Phone<br>
          <input type="checkbox" name="contact" value="post"> Post<br><br>
       </div>

	 <div class="form-group">
          <label for="gender"> Gender</label><br>
          <input type="radio" name="gender" value="male"> Male<br>
          <input type="radio" name="gender" value="female"> Female<br>
          <input type="radio" name="gender" value="other"> other<br>
       </div>

		 <div class="form-group">
         <label for="service"> Services Interested</label>
         <select name="service[]" id="service" class="form-control" multiple>
            <option value="web">Web Development</option>
            <option value="db">Database</option>
            <option value="android">Android App</option>
            <option value="python">python</option>
          </select>
       </div>

       <p class="robotic" id="pot">
      <label>If you're human leave this blank:</label>
      <input name="robotest" type="text" id="robotest" class="robotest" />
    </p>

		<div>
			<label>Notes</label><br>
			<textarea name="note" rows="5" cols="40"></textarea>
		</div>
		<div class="form-group">
          <button class="btn btn-success btn pull-right btn-lg" name="submit">Submit</button>
      </div>
	</form>

<script type="text/javascript"> 
	$(document).ready(function(){
		$("#country").on('change', function(){
			var country_id = $(this).val();
			//alert(country_id);
			if(country_id){
				$.ajax({
					type:'POST',
					url: 'http://localhost/cms/admin/controller/ajaxData.php',
					data: 'country_id='+ country_id,
					success: function(html){
						$("#state").html(html);
					}
				});
			}
		});
	});
  
</script>
<?php include('footer.php'); ?>

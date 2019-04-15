<?php include('header.php');
include('../controller/admincontroller.php');
 $admin = new Admin ;
 
 if(isset($_POST['Update'])){
 	$admin -> Password();
 }
?>
<div class="container">
    <form method="POST" class="mt-5 border p-4 bg-light rounded">
    <table>
    <td>Enter your Email</td>
    <td><input type="text"  name="email" class="form-control" required></td>
    <tr>
    <td>Enter your existing password:</td>
    <td><input type="password"  name="password" class="form-control"></td>
    </tr>
  <tr>
    <td>Enter your new password:</td>
    <td><input type="password"  name="newpassword" class="form-control"></td>
    </tr>
    <tr>
   <td>Re-enter your new password:</td>
   <td><input type="password"  name="confirmnewpassword" class="form-control"></td>
    </tr>
    </table>
    <p><input type="submit" name="Update" value="update" class="btn btn-success">
    </form>
    </p>
</div>
<?php include('footer.php');
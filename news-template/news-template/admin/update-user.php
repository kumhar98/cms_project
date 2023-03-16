<?php 
include "header.php"; 
include "config.php";
session_start();
if ($_SESSION["role"]==0) {
    header ("location:{$hostname}/admin/post.php");
  }
 $id =  $_GET["id"];

 $sql = "SELECT * FROM USER WHERE user_id = $id";
 $result = mysqli_query($conn,$sql);
 $value = mysqli_num_rows ( $result);

 if (isset($_POST['submit'])) {
    $fname = mysqli_real_escape_string ($conn,$_POST['f_name']) ; 
    $lname = mysqli_real_escape_string ($conn , $_POST['l_name']) ; 
    $username = mysqli_real_escape_string ($conn, $_POST['username']) ; 
    $role = mysqli_real_escape_string ($conn,$_POST['role']) ; 
    $user_id = mysqli_real_escape_string ($conn,$_POST['user_id']) ;
    

      $update = "UPDATE user 
      SET  user_name =   '{$username}' , first_name = '{$fname}', last_name =   '{$lname}' , role =   '{$role}' WHERE user_id = {$user_id }"; 
      if (mysqli_query($conn, $update)  ) {
          header ("location:{$hostname}/admin/users.php");
      }
  }


  
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <?php 
                    if ($value > 0 ) {
                       while ($row = mysqli_fetch_assoc($result)) {
                    
                       
                  ?>
                  <form  action=" " method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $row['user_id'] ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['user_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">

                           <?php 
                             if ($row['role'] == 0 ) {
                               echo ' <option value="0" selected >normal User</option>
                                       <option value="1">Admin</option>';
                             }else{
                                echo ' <option value="0"  >normal User</option>
                                <option value="1" selected>Admin</option>';
                             }
                           ?>
                             
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php } } ?>
                  <!-- /Form -->


                  <?php 
         
                  
                  ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>

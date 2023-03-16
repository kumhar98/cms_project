<?php include "header.php";
include "config.php";
if ($_SESSION["role"]==0) {
    header ("location:{$hostname}/admin/post.php");
  } 
  $id = $_GET['id'];
  if (isset($_POST['sumbit'])) {
    $cat = mysqli_real_escape_string($conn,$_POST["cat_name"]); 
    echo $sqli = "UPDATE category 
    SET  category_name =   '{$cat}' WHERE category_id = {$id}"; 
     if (mysqli_query($conn,$sqli)) {
       header ("location:{$hostname}/admin/category.php");
       
     }
  }
 $sql = "SELECT category_name,category_id FROM category WHERE  category_id = $id";
 $result = mysqli_query($conn, $sql);
 if ( mysqli_num_rows( $result)>0) {
   $row =  mysqli_fetch_assoc( $result);
 }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <form action="" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row['category_id'] ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name'] ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>

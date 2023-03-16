<?php include "header.php";
include "config.php";
if ($_SESSION["role"]==0) {
    $id2 = $_GET["id"];
    $sql2 = "SELECT author FROM post WHERE $id = post_id";
   $resilt2 = mysqli_query($conn,$sql);
      $row2 = mysqli_fetch_assoc($resilt);
      if ( $row2['author'] != $_SESSION["role"] ) {
        header ("location:{$hostname}/admin/post.php");
      }
  } 
  if (isset($_GET['id'])) {
    $id = $_GET["id"];
     $sql = "SELECT * FROM post WHERE $id = post_id";
    $resilt = mysqli_query($conn,$sql);
    if ( mysqli_num_rows( $resilt)>0) {
       $row1 = mysqli_fetch_assoc($resilt);
    } 
  }
if (isset($_POST['submit'])) {
  if (empty($_FILES["new-image"]['name'])){
       $fine_name = $_POST['old-image'];
  }else {
    $errors = [];
       $fine_name = $_FILES['new-image']['name'];
      $size = $_FILES['new-image']['size'];
      $tmp_name = $_FILES['new-image']['tmp_name'];
      $type = $_FILES['new-image']['type'];
      $file_exp = strtolower(end(explode('.',$_FILES['new-image']['name'])));
      $type = ["png","jpg","jepg"];
      if ( in_array($file_exp, $type ) === false) {
          $errors[]= "please choose a JPEG or PNG file.";
      
      }
      if ($size > 2097152) {
          $errors[] = "File size must be excately 2 MB";
      }
      $image_upload = time()."-".basename($fine_name);
      if ( empty($errors) === true) {
        move_uploaded_file($tmp_name,"upload/".$image_upload);
      }else{
          print_r($errors);
      }
   }
  

 
    $post_title = mysqli_real_escape_string ($conn,$_POST['post_title']) ; 
    $postdesc = mysqli_real_escape_string ($conn , $_POST['postdesc']) ; 
    $category = mysqli_real_escape_string ($conn, $_POST['category']) ; 
   
    

      $update = "UPDATE post 
      SET  title =   '{$post_title}' , description = '{$postdesc}', category =   {$category} , Post_img =   '{$image_upload}' WHERE post_id = {$id};";
      if ($category != $row1['category']) {
        $update.="UPDATE category SET post = post-1  WHERE category_id = {$row1['category']};";
        $update.="UPDATE category SET post = post+1  WHERE category_id = $category";
      }
      if(mysqli_multi_query($conn, $update)) {
          header ("location:{$hostname}/admin/post.php");
      }
  }

?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
        <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $row1['post_id'] ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row1['title'] ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
               <?php echo $row1['post_id']; ?>
                </textarea>
            </div>
            <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                          <select name="category" class="form-control">
                              <option  disabled> Select Category</option>
                            <?php 
                              $sql_category = "SELECT * FROM category";
                              $result = mysqli_query($conn,$sql_category);
                              if (mysqli_num_rows($result) > 0) {
                                while ($row=mysqli_fetch_assoc($result)) {
                                    if ($row['category_id'] == $row1['category']) {
                                        $active = "selected";
                                    }else {
                                        $active = " ";
                                    }
                                    echo "<option  value= '{$row['category_id']}' $active > {$row['category_name']}</option>";
                                }
                                
                              }

                            ?>
                          </select>
                      </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                 <img  src="upload/<?php echo $row1['Post_img'] ?>" height="150px"> 
                <input type="hidden" name="old-image" value="<?php echo $row1['Post_img'] ?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>

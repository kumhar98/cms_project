<?php 
include "header.php";
include "config.php";
if ($_SESSION["role"]==0) {
    header ("location:{$hostname}/admin/post.php");
  } 
if (isset($_POST["submit"])) {
    if (isset($_FILES["fileToUpload"])) {
        $errows=[];
        $file_name = $_FILES["fileToUpload"]["name"];
        $file_size = $_FILES["fileToUpload"]["size"];
        $tmp_name = $_FILES["fileToUpload"]["tmp_name"];
        $file_type = $_FILES["fileToUpload"]["type"];
        $file_ext = strtolower(end(explode('.',$file_name )));
        $file_ext1 = [
           "jpg","png","jpeg"
        ];

        if (in_array( $file_ext,$file_ext1) === false ) {
           $errows[]=  "This extension file not allowed ,please choose a PNG and JPG";
        }
        if ($file_size > 2097152) {
            $errows[] = "File Size must  be 2mb not lower";
        }
        if (empty($errows === true)) {
           move_uploaded_file($tmp_name,"upload/".$file_name );
        }else{
            print_r($errows);
        }

    }
   $post_title = mysqli_real_escape_string($conn,$_POST["post_title"]); 
   $postdesc = mysqli_real_escape_string($conn,$_POST["postdesc"]);
   $Category = mysqli_real_escape_string($conn,$_POST["category"]);
  $date = date("d M,y");
   $author = $_SESSION["user_id"];
   $sqli = "INSERT INTO post (title,description,category,Post_date,author,Post_img)
   VALUES('{$post_title}','{$postdesc}','{$Category}','{$date}','{$author}','{$file_name}');";
   $sqli .="UPDATE category SET post = post+1 WHERE category_id = $Category";
   if (mysqli_multi_query($conn,$sqli)) {
     header ("location:{$hostname}/admin/post.php");
   }
}


?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Add New Post</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form -->
                  <form  action="" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Title</label>
                          <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group"> 
                          <label for="exampleInputPassword1"> Description</label>
                          <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
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
                                    echo "<option  value= '{$row['category_id']}'> {$row['category_name']}</option>";
                                }
                                
                              }

                            ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="fileToUpload" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>

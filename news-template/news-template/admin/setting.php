<?php
 include "header.php";
 include "config.php";
 $sql = "SELECT * FROM setting";
 $result = mysqli_query($conn,$sql);
 $row = mysqli_fetch_assoc( $result);
 if (isset($_POST["submit"])) {
    if (empty($_FILES["Website_logo"]['name'])){
        $fine_name = $_POST['old-image'];
   }else {
     $errors = [];
        $fine_name = $_FILES['Website_logo']['name'];
       $size = $_FILES['Website_logo']['size'];
       $tmp_name = $_FILES['Website_logo']['tmp_name'];
       $type = $_FILES['Website_logo']['type'];
       $file_exp = strtolower(end(explode('.',$_FILES['Website_logo']['name'])));
       $type = ["png","jpg","jepg"];
       if ( in_array($file_exp, $type ) === false) {
           $errors[]= "please choose a JPEG or PNG file.";
       
    }
    if ($size > 2097152) {
       $errors[] = "File size must be excately 2 MB";
    }
    if ( empty($errors) === true) {
     move_uploaded_file($tmp_name,"upload/".$fine_name);
    }else{
       print_r($errors);
    }
}
    echo $sql_update = "UPDATE setting SET websiteName = '{$_POST['Website_name']} ', logo ='{$fine_name}',description = '{$_POST['footerdesc']}'";
     $result = mysqli_query($conn, $sql_update);
 }else {
    // header ("location:{$hostname}/admin/post.php");
 }
?>
<div class="row"style = "margin:0;">
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
        <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <label for="exampleInputTile">Website name</label>
                <input type="text" name="Website_name"  class="form-control" id="exampleInputUsername" value = "<?php echo $row['websiteName'] ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Website logo</label>
                <input type="hidden" name="Website_logo"  id="exampleInputUsername" value = "<?php echo $row['logo'] ?>">
                <input type="file" name="Website_logo">
                <img src="upload/<?php echo $row['logo'] ?>" alt="" style="width:20%;margin-top:10px;">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="footerdesc" class="form-control"  required rows="5" value = "<?php echo $row['description'] ?>">
                <?php echo $row['description'] ?>
                </textarea>
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Save" />
        </form>
        <!-- Form End -->
    </div>
</div>
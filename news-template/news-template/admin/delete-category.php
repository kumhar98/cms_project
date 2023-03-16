<?php
include "config.php";
if ($_SESSION["role"]==0) {
    header ("location:{$hostname}/admin/post.php");
  } 

  $id=$_GET['id'];
  $sli = "DELETE FROM category WHERE category_id =  $id";
  if (mysqli_query($conn, $sli )) {
    header ("location:{$hostname}/admin/category.php");
  }
  ?>
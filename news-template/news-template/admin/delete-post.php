<?php 
include "config.php";
if ($_SESSION["role"]==0) {
    header ("location:{$hostname}/admin/post.php");
  } 
if ($_GET['id']) {
    $id = $_GET['id'];
   $catid = $_GET['catid'];
   $sql ="DELETE FROM post WHERE post_id ={$id};";
   $sql.="UPDATE category SET post = post-1 WHERE category_id = {$catid}";

   if(mysqli_multi_query($conn, $sql)){
    header ("location:{$hostname}/admin/post.php");
   }


} 

?>
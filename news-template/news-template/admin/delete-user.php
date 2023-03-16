<?php 
 include "config.php";
 if ($_SESSION["role"]==0) {
  header ("location:{$hostname}/admin/post.php");
}
  $id = $_GET[id];
  $Delete = "DELETE FROM USER WHERE user_id = $id  ";

  $sql = mysqli_query($conn, $Delete );
  if ( $sql) {
    header ("location:{$hostname}/admin/users.php");
  }



?>
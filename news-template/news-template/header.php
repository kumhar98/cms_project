<?php
include "config.php";
 if (isset($_SERVER["PHP_SELF"])) {
   $page_id = basename($_SERVER["PHP_SELF"]);
   switch ($page_id) {
    case 'category.php':
         if (isset($_GET["cid"])) {
           $id  = $_GET["cid"];
            $ql = "SELECT * FROM category WHERE category_id = $id";
            $result = mysqli_query($conn, $ql);
            $row = mysqli_fetch_assoc( $result ) ;
            $title_name =  $row['category_name'];
           
         }else{
            $title_name = "No Record Found";
         }
        break;
        case 'author.php':
            if (isset($_GET["aid"])) {
              $id  = $_GET["aid"];
               $ql = "SELECT * FROM user WHERE user_id = $id";
               $result = mysqli_query($conn, $ql);
               $row = mysqli_fetch_assoc( $result ) ;
               $title_name =  $row['first_name']." ".$row['last_name'];
              
            }else{
               $title_name = "No Record Found";
            }
           break;
           case 'single.php':
            if (isset($_GET["id"])) {
              $id  = $_GET["id"];
               $ql = "SELECT * FROM post WHERE post_id = $id";
               $result = mysqli_query($conn, $ql);
               $row = mysqli_fetch_assoc( $result ) ;
               $title_name =  $row['title'];
              
            }else{
               $title_name = "No Record Found";
            }
           break;
           case 'search.php':
            if (isset($_GET["search"])) {
              $id  = $_GET["search"];
               $title_name =   $id ;
              
            }else{
               $title_name = "No Search Record Found";
            }
           break;
           default:
            $title_name = "News Site";
            break;
   }
 }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title_name ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/news.jpg"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class='menu'>
                    <li><a href="index.php"> Home</a></li>
                    <?php 
                   if (isset($_GET['cid'])) {
                     $cid=$_GET['cid'];
                   }
                    include "config.php";
                    $sqli = "SELECT * FROM category WHERE post > 0";
                      $result = mysqli_query($conn,$sqli );
                      $active = "";
                      if (mysqli_num_rows( $result)> 0 ) {
                        while ( $row=mysqli_fetch_assoc($result)) {
                            if (isset($_GET['cid'])) {
                                if($cid == $row['category_id']){
                                    $active = "active";
                                }else{
    
                                    $active = "";
                                
                                }
                               }
                          echo  "<li ><a  class='{$active}'href='category.php?cid={$row['category_id']}'>{$row['category_name']}</a></li>";
                        }
                      }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->

<?php                       
include "header.php"; 
      include "config.php";
      if ($_SESSION["role"]==0) {
        header ("location:{$hostname}/admin/post.php");
      }
      if (isset($_GET["page"])) {
          
         $page = $_GET["page"]; 
       
    }else{
        $page =1; 
    }
    $limit = 3;
    $offset = ( $page -1) *  $limit;

$sql= "SELECT * FROM user ORDER BY user_id ASC LIMIT {$offset}, {$limit} ";

  $result = mysqli_query($conn, $sql);
 
?>



  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                <?php 
                 if ( mysqli_num_rows($result) > 0) {
                        
                ?>
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                          <tr>
                              <td class='id'><?php echo $row['user_id'] ?></td>
                              <td><?php echo $row['first_name']." &nbsp;" .$row['last_name'] ?></td>
                              <td><?php echo $row['user_name'] ?></td>
                              <td>
                              <?php
                              
                                 if ( $row['role'] == 0 ) {
                                    echo "Normal";
                                 }else{
                                    echo "Admin";
                                 }
                               ?>
                              </td>
                              <td class='edit'><a href='update-user.php?id=<?php echo $row["user_id"]; ?>' name = " edit" ><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?php echo $row["user_id"]; ?>' name = "delete"><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php } ?>
                      </tbody>
                  </table>
                  <?php } ?>
                    <?php 
                      $sqli2 = "SELECT * FROM user";
                      $result2 = mysqli_query($conn, $sqli2) or die("query field"); 

                      if (mysqli_num_rows($result2) > 0 ) {
                          $total_record = mysqli_num_rows($result2) ;
                        $total_page = ceil($total_record /  $limit);
                         echo "<ul class='pagination admin-pagination'>";
                         if ($page > 1) {
                           echo '<li class="page-item"><a class="page-link" href="users.php?page='.($page-1).'">Previous</a></li>';
                         }
                          for ($i=1; $i <= $total_page ; $i++) { 
                            if ($i == $page ) {
                                $adtive = "active";
                            }else {
                                $adtive = " "; 
                            }
                           echo  '<li class = "'.$adtive.'" ><a href="users.php?page='.$i.'">'.$i.'</a></li>';
                          }
                          if ($total_page > $page) {
                            echo  '<li class="page-item"><a class="page-link" href="users.php?page='.($page+1).'">Next</a></li>';
                          }
                          echo "</ul>";
                      }
                    
                    ?>
                 
                
              </div>
          </div>
      </div>
  </div>
  <?php include "footer.php"; ?>

<?php include "header.php"; 
include "config.php";
if ($_SESSION["role"]==0) {
    header ("location:{$hostname}/admin/post.php");
  } 


?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php 
                        if (isset ($_GET['page1'])) {
                            $page1 = $_GET['page1'];
                        }else{
                            $page1 = 1;  
                        }
                        $limit = 3;
                        $offset = ($page1-1) * $limit;
                        $sqli ="SELECT * FROM category LIMIT $offset, $limit";
                        $result = mysqli_query($conn,$sqli);
                        if (mysqli_num_rows($result) > 0) {
                          while ($row=mysqli_fetch_assoc(  $result)) {
                            echo "<tr>";
                            echo "<td class='id'>$row[category_id]</td>";
                            echo "<td>$row[category_name]</td>";
                            echo "<td>$row[post]</td>";
                          echo  "<td class='edit'><a href='update-category.php?id=$row[category_id]'><i class='fa fa-edit'></i></a></td>";
                          echo  "<td class='delete'><a href='delete-category.php?id=$row[category_id]'><i class='fa fa-trash-o'></i></a></td>";
                       echo "</tr>";
                          }
                        }
                        ?>
                    </tbody>
                </table>
                <ul class='pagination admin-pagination'>
                    <?php 
                      $sqli ="SELECT * FROM category";
                      $result = mysqli_query($conn,$sqli);
                      $total_page = mysqli_num_rows($result);
                      $page =   ceil($total_page / $limit );
                      if ($page1 > 1) {
                        echo '<li class="page-item"><a class="page-link" href="category.php?page1='.($page1-1).'">Previous</a></li>';
                      }
                      for ($i=1; $i <=$page ; $i++) { 
                        if ($i == $page1 ) {
                            $adtive = "active";
                        }else {
                            $adtive = " "; 
                        }
                       echo "<li class ='$adtive' ><a href='category.php?page1=$i'>{$i}</a></li>";
                      }
                      if ($page > $page1 ) {
                        echo '<li class="page-item"><a class="page-link" href="category.php?page1='.($page1+1).'">Next</a></li>';
                      }
                    ?>
                    <!-- <li class="active"><a>1</a></li> -->
                   
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>

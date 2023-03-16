<?php include 'header.php'; 
include "config.php";
?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                  <?php 
                    $id =$_GET['id'];
                     $sqli = "SELECT * FROM post  LEFT JOIN user ON post.author = user.user_id LEFT JOIN category ON post.category = category.category_id
                     WHERE post_id = $id ";
                   $result = mysqli_query($conn,$sqli);
                    if(mysqli_num_rows($result)>0){
                      while ($row = mysqli_fetch_assoc($result)) {  
                     
                    ?>
                    <div class="post-container">
                        <div class="post-content single-post">
                            <h3><?php echo $row['title'] ?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href="category.php?cid=<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?aid=<?php echo $row['author'] ?>'><?php echo $row['user_name'] ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <a href='author.php'><?php echo $row['Post_date'] ?></a>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?php echo $row['Post_img'] ?>" alt=""/>
                            <p class="description">
                            <?php echo $row['description'] ?>             
                           </p>
                        </div>
                    </div>
                    <?php 
                    }
                }
                ?>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>

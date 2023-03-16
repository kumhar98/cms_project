<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <?php 
                  if ( isset($_GET["page"])) {
                    $page = $_GET["page"];
                }else{
                    $page =1;
                }
                $limit = 3;
               if (isset($_GET["aid"])) {
                 $aid=$_GET["aid"];
               }
                $offset = ($page - 1)* $limit;
             $sqli = "SELECT * FROM post  LEFT JOIN user ON post.author = user.user_id LEFT JOIN category ON post.category = category.category_id
               WHERE author = $aid LIMIT   $offset , $limit  ";
               $result = mysqli_query($conn,$sqli);
                if(mysqli_num_rows($result)>0){
                  while ($row = mysqli_fetch_assoc($result)) {  
                
                ?>
                <div class="post-container">
                  <h2 class="page-heading"><?php echo $row['first_name']. " ".$row['last_name']?> </h2>
                    <div class="post-content"> 
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $row['post_id'] ?> "><img src="admin/upload/<?php echo $row['Post_img'] ?> " alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $row['post_id'] ?>'><?php echo $row['title'] ?> </a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href="category.php?cid=<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php'><?php echo $row['user_name'] ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['Post_date'] ?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php echo substr($row['description'],0,140)."..."; ?>                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'] ?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                  }
                }
                ?>
                    <ul class='pagination'>
                    <?php 
                                     $sqli = "SELECT author FROM post  WHERE author = $aid";
                                     $result = mysqli_query($conn,$sqli);
                                     $total_record = mysqli_num_rows($result);
                                     $limit = 3;
                                     $total_page = ceil($total_record/ $limit);
                                     if ($page > 1) {
                                        echo '<li><a href="category.php??aid='.($aid).'&page='.($page-1).'">Previous</a></li>';
                                     }
                                     for ($i=1; $i <=$total_page ; $i++) { 
                                        if ($page == $i ) {
                                            $active = "active";
                                        }else{
                                            $active = " "; 
                                        }
                                        echo "<li  class=".$active."><a href='category.php?aid=$aid&page=$i'>$i</a></li>";
                                     }
                                     if ($total_page > $page) {
                                        echo '<li><a href="category.php?aid='.($aid).'&page='.($page+1).'">Next</a></li>';
                                     }
                                      
                            
                            ?>
                        </ul>
                </div>
                <!-- /post-container -->
            </div>
        </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>

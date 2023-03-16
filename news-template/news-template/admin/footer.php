<!-- Footer -->
<?php
 include "config.php";
 $sql = "SELECT description FROM setting";
 $result = mysqli_query($conn, $sql);
 $row=mysqli_fetch_assoc( $result);

?>
<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span><?php echo $row['description'] ?></span>
            </div>
        </div>
    </div>
</div>
<!-- /Footer -->
</body>
</html>

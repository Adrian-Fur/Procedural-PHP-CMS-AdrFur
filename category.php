<?php
include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php";
include "admin/functions.php";
?>
    

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php
                

                if(isset($_GET['category'])){

                    $post_category_id = $_GET['category'];

                    if(is_admin($_SESSION['username'])){

                        //$query = "SELECT * FROM posts WHERE post_category_id = $post_category_id";
                        $statment1 = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ?");


                    } else {

                        //$query = "SELECT * FROM posts WHERE post_category_id = $post_category_id AND post_status = 'published'";
                        $statment2 = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ? AND post_status = ?");

                        $published ='published';

                    }

                if(isset($statment1)){

                    mysqli_stmt_bind_param($statment1, "i", $post_category_id);

                    mysqli_stmt_execute($statment1);

                    mysqli_stmt_bind_result($statment1, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);

                    $statment = $statment1;
                } else {

                    mysqli_stmt_bind_param($statment2, "is", $post_category_id, $published);


                    mysqli_stmt_execute($statment2);

                    mysqli_stmt_bind_result($statment2, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);

                    $statment = $statment2;
                }

                    //if(mysqli_num_rows($selectAllPostsQuery) <1 ){
                     mysqli_stmt_store_result($statment);
                    if(mysqli_stmt_num_rows($statment) === 0 ){

                        echo "<h1 class='text-center'>NO POSTS AVAILABE!</h1>";

                    } 
                
                // while ($row = mysqli_fetch_assoc($selectAllPostsQuery)){
                //     $post_id =  $row['post_id'];
                //     $post_title =  $row['post_title'];
                //    $post_author =  $row['post_author'];
                //    $post_date =  $row['post_date'];
                //    $post_image =  $row['post_image'];
                //    $post_content = substr($row['post_content'], 0,100);

                   while (mysqli_stmt_fetch($statment)):
                   
                
                ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?> "><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                
                

                <?php endwhile; mysqli_stmt_close($statment); }  else {

                    header("Location: index.php");

                } ?>

           

            </div>

<?php include "includes/sidebar.php"; ?>            
          

        </div>
        <!-- /.row -->

        <hr>

 <?php include "includes/footer.php"; ?>  
      

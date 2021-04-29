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

                if (isset($_GET['p_id'])){
                    $the_post_id = $_GET['p_id'];

                    
                $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";
                $send_view_query = mysqli_query($connection, $view_query);
                
                    confirm($send_view_query);


                    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ){

                        $query = "SELECT * FROM posts WHERE post_id = $the_post_id";

                    } else {

                        $query = "SELECT * FROM posts WHERE post_id = $the_post_id AND post_status = 'published'";
                    }

                $selectAllPostsQuery= mysqli_query($connection, $query);

                if(mysqli_num_rows($selectAllPostsQuery) < 1 ){

                    echo "<h1 class='text-center'>NO POSTS AVAILABE!</h1>";

                } else {
                while ($row = mysqli_fetch_assoc($selectAllPostsQuery)){
                   $post_title =  $row['post_title'];
                   $post_author =  $row['post_author'];
                   $post_date =  $row['post_date'];
                   $post_image =  $row['post_image'];
                   $post_content =  $row['post_content'];
                ?>

                <h1 class="page-header">
                    Post
                    
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                

                <hr>
                
                

                <?php } 
                
          
                
                
                
                
                ?>




                <!-- Blog Comments -->

            <?php

            if(isset($_POST['create_comment'])){
                
                $the_post_id = $_GET['p_id'];

                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];

                if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){


                    $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                    $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";
    
                    $create_comment_query = mysqli_query($connection, $query);
                    if(!$create_comment_query){
                        die ('QUERY FAILED' . mysqli_error($connection));
                    }
    
                    //OLD COMMENT COUNT

                    // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                    // $query .="WHERE post_id = $the_post_id";
    
                    // $update_comment_count = mysqli_query($connection, $query);
    
                    // if(!$update_comment_count){
                    //     die ('QUERY FAILED' . mysqli_error($connection));
                    // }


                } else {

                    echo "<script>alert('Fields cannot be empty')</script>";
                }

            }
            ?>
                
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                    <div class="form-group">
                    <label for="Author">Author</label>
                        <input type="text" class="form-control" name="comment_author" id="">
                        </div>
                        <div class="form-group">
                        <label for="Emial">Email</label>
                        <input type="email" class="form-control" name="comment_email" id="">
                        </div>
                        <div class="form-group">
                        <label for="Comment">Comment</label>
                            <textarea class="form-control"  name="comment_content" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
            <?php
                $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
                $query .="AND comment_status = 'approved' ";
                $query .="ORDER BY comment_id DESC ";
                
                $select_comment_query = mysqli_query($connection, $query);
                if(!$select_comment_query){

                    die('QUERY FAILED'. mysqli_error($connection));

                }
              
                    while ($row = mysqli_fetch_array($select_comment_query)) {
                        $comment_date =  $row['comment_date'];
                        $comment_content =  $row['comment_content'];
                        $comment_author =  $row['comment_author'];
                        
                        ?>
                        
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>



                   <?php } }  } else {

            header("Location: index.php");
                    } 
                    ?>
                        
     

            </div>

<?php include "includes/sidebar.php"; ?>            
          

        </div>
        <!-- /.row -->
</div>
        <hr>

 <?php include "includes/footer.php"; ?>  
      

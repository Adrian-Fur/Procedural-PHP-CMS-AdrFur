<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

    <?php include "includes/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                <h1 class="page-header">
                        Blank Page
                        <small>Subheading</small>
                    </h1>
                    



<table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td>Id</td>
                                <td>Author</td>
                                <td>Comment</td>
                                <td>Email</td>
                                <td>Status</td>
                                <td>In Response to</td>
                                <td>Date</td>
                                <td>Approve</td>
                                <td>Unapprove</td>
                                <td>Delete</td>
                            </tr>
                        </thead>
                    
                    <tbody>
                    <?php

                    $query = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_real_escape_string($connection, $_GET['id']) . "" ;
                    $selectComments = mysqli_query($connection, $query);


                    while ($row = mysqli_fetch_assoc($selectComments)) {
                        $comment_id =  $row['comment_id'];
                        $comment_post_id =  $row['comment_post_id'];
                        $comment_author =  $row['comment_author'];
                        $comment_content =  $row['comment_content'];
                        $comment_email =  $row['comment_email'];
                        $comment_status =  $row['comment_status'];
                        $comment_date =  $row['comment_date'];
                        

                        echo "<tr>";
                        echo "<td>$comment_id</td>";
                        echo "<td>$comment_author</td>";  
                        echo "<td>$comment_content</td>";
                        


                        // $query = "SELECT * FROM categories WHERE cat_id= {$post_category_id}";
                        // $selectCategoriesId = mysqli_query($connection, $query);


                        // while ($row = mysqli_fetch_assoc($selectCategoriesId)) {
                        //     $cat_id =  $row['cat_id'];
                        //     $cat_title =  $row['cat_title'];
                        

                        // echo "<td>{$cat_title}</td>";
                        // }

                        echo "<td>$comment_email</td>";
                        echo "<td>$comment_status</td>";
                        

                         $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                         
                         $select_post_id_query = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($select_post_id_query)){

                            $post_id =  $row['post_id'];
                            $post_title = $row['post_title'];

                            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                         }




                        echo "<td>$comment_date</td>";  
                        echo "<td><a href='posts_comments.php?approve={$comment_id}&id=" . $_GET['id'] . "'>Approve</a></td>"; 
                        echo "<td><a href='posts_comments.php?unapprove={$comment_id}&id=" . $_GET['id'] . "'>Unapprove</a></td>";  
                        echo "<td><a href='posts_comments.php?delete={$comment_id}&id=" . $_GET['id'] . "'>Delete</a></td>";  
                        echo "</tr>";
                        

                    }           

                    ?>
                  
                    
                    </tbody>
                    </table> 
<?php

if(isset($_GET['approve'])){

    $the_comment_id = $_GET['approve'];
    
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id ";
    
    $approve_comment_query = mysqli_query($connection, $query);
    
    header("Location: posts_comments.php?id=". $_GET['id']."");
    }






if(isset($_GET['unapprove'])){

    $the_comment_id = $_GET['unapprove'];
    
    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id";
    
    $unnaprove_comment_query = mysqli_query($connection, $query);
    
    header("Location: posts_comments.php?id=". $_GET['id']."");
    }













if(isset($_GET['delete'])){

$the_comment_id = $_GET['delete'];

$query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";

$delete_query = mysqli_query($connection, $query);

header("Location: posts_comments.php?id=". $_GET['id']."");
}

?>

</div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php include "includes/admin_footer.php"; ?>
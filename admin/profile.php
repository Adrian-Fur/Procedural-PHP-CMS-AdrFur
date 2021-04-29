<?php include "includes/admin_header.php"; ?>

<?php

if(isset($_SESSION['username'])){
  $username = $_SESSION['username'];


    $query = "SELECT * FROM users WHERE user_name = '{$username}' ";

    $select_user_profile_query = mysqli_query($connection, $query);


    while($row = mysqli_fetch_array($select_user_profile_query)){
        $user_id =  $row['user_id'];
        $user_name =  $row['user_name'];
        $user_password =  $row['user_password'];
        $user_firstname =  $row['user_firstname'];
        $user_lastname =  $row['user_lastname'];
        $user_email =  $row['user_email'];
        $user_image =  $row['user_image'];
        $user_role =  $row['user_role'];
    }


}


?>

<?php

if(isset($_POST['edit_users'])){

    
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $user_email = $_POST['user_email'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname =$_POST['user_lastname'];
 
    //move_uploaded_file($post_image_temp, "../images/$post_image");

  $query = "UPDATE users SET ";
  $query .= "user_name = '{$user_name}', ";
  $query .= "user_password = '{$user_password}', ";
  $query .= "user_email = '{$user_email}', ";
  $query .= "user_firstname = '{$user_firstname}', ";
  $query .= "user_lastname = '{$user_lastname}' ";
  $query .= "WHERE user_name = '{$username}' ";

  $update_user = mysqli_query($connection, $query);

 
   confirm($update_user);
   header("Location: users.php");

  
}


?>


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
                    <form action="" method="post" enctype="multipart/form-data">
                    

<div class="form-group">
        <label for="user_name">Username</label>
        <input type="text" value="<?php echo $user_name; ?>" class="form-control" name="user_name" />
      </div>
      <div class="form-group">
        <label for="user_password">Password</label>
        <input autocomplete="off" type="password" class="form-control" name="user_password" />        
        </div>
        <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email" />        
        </div>
     

        <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname" />
      </div>
     
      <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname" />
      </div>
      </div>
   
      <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image" />
      </div>
      -->
     
        <div class="form-group">
          <input class="btn btn-primary" type="submit" name="edit_users" value="Update Profile">
        </div>
    </form>
            
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
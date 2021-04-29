<?php

if(isset($_GET['edit_users'])){

 $the_user_id = $_GET['edit_users'];
  
 $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
  $selectUsersQuery = mysqli_query($connection, $query);


   while ($row = mysqli_fetch_assoc($selectUsersQuery)) {
      $user_id =  $row['user_id'];
      $user_name =  $row['user_name'];
      $user_password =  $row['user_password'];
      $user_firstname =  $row['user_firstname'];
      $user_lastname =  $row['user_lastname'];
      $user_email =  $row['user_email'];
      $user_image =  $row['user_image'];
      $user_role =  $row['user_role'];
                        
}




if(isset($_POST['edit_users'])){

    
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname =$_POST['user_lastname'];
 


    // $query = "SELECT randSalt FROM users";
    // $select_randsalt_query = mysqli_query($connection, $query);
    
    // if(!$select_randsalt_query){
    
    //     die('QUERY FAILED'. mysqli_error($connection));
    
    // }
    // $row = mysqli_fetch_array($select_randsalt_query);

    // $salt = $row['randSalt'];

    // $hashed_password = crypt($user_password, $salt);


    if(!empty($user_password)){

      $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
      $get_user_query = mysqli_query($connection, $query_password);
      confirm($get_user_query);

      $row = mysqli_fetch_array($get_user_query);

      $db_user_password = $row['user_password'];

      if($db_user_password !=$user_password){
        $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
        }

        $query = "UPDATE users SET ";
        $query .= "user_name = '{$user_name}', ";
        $query .= "user_password = '{$hashed_password}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}' ";
        $query .= "WHERE user_id = {$user_id}";

        $update_user = mysqli_query($connection, $query);

      
        confirm($update_user);
        header("Location: users.php");
    }

}
} else{

  header("Location: index.php");
}

?>

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
      <label for="user_role">User Role</label>
        <select name="user_role" id="user_role">

        <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
        <?php
          if($user_role == 'admin'){

           echo "<option value='subscriber'>subscriber</option>";

          } else {
              echo "<option value='admin'>admin</option>";
          }
          ?>       
        
        </select>
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

        <div class="form-group">
          <input class="btn btn-primary" type="submit" name="edit_users" value="Update User">
        </div>
    </form>
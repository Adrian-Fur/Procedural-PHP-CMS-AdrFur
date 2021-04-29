<?php

if(isset($_POST['create_users'])){

    
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname =$_POST['user_lastname'];
 
    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));


    $query = "INSERT INTO users(user_name, user_password, user_email, user_role, user_firstname, user_lastname ) ";
    $query .= "VALUES ('{$user_name}', '{$user_password}', '{$user_email}', '{$user_role}', '{$user_firstname}', '{$user_lastname}') ";

    $create_users_query = mysqli_query($connection, $query);

 
   confirm($create_users_query);
  header("Location: users.php");
  
}


?>

<form action="" method="post" enctype="multipart/form-data">


<div class="form-group">
        <label for="user_name">Username</label>
        <input type="text" class="form-control" name="user_name" />
      </div>
      <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password" />        
        </div>
        <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email" />        
        </div>
      
        <div class="form-group">
      <label for="user_role">User Role</label>
        <select name="user_role" id="user_role">
                 <option value="subscriber">Select Options</option>
                <option value="admin">Admin</option>
                <option value="subscriber">Subscriber</option>
        
        
        </select>
        </div>
     

        <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname" />
      </div>
     
      <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname" />
      </div>
      </div>
     
    
     
      <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image" />
      </div>
      -->
      
     
     

       
        
        <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_users" value="Add User">
        </div>
    </form>
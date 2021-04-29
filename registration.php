<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "admin/functions.php"; ?>


<?php 

if($_SERVER['REQUEST_METHOD'] == "POST"){

$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);

$error = [

    'username' => '',
    'email' => '',
    'password' => ''


];

if(strlen($username) < 4){
    $error['username'] ='Username cannot have less than 4 characters!';
}
if($username == ''){
    $error['username'] ='Username cannot be empty!';
}
if(username_exists($username)){
    $error['username'] ='Username already exists!';
}

if($email == ''){
    $error['email'] ='Email cannot be empty!';
}
if(email_exists($email)){
    $error['email'] ='Email already exists!';
}

if($password == ''){
    $error['password'] ='Password cannot be empty!';
}

foreach($error as $key => $value){

    if(empty($value)){

        unset($error[$key]);
        

       
    }

    if(empty($error)){

        register_user($username,$email,$password);

        login_user($username,$password);
    }
}
}
// $query = "SELECT randSalt FROM users";
// $select_randsalt_query = mysqli_query($connection, $query);

// if(!$select_randsalt_query){

//     die('QUERY FAILED'. mysqli_error($connection));

// }

// $row = mysqli_fetch_array($select_randsalt_query);

// $salt = $row['randSalt'];

// $password = crypt($password, $salt);


?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">

                    
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Your Username" autocomplete="on" value="<?php echo isset($username) ? $username : '' ?>">
                            <p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email" autocomplete="on" value="<?php echo isset($email) ? $email : '' ?>">
                            <p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Enter Your Password">
                            <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
                        </div>
                
                        <input type="submit" name="registration" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>


<?php


function escape($string){

global $connection;

    return mysqli_real_escape_string($connection, trim($string));
}




function users_online(){

    if(isset($_GET['onlineusers'])){

    global $connection;

    if(!$connection){
        session_start();
        include("../includes/db.php");


        $session = session_id();
        $time = time();
        $time_out_in_secounds = 30;
        $time_out = $time - $time_out_in_secounds;
        
        
        $query = "SELECT * FROM users_online WHERE session = '$session'";
        
        $send_query = mysqli_query($connection, $query);
        
        $count = mysqli_num_rows($send_query);
        
        if($count == NULL){
        
        mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES ('$session','$time')");   
        
        } else {
        
        mysqli_query($connection, "UPDATE users_online SET time ='$time' WHERE session = '$session'");   
        
        }
        
        $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");  
        echo $count_user = mysqli_num_rows($users_online_query);

    }
    
    
} //GET REQUEST


} 

users_online();

function confirm($result){
    global $connection;
    if(!$result) {
        die ("QUERY FAILED ." . mysqli_error($connection));
      }
      
}
function insert_categories(){

    global $connection;
if (isset($_POST['submit'])) {
    $cat_title = $_POST['cat_title'];

    if ($cat_title == "" || empty($cat_title)) {
        echo "This field should not be empty";
    } else {
        //$query = "INSERT INTO categories(cat_title) VALUE ('$cat_title')";
        $statment = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUE (?)");

        mysqli_stmt_bind_param($statment, "s", $cat_title);
        mysqli_stmt_execute($statment);

        if (!$statment) {
            die('QUERY FAILED' . mysqli_error($connection));
        }
    }
    mysqli_stmt_close($statment);
}
}


function findAllCategories(){
    global $connection;

 //FIND ALL CATEGORIES QUERY
 $query = "SELECT * FROM categories";
 $selectCategories = mysqli_query($connection, $query);


 while ($row = mysqli_fetch_assoc($selectCategories)) {
     $cat_id =  $row['cat_id'];
     $cat_title =  $row['cat_title'];

     echo "<tr>";
     echo "<td>{$cat_id}</td>";
     echo "<td>{$cat_title}</td>";
     echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
     echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
     echo "</tr>";
 }

}


function deleteCategories(){
        global $connection;

            //DELETE QUERY
            if (isset($_GET['delete'])) {
                $the_cat_id = $_GET['delete'];

                $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
                $delete_query = mysqli_query($connection, $query);
                header("Location: categories.php");
            }



}

//INDEX RECORD COUNT QUERY
function recordCount($table){

    global $connection;

    $query = "SELECT * FROM . $table";

    $select_all_posts = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_all_posts);

    confirm($result);

    return $result;
}

//INDEX CHCECK STATUS
function checkStatus($table, $column, $status){

    global $connection;
$query = "SELECT * FROM $table WHERE $column = '$status'";
$result = mysqli_query($connection, $query);

confirm($result);

return mysqli_num_rows($result);

}

//USER ROLE CHECK
function is_admin($username = ''){
    global $connection;

    $query = "SELECT user_role FROM users WHERE user_name = '$username'";
    $result = mysqli_query($connection, $query);
    confirm($result);

    $row = mysqli_fetch_array($result);

    if (!isset($row['user_role'])) {
        return false;
    } else if ($row['user_role'] == 'admin') {
        return true;
    } else {
        return false;
    }
}

function username_exists($username){

global $connection;

$query = "SELECT user_name FROM users WHERE user_name = '$username'";

$result = mysqli_query($connection, $query);

confirm($result);

if(mysqli_num_rows($result) > 0) {

    return true;

} else {

    return false;
}

}


function email_exists($email){

    global $connection;
    
    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    
    $result = mysqli_query($connection, $query);
    
    confirm($result);
    
    if(mysqli_num_rows($result) > 0) {
    
        return true;
    
    } else {
    
        return false;
    }
    
    }



function redirect($location){

        return header("Location:" . $location);

    }



function register_user($username,$email,$password){

 global $connection;

$username = mysqli_real_escape_string($connection, $username);
$email = mysqli_real_escape_string($connection, $email);
$password = mysqli_real_escape_string($connection, $password);

$password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
    

$query = "INSERT INTO users (user_name, user_email, user_password, user_role) ";
$query .= "VALUES ('{$username}', '{$email}', '{$password}', 'subscriber' )";
$register_user_query = mysqli_query($connection, $query);

confirm($register_user_query);



}


function login_user($username,$password){

    global $connection;
    
$username = trim($username);
$password = trim($password);
    
$username = mysqli_real_escape_string($connection, $username);
$password = mysqli_real_escape_string($connection, $password);


$query = "SELECT * FROM users WHERE user_name = '{$username}'";
$select_user_query = mysqli_query ($connection, $query);

confirm($select_user_query);

while($row = mysqli_fetch_array($select_user_query)){

    $db_user_id = $row['user_id'];
    $db_user_name = $row['user_name'];
    $db_user_password = $row['user_password'];
    $db_user_firstname = $row['user_firstname'];
    $db_user_lastname = $row['user_lastname'];
    $db_user_role = $row['user_role'];

}
if(password_verify($password,  $db_user_password)){
    if (session_status() == PHP_SESSION_NONE) session_start();
    $_SESSION['username'] = $db_user_name;
    $_SESSION['firstname'] = $db_user_firstname;
    $_SESSION['lastname'] = $db_user_lastname;
    $_SESSION['user_role'] = $db_user_role;

    redirect("/cms/admin/index.php");
  
} else {

    redirect("/cms/index.php");
}

}


?>



<?php ob_start(); ?>
<?php

if(isset($_GET['p_id'])){

$the_post_id = $_GET['p_id'];
}


$query = "SELECT * FROM posts WHERE post_id = $the_post_id";
$selectPostsById = mysqli_query($connection, $query);


while ($row = mysqli_fetch_assoc($selectPostsById)) {
    $post_id =  $row['post_id'];
    $post_user =  $row['post_user'];
    $post_title =  $row['post_title'];
    $post_category_id =  $row['post_category_id'];
    $post_status =  $row['post_status'];
    $post_image =  $row['post_image'];
    $post_content =  $row['post_content'];
    $post_tags =  $row['post_tags'];
    $post_comment_count =  $row['post_comment_count'];
    $post_date =  $row['post_date'];    


}

if(isset($_POST['update_post'])){

  $post_update = $_POST['update_post'];

  $post_title = $_POST['title'];
  $post_user = $_POST['post_user'];
  $post_category_id = $_POST['post_category'];
  $post_status = $_POST['post_status'];
  $post_image = $_FILES['image']['name'];
  $post_image_temp = $_FILES['image']['tmp_name'];
  $post_tags = $_POST['post_tags'];
  $post_content = $_POST['post_content'];
  
  move_uploaded_file($post_image_temp, "../images/$post_image");


  if(empty($post_image)){

    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
    $select_image = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($select_image)){
      $post_image = $row['post_image'];

    }
  }

  $query = "UPDATE posts SET ";
  $query .= "post_title = '{$post_title}', ";
  $query .= "post_author = '{$post_user}', ";
  $query .= "post_category_id = '{$post_category_id}', ";
  $query .= "post_status = '{$post_status}', ";
  $query .= "post_image = '{$post_image}', ";
  $query .= "post_date = now(), ";
  $query .= "post_tags = '{$post_tags}', ";
  $query .= "post_content = '{$post_content}' ";
  $query .= "WHERE post_id = {$post_id}";

  $update_post = mysqli_query($connection, $query);

 
   confirm($update_post);
   header("Location: posts.php");
}


?>


<form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title" />
      </div>
     
      <div class="form-group">
      <label for="post_category">Post Category</label>
        <select name="post_category" id="post_category">
        
        <?php

$query = "SELECT * FROM categories";
$selectCategories = mysqli_query($connection, $query);

confirm($selectCategories);

while ($row = mysqli_fetch_assoc($selectCategories)) {
    $cat_id =  $row['cat_id'];
    $cat_title =  $row['cat_title'];

    

  if($cat_id == $post_category_id){

    echo "<option selected value='{$cat_id}'>{$cat_title}</option>";

  } else {
    echo "<option value='{$cat_id}'>{$cat_title}</option>";
  }

}       
?>     
        
        
        </select>
       
      </div>
     
      <div class="form-group">
      <label for="post_user">Post Author</label>
        <select name="post_user" id="post_user">
        
       <?php echo "<option value='{$post_user}'>{$post_user}</option>"; ?>
        <?php

$query = "SELECT * FROM users";
$selectUsers = mysqli_query($connection, $query);

confirm($selectUsers);

while ($row = mysqli_fetch_assoc($selectUsers)) {
    $user_id =  $row['user_id'];
    $username =  $row['user_name'];

    echo "<option value='{$username}'>{$username}</option>";
}       
?>     
        
        
        </select>
       
      </div>
      <!-- <div class="form-group">
        <label for="title">Post Author</label>
        <input value="<?php // echo $post_user; ?>" type="text" class="form-control" name="author" />
      </div> -->

      <div class="form-group">
      <label for="post_status">Post Status</label>
      <select name="post_status" id="post_status">
      <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>

      <?php
      if($post_status === 'published'){
        echo "<option value='draft'>Draft</option>";
      } else {
        echo "<option value='published'>Publish</option>";
      }
      ?>
      </select>
      </div>


      <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file" name="image">
      </div>
     
      <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags" />
      </div>
     
      <div class="form-group">
        <label for="post_content">Post Content</label>
          <textarea  class="form-control" name="post_content" id="body" rows="10" cols="30"><?php echo $post_content; ?></textarea>
        </div>
     
        <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
        </div>
    </form>
<?php

if(isset($_POST['create_post'])){

    $post_title = $_POST['title'];
    $post_user = $_POST['post_user'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
    $query .= "VALUES ('{$post_category_id}', '{$post_title}', '{$post_user}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";

    $create_post_query = mysqli_query($connection, $query);

 
   confirm($create_post_query);

  
}


?>

<form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" />
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

    echo "<option value='{$cat_id}'>{$cat_title}</option>";
}       
?>     
        
        
        </select>
       
      </div>
     

      <div class="form-group">
      <label for="post_user">Post Author</label>
        <select name="post_user" id="post_user">
        
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
        <input type="text" class="form-control" name="author" />
      </div> -->
     
      <div class="form-group">
        <label for="post_status">Post Status</label>

        <select name="post_status" id="">X

        <option value="draft">Select Options</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
       </select>
        
      </div>
     
      <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image" />
      </div>
     
      <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" />
      </div>
     
      <div class="form-group">
        <label for="post_content">Post Content</label>
          <textarea class="form-control" name="post_content" id="body" rows="10" cols="30"></textarea>
        </div>
     
        <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
        </div>
    </form>
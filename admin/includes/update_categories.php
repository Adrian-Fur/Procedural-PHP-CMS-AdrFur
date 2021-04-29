<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Edit Category</label>

        <?php

        if (isset($_GET['edit'])) {
            $cat_id = $_GET['edit'];
            $query = "SELECT * FROM categories WHERE cat_id= $cat_id";
            $selectCategoriesId = mysqli_query($connection, $query);


            while ($row = mysqli_fetch_assoc($selectCategoriesId)) {
                $cat_id =  $row['cat_id'];
                $cat_title =  $row['cat_title'];


        ?>
                <input value="<?php if (isset($cat_title)) {
                                    echo $cat_title;
                                } ?>" class="form-control" type="text" name="cat_title">

        <?php }
        } ?>

        <?php
        //UPDATE QUERY
        if (isset($_POST['update_category'])) {
            $the_cat_title = $_POST['cat_title'];

            $statment = mysqli_prepare($connection, "UPDATE categories SET cat_title= ? WHERE cat_id = ?");
            mysqli_stmt_bind_param($statment, 'si', $the_cat_title, $cat_id);
            mysqli_stmt_execute($statment);
            
            if (!$statment) {
                die("QUERY FAILED" . mysqli_error($connection));
            }
            mysqli_stmt_close($statment);

            redirect("categories.php");
        }


        ?>
    </div>
    <div class="form_group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">

    </div>

</form>
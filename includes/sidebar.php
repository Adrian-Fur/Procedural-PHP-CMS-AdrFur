  <!-- Blog Sidebar Widgets Column -->
  <div class="col-md-4">

      <?php

        if (isset($_POST['submit'])) {
            $search = $_POST['search'];

            $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
            $searchQuery = mysqli_query($connection, $query);

            if (!$searchQuery) {
                die("QUERY FAILED" . mysqli_error($connection));
            }

            $count = mysqli_num_rows($searchQuery);
            if ($count == 0) {
                echo "<h1> NO RESULT</h1>";
            }
        }
        ?>
      <!-- Blog Search Well -->
      <div class="well">
          <h4>Blog Search</h4>
          <form action="search.php" method="post">
              <div class="input-group">
                  <input name="search" type="text" class="form-control">
                  <span class="input-group-btn">
                      <button name="submit" class="btn btn-default" type="submit">
                          <span class="glyphicon glyphicon-search"></span>
                      </button>
                  </span>
              </div>
          </form> <!-- search form -->
          <!-- /.input-group -->
      </div>
        <!-- Login -->
      <div class="well">
      <?php if (isset($_SESSION['user_role'])):?>
            <h4>Logged in as <?php echo $_SESSION['username']; ?> </h4>
            <a href="includes/logout.php" class="btn btn-primary">Logout</a>
            <?php else: ?>

          <h4>Login</h4>
          <form action="includes/login.php" method="post">
              <div class="form-group">
                  <input name="username" type="text" class="form-control" placeholder="Enter Username">
                 
              </div>
              <div class="input-group">
                  <input name="password" type="password" class="form-control" placeholder="Enter Password">
                    <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">Submit</button>
                    
                    </span>
              </div>
          </form> <!-- search form -->


            <?php endif; ?>
       
          <!-- /.input-group -->
      </div>

      <!-- Blog Categories Well -->
      <div class="well">
          <?php

            $query = "SELECT * FROM categories";
            $selectCategoriesSidebar = mysqli_query($connection, $query);

            ?>
          <h4>Blog Categories</h4>
          <div class="row">
              <div class="col-lg-12">
                  <ul class="list-unstyled">
                      <?php

                        while ($row = mysqli_fetch_assoc($selectCategoriesSidebar)) {
                            $cat_title =  $row['cat_title'];
                            $cat_id =  $row['cat_id'];

                            echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                        }
                        ?>
                   </ul>
              </div>
          </div>
          <!-- /.row -->
      </div>

      <?php include "widget.php"; ?>
  </div>
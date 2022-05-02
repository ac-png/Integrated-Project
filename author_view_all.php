<?php
  require_once 'classes/DBConnector.php';

  try {
      $categories = Get::all('categories');
      $authors = Get::all('authors');
        
  } catch (Exception $e) {
    die("Exception: " . $e -> getMessage());
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/grid.css" />
  <link rel="stylesheet" href="css/stylesheet.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <script src="https://kit.fontawesome.com/8b98889217.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@700&family=Kurale&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <title>List of Authors</title>
</head>

<body>
  <div class='content'>
    <div class="container">
    <div class="homepage width-12">
        <div class="name">
          <h1><a href="index.php">THE DAILY BUGLE</a></h1>
        </div>
        <ul class="navbar">
          <li><a href="index.php">Home</a></li>
          <?php foreach ($categories as $category) { ?>
                <li><a href="categories.php?id=<?php echo $category->id ?>"><?= $category->name ?></a></li>
          <?php } ?>
          <div class="dropdown">
              <button class="dropbtn">Add</button>
              <div class="dropdown-content">
                  <a href="author_create_form.php">Author</a>
                  <a href="category_create_form.php">Category</a>
                  <a href="story_create_form.php">Article</a>
              </div>
          </div>
        </ul>
      </div>
      <div class="homepage width-12">
          <table class="table">
            <h1>List of Authors</h1>
              <thead>
                  <tr>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Link</th>
                      <th></th>
                      <th></th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach ($authors as $author) {?>
                  <tr>
                      <td>
                          <?= $author->first_name ?></a>
                      </td>
                      <td><?= $author->last_name ?></td>
                      <td><?= $author->link ?></td>
                      <td><a class="button" href="author_update_form.php?id=<?php echo $author -> id ?>">Update</a></td>
                      <td><a class="button" href="author_delete_form.php?id=<?php echo $author -> id ?>">Delete</a></td>
                  </tr>
                  <?php }?>
              </tbody>
          </table>
          <a class="button" href="author_create_form.php">Create</a>
      </div>
      <div class="homepage width-12 nestedHalf">
          <div class="footer">  
              <?php foreach ($categories as $category) { ?>
                <a href="categories.php?id=<?php echo $category->id ?>"><?= $category->name ?></a>
              <?php } ?>
          </div>
          <div class="footer">
            <p class="bold">View All:</p>
            <a href="author_view_all.php">Authors</a>
            <a href="category_view_all.php">Categories</a>
          </div>
      </div>
    </div>
  </div>
</body>

</html>
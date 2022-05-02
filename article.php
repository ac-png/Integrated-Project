<?php
  require_once 'classes/DBConnector.php';

  try {
    $mainStory = Get::byId('stories', $_GET['id']);
    $stories = Get::allOrderBy('stories', 'date DESC', 3);
    $categories = Get::all('categories');
  } catch (Exception $e) {
    die("Exception: " . $e->getMessage());
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
  <title><?php echo $mainStory->headline ?></title>
</head>

<body>
  <div class = 'content'>
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
      <div class="homepage width-8">
        <?php
          //category/author name instead of id number
          $category = Get::byId("categories", $mainStory->category_id);
          $author = Get::byId('authors', $mainStory->author_id);
          ?>
            <h1><?php echo $mainStory->headline ?></h1>
            <p><a href="<?php echo $author->link ?>"><?php echo $author->first_name ?> <?php echo $author->last_name ?></a> • <?php echo $mainStory->date ?> • <?php echo  $time = date("g:i", strtotime($mainStory -> time));  ?></p>
            <p class="bold"><?php echo $mainStory->summary ?></p>
            <p><?php echo nl2br($mainStory->article) ?></p>
            <a class="button" href="story_update_form.php?id=<?php echo $mainStory -> id ?>">Update</a>
            <a class="button" href="story_delete_form.php?id=<?php echo $mainStory -> id ?>">Delete</a> 
      </div>
      <div class="homepage width-4">
          <?php foreach ($stories as $story) {
            //category/author name instead of id number
            $category = Get::byId("categories", $story -> category_id);
          ?>
            <div>
              <hr>
              <a href="article.php?id=<?php echo $story -> id ?>">
                <h4><?php echo $category -> name?></h4>
                <h2><?php echo $story -> headline?></h2>
                <h5><?php echo $story -> date?> • <?php echo  $time = date("g:i", strtotime($story -> time));  ?></h5>
                <p>
                  <?php echo $story -> summary?>
                </p>
              </a>
            </div>
          <?php } ?>
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
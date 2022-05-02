<?php
    require_once 'classes/DBConnector.php';

    try {
      $categories = Get::all('categories');
    } catch (Exception $e) {
      die("Exception: " . $e -> getMessage());
    }

    session_start();
    if (isset($_SESSION["data"]) and isset($_SESSION["errors"])) {
        $data = $_SESSION["data"];
        $errors = $_SESSION["errors"];
    }
    else {
      try {
        $author = Get::byId('authors', $_GET['id']);
      } catch (Exception $e) {
        die("Exception: " . $e -> getMessage());
      }
      $data = [
        'id' => $author->id,
        'fname' => $author->first_name,
        'lname' => $author->last_name,
        'link' => $author->link
      ];
      $errors = [];
    }
    // echo "<pre>\$_data = ";
    // print_r($data);
    // echo "</pre>";

    // echo "<pre>\$_errors = ";
    // print_r($errors);
    // echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/grid.css" />
  <link rel="stylesheet" href="css/stylesheet.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <script src="https://kit.fontawesome.com/8b98889217.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@700&family=Kurale&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <title>Update existing author</title>
</head>

<body>

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
        <div class='homepage width-12'>
          <form method="post">
            <h1>Update existing author</h1></br>

            <input id="id" type="hidden" name="id" value="<?php if (isset($data["id"])) echo $data["id"];?>">

            <label for="fname">First Name</label>
            <input id="fname" type="text" name="fname" value="<?php if (isset($data["fname"])) echo $data["fname"]; ?>">
              <div id="fname_error" class="errors"><?php if (isset($errors["fname"])) echo $errors["fname"]; ?></div>

            <label for="lname">Last Name</label>
            <input id="lname" type="text" name="lname" value="<?php if (isset($data["lname"])) echo $data["lname"]; ?>">
              <div id="lname_error" class="errors"><?php if (isset($errors["lname"])) echo $errors["lname"]; ?></div>

            <label for="link">Link</label>
            <input id="link" type="text" name="link" value="<?php if (isset($data["link"])) echo $data["link"]; ?>">
              <div id="link_error" class="errors"><?php if (isset($errors["link"])) echo $errors["link"]; ?></div>

              <button class="button" type="submit" formaction="author_update.php">Update</button>
            <a class="button" href="author_view_all.php">Cancel</a>
          </form>
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
      <script src="js/author_validate.js"></script>
  </body>
</html>
<?php if (isset($_SESSION["data"]) and isset($_SESSION["errors"])) {
    unset($_SESSION["data"]);
    unset($_SESSION["errors"]);
}
?>
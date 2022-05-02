<?php
    require_once 'classes/DBConnector.php';

    try {
      $categories = Get::all('categories');
      $authors = Get::all('authors');
    } catch (Exception $e) {
      die("Exception: " . $e -> getMessage());
    }

    session_start();
    if (isset($_SESSION["data"]) and isset($_SESSION["errors"])) {
        $data = $_SESSION["data"];
        $errors = $_SESSION["errors"];
    }
    else {
        $data = [];
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
  <title>Add new article</title>
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
            <h1>Add new article</h1></br>

            <label for="headline">Headline</label>
            <input id="headline" type="text" name="headline" value="<?php if (isset($data["headline"])) echo $data["headline"]; ?>">
              <div id="headline_error" class="errors"><?php if (isset($errors["headline"])) echo $errors["headline"]; ?></div>

            <label for="article">Article</label>
            <div>
                <textarea name="article" id="article" rows="10"><?php if (isset($data["article"])) echo $data["article"]; ?></textarea>
              </div>
              <div id="article_error" class="errors"><?php if (isset($errors["article"])) echo $errors["article"]; ?></div>

            <label for="summary">Summary</label>
            <div>
                <textarea name="summary" id="summary" rows="3"><?php if (isset($data["summary"])) echo $data["summary"]; ?></textarea>
              </div>
            <div id="summary_error" class="errors"><?php if (isset($errors["summary"])) echo $errors["summary"]; ?></div>

            <label for="date">Date</label>
            <input id="date" type="date" name="date" value="<?php if (isset($data["date"])) echo $data["date"]; ?>">
            <div id="date_error" class="errors"><?php if (isset($errors["date"])) echo $errors["date"]; ?></div>

            <label for="time">Time</label>
            <input id="time" type="time" name="time" value="<?php if (isset($data["time"])) echo $data["time"]; ?>">
            <div id="time_error" class="errors"><?php if (isset($errors["time"])) echo $errors["time"]; ?></div>

            <label>Category</label>
              <div>
                  <select id="category" name="category_id">
                    <?php foreach ($categories as $category) { ?>
                      <option value="<?= $category->id ?>" <?php if (isset($data["category_id"]) && $data["category_id"] == $category->id)  echo "selected"; ?>>
                      <?= $category->name ?>
                      <?php } ?>
                      </option>
                  </select>
              </div>
              <div id="category_error" class="errors"><?php if (isset($errors["category"])) echo $errors["category"]; ?></div>

              <label>Author</label>
              <div>
                  <select id="author" name="author_id">
                    <?php foreach ($authors as $author) { ?>
                      <option value="<?= $author->id ?>" <?php if (isset($data["author_id"]) && $data["author_id"] == $author->id)  echo "selected"; ?>>
                      <?= $author->first_name ?> <?= $author->last_name ?>
                      <?php } ?>
                      </option>
                  </select>
              </div>
              <div id="author_error" class="errors"><?php if (isset($errors["author"])) echo $errors["author"]; ?></div>

              <button id="submit_btn" class="button" type="submit" formaction="story_create.php">Create</button>
            <a class="button" href="index.php">Cancel</a>
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
      <script src="js/story_validate.js"></script>
  </body>
</html>
<?php if (isset($_SESSION["data"]) and isset($_SESSION["errors"])) {
    unset($_SESSION["data"]);
    unset($_SESSION["errors"]);
}
?>
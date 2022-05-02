<?php
    require_once 'classes/DBConnector.php';
    require_once 'include/story_validate.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "Proccess request!!";

        // echo "<pre>\$_POST = ";
        // print_r($_POST);
        // echo "</pre>";

        [$story, $errors] = story_validate($_POST);

        if(empty($errors)) {
            try {
                $data = [
                    'headline' => $_POST['headline'],
                    'article' => $_POST['article'],
                    'summary' => $_POST['summary'],
                    'date' => $_POST['date'],
                    'time' => $_POST['time'],
                    'category_id' => $_POST['category_id'],
                    'author_id' => $_POST['author_id']
                ];

                Post::edit('stories', $_POST['id'], $data);

                header("Location: index.php");
            } catch (Exception $e) {
                die ("Exception: " . $e->getMessage());
            }

            // echo "<pre>\$_story = ";
            // print_r($story);
            // echo "</pre>";
        
            // echo "<pre>\$_errors = ";
            // print_r($errors);
            // echo "</pre>";
        }
        
        else {
            session_start();
            $_SESSION["data"] = $story;
            $_SESSION["errors"] = $errors;
            header("Location: story_update_form.php");
        }
    }

    else {
        http_response_code(405);
    }
?>
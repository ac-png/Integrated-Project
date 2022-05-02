<?php
    require_once 'classes/DBConnector.php';
    require_once 'include/author_validate.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "Proccess request!!";

        // echo "<pre>\$_POST = ";
        // print_r($_POST);
        // echo "</pre>";

        [$story, $errors] = author_validate($_POST);

        if(empty($errors)) {
            try {
                $data = [
                    'first_name' => $_POST['fname'],
                    'last_name' => $_POST['lname'],
                    'link' => $_POST['link']
                ];

                Post::create('authors', $data);

                header("Location: author_view_all.php");
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
            header("Location: author_create_form.php");
        }
    }

    else {
        http_response_code(405);
    }
?>
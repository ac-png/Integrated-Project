<?php
    require_once 'classes/DBConnector.php';
    require_once 'include/author_validate.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "Proccess request!!";

        // echo "<pre>\$_POST = ";
        // print_r($_POST);
        // echo "</pre>";

        [$author, $errors] = author_validate($_POST);

        if(empty($errors)) {
            try {
                $data = [
                    'first_name' => $_POST['fname'],
                    'last_name' => $_POST['lname'],
                    'link' => $_POST['link']
                ];
                $errors = [];

                Post::edit('authors', $_POST['id'], $data);

                header("Location: author_view_all.php");
            } catch (Exception $e) {
                die ("Exception: " . $e->getMessage());
            }

            // echo "<pre>\$_author = ";
            // print_r($author);
            // echo "</pre>";
        
            // echo "<pre>\$_errors = ";
            // print_r($errors);
            // echo "</pre>";
        }
        
        else {
            session_start();
            $_SESSION["data"] = $author;
            $_SESSION["errors"] = $errors;
            header("Location: author_update_form.php");
        }
    }

    else {
        http_response_code(405);
    }
?>
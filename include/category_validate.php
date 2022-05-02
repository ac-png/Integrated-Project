<?php
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    function validate_name($name) {
        $pattern = "/^[a-zA-Z-' ]*$/";
        return preg_match($pattern, $name) === 1;
    }

    function category_validate($data) {
        $errors = [];
        $story = [];

        //-----------------------------------------------------------------
        // validate first name
        //-----------------------------------------------------------------
        if (empty($data["name"])) {
            $errors["name"] = "The first name field is required.";
        }
        else {
            $story["name"] = sanitize_input($data["name"]);
            if (!validate_name($story["name"])) {
                $errors["name"] = "Only letters and white spaces are allowed.";
            }
        }

        return [
            $story,
            $errors
        ];
    }
?>
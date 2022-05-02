<?php
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    function validate_fname($fname) {
        $pattern = "/^[a-zA-Z-' ]*$/";
        return preg_match($pattern, $fname) === 1;
    }

    function validate_lname($lname) {
        $pattern = "/^[a-zA-Z-' ]*$/";
        return preg_match($pattern, $lname) === 1;
    }

    function author_validate($data) {
        $errors = [];
        $story = [];

        //-----------------------------------------------------------------
        // validate first name
        //-----------------------------------------------------------------
        if (empty($data["fname"])) {
            $errors["fname"] = "The first name field is required.";
        }
        else {
            $story["fname"] = sanitize_input($data["fname"]);
            if (!validate_fname($story["fname"])) {
                $errors["fname"] = "Only letters and white spaces are allowed.";
            }
        }

        //-----------------------------------------------------------------
        // validate last name
        //-----------------------------------------------------------------
        if (empty($data["lname"])) {
            $errors["lname"] = "The last name field is required.";
        }
        else {
            $story["lname"] = sanitize_input($data["lname"]);
            if (!validate_lname($story["lname"])) {
                $errors["lname"] = "Only letters and white spaces are allowed.";
            }
        }

        //-----------------------------------------------------------------
        // validate link
        //-----------------------------------------------------------------
        if (empty($data["link"])) {
            $errors["link"] = "The link field is required.";
        }
        else {
            $story["link"] = sanitize_input($data["link"]);
        }

        return [
            $story,
            $errors
        ];
    }
?>
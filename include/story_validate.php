<?php
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    function validate_date($date) {
        $pattern = '/^([0-9]{4})\\-([0-9]{2})\\-([0-9]{2})$/';
        $matches = array();
        $valid = (preg_match($pattern, $date, $matches) === 1);
        if ($valid) {
            $valid = (checkdate($matches[2], $matches[3], $matches[1]));
        }
        return $valid;
    }

    function validate_time($time) {
        $pattern = "/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/";
        return preg_match($pattern, $time) === 1;
    }

    function story_validate($data) {
        $errors = [];
        $story = [];

        //-----------------------------------------------------------------
        // validate headline
        //-----------------------------------------------------------------
        if (empty($data["headline"])) {
            $errors["headline"] = "The headline field is required.";
        }
        else {
            $story["headline"] = sanitize_input($data["headline"]);
        }

        //-----------------------------------------------------------------
        // validate author
        //-----------------------------------------------------------------
        if (empty($data["author_id"])) {
            $errors["author"] = "The author is required.";
        }
        else {
            $story["author_id"] = sanitize_input($data["author_id"]);
            }

        //-----------------------------------------------------------------
        // validate summary
        //-----------------------------------------------------------------
        if (empty($data["summary"])) {
            $errors["summary"] = "The summary field is required.";
        }
        else {
            $story["summary"] = sanitize_input($data["summary"]);
        }

        //-----------------------------------------------------------------
        // validate article
        //-----------------------------------------------------------------
        if (empty($data["article"])) {
            $errors["article"] = "The article field is required.";
        }
        else {
            $story["article"] = sanitize_input($data["article"]);
        }

        //-----------------------------------------------------------------
        // validate date
        //-----------------------------------------------------------------
        // if (empty($data["date"])) {
        //     $errors["date"] = "The date field is required.";
        // }
        // else {
        //     $story["date"] = sanitize_input($data["date"]);
        //     if (!validate_date($story["date"])) {
        //         $errors["date"] = "Invalid date format.";
        //     }
        // }

        //-----------------------------------------------------------------
        // validate category
        //-----------------------------------------------------------------
        if (empty($data["category_id"])) {
            $errors["category"] = "The category is required.";
        }
        else {
            $story["category_id"] = sanitize_input($data["category_id"]);
            }

        //-----------------------------------------------------------------
        // validate time
        //-----------------------------------------------------------------
        if (empty($data["time"])) {
            $errors["time"] = "The time field is required.";
        }
        else {
            $story["time"] = sanitize_input($data["time"]);
            if (!validate_time($story["time"])) {
                $errors["time"] = "Invalid time format.";
            }
        }

        return [
            $story,
            $errors
        ];
    }
?>
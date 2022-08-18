<?php

/**
 * Validate the request by conditionally redirecting the user.
 * @TODO: Replace all `true` values with your logic on lines 10-12
 *      Line 10: the http request type is POST
 *      Line 11: the submit button doesn't match the value in index.html
 *      Line 12: $_POST['tv-show'] contains a meaningful value (not null, is alphanumeric, no HTML/script/SQL)
 */
$is_post_request = $_SERVER['REQUEST_METHOD'] == 'POST';
$is_expected_submission_action = $_POST['submit'] == 'Save to database';
$input_data = trim($_POST['tv-show']);
$has_valid_data = $input_data && isAlphanumeric($input_data) && !isHtml($input_data);

// Using Regex to check if the input is alphanumeric or ".", ",", "'", "-", "!", "?"
function isAlphanumeric($data) {
    return preg_match('/^[a-z 0-9 .,!?\'\-]+$/i',$data);
}

// Using Regex to check if the input contains HTML tags
function isHtml($data) {
    return preg_match("/<[^<]+>/",$data,$m) != 0;
}

$valid = $is_post_request && $is_expected_submission_action && $has_valid_data;

if (!$valid) {
    header('Location: /index.html') && die();
} else {
    /**
     * Save validated $_POST['tv-show'] value to the database.
     * Table schema for reference: create table `tv_shows` (`name` VARCHAR(20) primary key unique not null, `count` int not null default 0);
     * @TODO: Insert validated submission data into the `tv_shows` table on line 26
     *      Optionally use a try catch block, and display error messages to the user.
     *      Optionally increment the show `count` if the name is already stored.
     */
    $pdo = new \PDO('sqlite:tv_shows.db');
    
    // Check if the TV show name exists
    $result = $pdo->query("select `count` from tv_shows where `name`='$input_data'")->fetch();
    
    // If the TV show exists, then increment the count of the existing row, otherwise insert a new row.
    if ($result) {
        $new_count = $result['count'] + 1;
        try {
            $pdo->query("update tv_shows set `count` = $new_count where `name`='$input_data';");
            echo 'Updated count of <i>' . $input_data . '</i><br>------------------------------------------------';
        } catch (Exception $error) {
            echo 'Message: ' . $error->getMessage();
        }
    } else {
        try {
            $pdo->query("insert into tv_shows (`name`) values ('$input_data');");
            echo 'Inserted new TV show <i>' . $input_data . '</i><br>------------------------------------------------';
        } catch (Exception $error) {
            echo 'Message: ' . $error->getMessage();
        }
    }
    
    /**
     * Display stored data, four entries were inititally provided.
     * No need to modify.
     */
    foreach ($pdo->query("select `name`, `count` from tv_shows") as $row) {
        echo '<li>' . $row['name'] . ' (' . $row['count'] . ')</li>';
    }
    
    /**
     * @TODO: Provide user with appropriate feedback.
     */
    die('<h4>Thank you for your submission. <a href="/index.html">Submit more TV shows.</a></h4>');
}



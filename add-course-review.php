<?php
/**
 * add-course-review.php
 * Script to authenticate and add course review to the database.
 * Users will be allowed to add multiple reviews for a course as long as
 * the professors associated with the reviews are different.
 */
include_once('db_connect.php');
session_start();
$userID = $_SESSION['user_id'];
$courseID = $_POST['courseID'];
$profID = $_POST['profID'];
$result = $db->prepare("SELECT * FROM course_review WHERE user_id=? AND course_id=? AND course_review.prof_id=?;");
$result->execute(array($userID, $courseID, $profID,));
if ($result->rowCount() > 0) {
    $_SESSION['courseID'] = $_POST['courseID'];
    $_SESSION['add-failed'] = true;
    $_SESSION['profID'] = $_POST['profID'];
    $_SESSION['easiness'] = $_POST['easiness'];
    $_SESSION['textbook_required'] = array_key_exists('textbook_required', $_POST) ? $_POST['textbook_required'] : 'off';
    $_SESSION['course_review'] = $_POST['course_review'];
    $_SESSION['helpfulness'] = $_POST['helpfulness'];
    $_SESSION['tips'] = $_POST['tips'];
    $_SESSION['overall_rating'] = $_POST['overall_rating'];
    echo $_SESSION['textbook_required'];
    header("Location:course-review.php");
} else {
    $easiness = $_POST['easiness'];
    $textbookRequired = array_key_exists('textbook_required', $_POST) ? $_POST['textbook_required'] : 'off';
    $textbookRequired = $textbookRequired == 'on' ? 1 : 0;
    $review = $_POST['course_review'];
    $usefulness = $_POST['helpfulness'];
    $tips = $_POST['tips'];
    $overallRating = $_POST['overall_rating'];
    $query = $db->prepare("INSERT INTO course_review VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?);");
    $query->execute(array($userID, $courseID, $profID, $easiness, $textbookRequired, $review, $usefulness, $tips, $overallRating));
    $_SESSION['review_added'] = true;
    header("Location:course.php?id=$courseID");
}
?>
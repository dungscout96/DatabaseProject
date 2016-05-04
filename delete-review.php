<?php
/**
 * Author: Dung Truong
 * Date: 4/30/16
 * Time: 9:25 PM
 */

include_once('db_connect.php');
session_start();
$user_id = $_POST['userID'];
$course_id = $_POST['courseID'];
$prof_id = $_POST['profID'];

if (array_key_exists('deleteProfReview', $_POST)) {
    $query = "DELETE FROM prof_review WHERE user_id=? AND prof_id=? AND course_id=?;";
    $query = $db->prepare($query);
    $result = $query->execute(array($user_id, $prof_id, $course_id));

}
else if (array_key_exists('deleteCourseReview', $_POST)) {
    $query = "DELETE FROM course_review WHERE user_id=? AND prof_id=? AND course_id=?;";
    $query = $db->prepare($query);
    $result = $query->execute(array($user_id, $prof_id, $course_id));
}


$_SESSION['delete-success'] = true;
header("Location:profile.php");
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
	echo '<script language="javascript">
	alert("Please login to review a course or professor");
	window.location.href = "login.html";
	</script>';
}
?>

<html>
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">
<link rel="stylesheet" type="text/css" href="mystyle.css">
<title>Professor Review</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
//  Check Radio-box
    $(".rating input:radio").attr("checked", false);
    $('.rating input').click(function () {
        $(".rating span").removeClass('checked');
        $(this).parent().addClass('checked');
    });

    $('input:radio').change(
    function(){
        var userRating = this.value;
    }); 
});
</script>


</head>
<body>

<h1 style="text-align: center">Professor Review</h1>
<form id='profReview' method='POST' action='add_professor_review.php' accept-charset="UTF-8">
<!--<input type="hidden" name="profID">
<input type="hidden" name="courseID">-->
<table style="float:center">
	<tr> 
		<td><button type="button" id='usePrev'>Use previous information</button></td>
		<td><input type="reset" value="clear all" /></td>
	</tr>
	<tr>
		<td><input type='text' name='college' placeholder="College Name"></td>
		
		<td><input type='text' name='department' placeholder='Department'></td>
	</tr>
	<tr>
		<td><input type='text' name='professor' placeholder="Professor Name"></td>
		<td><input type='text' name='course' placeholder="Course taken"></td>
	</tr>
	<tr>
		<td><p>Easiness:</p></td>
		<td></td>
		<!--<td><div w3-include-html="star_rating.html"></div> <script src="include-HTML.js"></script> </td>-->
	</tr>
	<tr>
		<td><p>Helpfulness:</p></td>
		<td></td>
		<!--<td><div w3-include-html="star_rating.html"></div> <script src="include-HTML.js"></script> </td>-->
	</tr>
	<tr>
		<td><p>Clarity:</p></td>
		<td></td>
		<!--<td><div w3-include-html="star_rating.html"></div> <script src="include-HTML.js"></script> </td>-->
	</tr>
</table>

<table>	
	<tr>
		<td><textarea rows=10 cols=50 form='profReview' name="professorReview" placeholder="Professor Review"></textarea></td>	
	</tr>
	<tr>
		<td><p>Overall Rating:</p></td>
<td></td>
		<!--<td><div w3-include-html="star_rating.html"></div> <script src="include-HTML.js"></script> </td>-->
	</tr>
</table>

<br>
<input type='submit' value='Submit'>
</form>

<a href="logout.php">Logout</a>
<script>
document.getElementById("usePrev").addEventListener("click", function(){
	if (sessionStorage.getItem('professor') != null) {
		var college = sessionStorage.getItem('college');
		var dept = sessionStorage.getItem('department');
		var course = sessionStorage.getItem('course');
		var prof = sessionStorage.getItem('professor');
		var profID = sessionStorage.getItem('profID');
		var courseID = sessionStorage.getItem('courseID');
		//console.log(document.getElementById("profReview")["college"].value);
		//console.log(college);
	
		document.getElementById("profReview").elements["college"].value = college;
		document.getElementById("profReview").elements["department"].value = dept;
		document.getElementById("profReview").elements["course"].value = course;
		document.getElementById("profReview").elements["professor"].value = prof;
		document.getElementById("profReview").elements["profID"].value = profID;
		document.getElementById("profReview").elements["courseID"].value = courseID;
	}
});

</script>
</body>
</html>


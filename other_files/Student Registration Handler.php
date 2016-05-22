Student_Registration_handler.php 

<?php 
include 'Connect.php'; 
$flag = "success"; 
function rollbackData(){ 
mysql_query(" ROLLBACK "); 
global $flag; 
$flag = "error"; 
if(mysql_error() != null){ 
die(mysql_error()); 
} 
} 
$student_id = $_POST['st_id']; 
$student_pass = $_POST['st_pass']; 
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name']; $gender = $_POST['gender']; $contact_no = 
$_POST['contact_no']; $qualification = $_POST['qualification']; $city = 
$_POST['city']; 
$email1 = $_POST['email1']; $email2 = 
$_POST['email2']; $address = 
$_POST['address']; $description = 
$_POST['description']; $resumename = ""; 
$imagename = ""; 
$dobdate = date("Y-m-d",strtotime($_POST['dob'])); 

/* This block is used to check whether the student_id already exits in the database. */ 
$select_query="select student_id from student_information where student_id = '$student_id'"; 
$result_set = mysql_query($select_query,$link_id); 

if($row = mysql_fetch_array($result_set)) 
{ $flag="exists"; 
header("location:Student_login.php? 
flag=$flag&student_id=$student_id"); 
die(); 
} 
else
{ 
/* This block is used to insert the student record into the database if the student_id is not already present in the database. */ 
mysql_query("SET AUTOCOMMIT = 0 "); 
if(mysql_error() != null){ 
die(mysql_error());
} 
$query = "insert into 
student_information(student_id,student_password,first_name,last_name,registration_date,gender,date_of_birth,"; 
$query .= "student_status,contact_no,qualification,city,email1,email2,address,description)"; 
$query .= " values('$student_id','$student_pass','$first_name','$last_name',now(),'$gender ','$dobdate','Disable','$contact_no',"; 
$query .= "'$qualification','$city','$email1','$email2','$address','$description')"; 
$result = mysql_query($query,$link_id); 

if(mysql_error() != null)
{ 
die(mysql_error()); 
} 
if($result)
{ 
if($_FILES['resume']['name'] != "")
{ 
$filename = $_FILES['resume']['name']; 
$ext = strrchr($filename,"."); 
$resumename = $student_id; 
$resumename .= "_".$filename; 

if($ext ==".txt" || $ext ==".doc" || $ext ==".TXT" || $ext ==".DOC" || $ext ==".pdf" || $ext ==".PDF")
{ 
$size = $_FILES['resume']['size']; 
if($size > 0 && $size < 1000000){ 
$archive_dir = "resumes"; 
$userfile_tmp_name = 
$_FILES['resume']['tmp_name']; 
if(move_uploaded_file($userfile_tmp_name, "$archive_dir/ $resumename")){

/* if image is successfully uploaded then resumename is stored in database. */ 
mysql_query("update student_information set resume='$resumename' where student_id='$student_id'", $link_id); 
if(mysql_error() != null) 
{ die(mysql_error() ); 
} 
$flag = "success"; 
}
else{ 
rollbackData(); 
} 
} else{ 
rollbackData(); 
die("You can upload resume of 1 MB size only. Please, try again."); 
} 
} 
else{ rollbackData(); 
die("You can upload resume of .txt, .pdf, .doc extensions only. Please, try again."); 
} 
} 
if($_FILES['image']['name'] != ""){ 
$filename = $_FILES['image']['name']; 
$ext = strrchr($filename,"."); 
$imagename = $student_id; 
$imagename .="_". $filename; 
if($ext ==".jpg" || $ext ==".jpeg" || $ext ==".JPG" || 
$ext ==".JPEG" || $ext ==".gif" || $ext ==".GIF"){
$size = $_FILES['image']['size']; if($size > 0 && $size < 1000000){ 
$archive_dir = "images"; 
$userfile_tmp_name = 
$_FILES['image']['tmp_name']; 
if(move_uploaded_file($userfile_tmp_name, "$archive_dir/ $imagename")){ 

/* if image is successfully uploaded then imagename is stored in database. */ 
mysql_query("update student_information set image='$imagename' where student_id='$student_id'", $link_id); 
$flag = "success"; 
if(mysql_error()!=null){ 
die(mysql_error()); 
} 
} else{ 
if(file_exists('resumes/' . $resumename)) { 
unlink('resumes/' . $resumename); 
} 
rollbackData(); 
} 
} 
else{ 
if(file_exists('resumes/' . $resumename)) { 
unlink('resumes/' . $resumename);
} 
rollbackData(); 
die("You can upload image of 1 MB size only. Please, try again."); 
} 
} 
else{ 
if(file_exists('resumes/' . $resumename)) { 
unlink('resumes/' . $resumename); 
} 
rollbackData(); 
die("You can upload images of .jpg, .jpeg, .gif extensions only. Please, try again. "); 
} 
} 
} 
else{ 
$flag="error"; 
} 
if($flag == "success") 
{ mysql_query(" COMMIT "); 
$flag="success"; 
if(mysql_error() != null){ 
die(mysql_error()); 
} 
/* This block is used to send email to the successfully registered users. */ 
/* $to = $email1; $subject = 'Congratulations'; 
$message = 'Congratulations you are registered in our site.rnrn';
$message .= "Your Login Id : $student_id rn Password : 
$student_pass"; 
$headers = "From: info@sims.comrn"; 
$headers .= 'X-Mailer: PHP' . phpversion(); 
mail($to, $subject, $message, $headers); */ 
} 
header("location:Student_login.php?flag=$flag"); 
die(); 
} 
?> 


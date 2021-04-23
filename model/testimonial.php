<?php
//Validation
if($_SERVER['REQUEST_METHOD']!=='POST'){
    header('Status: 400');exit();
}
header('Status: 200');
if(!isset($_POST['fullname']) OR !isset($_POST['email']) OR !isset($_POST['address']) OR !isset($_POST['number'])){
    echo '{"status":"required"}';exit();
}
//Sanitizing
$name = htmlspecialchars($_POST['fullname'],ENT_QUOTES);
$email = htmlspecialchars($_POST['email'],ENT_QUOTES);
$address= htmlspecialchars($_POST['address'],ENT_QUOTES);
$number = htmlspecialchars($_POST['number'],ENT_QUOTES);
if(!preg_match('/^[0-9]{10}+$/', $number)){
    echo '{"status":"invalid_number"}';exit();
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '{"status":"invalid_email"}';exit();
}
//Validating Complete
require_once '../core/conn.php';
// Preventing MySQL INjection
$query = $conn->prepare("INSERT INTO testimonial (fullname, email, number, address) VALUES (?,?,?,?)");
$query->bind_param("ssis",$name,$email,$number,$address);
$success=1;
if(!$query->execute()){
    $success=0;
}
$query->close();
// Closing Connection
mysqli_close($conn);
if($success){
    echo '{"status":"success"}';
}else{
    echo '{"status":"error"}';
}

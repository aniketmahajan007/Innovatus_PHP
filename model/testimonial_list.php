<?php
header('Status: 200');
require_once '../core/conn.php';
$query = $conn->prepare("SELECT sno,fullname,email,number,address FROM testimonial");
if(!$query->execute()){
    echo '{"status":"error"}';
    $query->close();
    exit();
}
$fetch=[];
$query->bind_result($fetch['sno'],$fetch['full_name'],$fetch['email'],$fetch['number'],$fetch['address']);
$result=[];
while($query->fetch()){
    $result[] = array('sno'=>$fetch['sno'],'fullname'=>$fetch['full_name'],'email'=>$fetch['email'],'number'=>$fetch['number'],'address'=>$fetch['address']);
}
$query->close();
echo json_encode($result);

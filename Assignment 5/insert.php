<?php
$textnames = $_POST['textnames'];
$sex = $_POST['sex'];
$course = $_POST['course'];
$personaladdress = $_POST['personaladdress'];
$state = $_POST['state'];
$pincode = $_POST['pincode'];
$personcategory = $_POST['personcategory'];
$emailid = $_POST['emailid'];
$dob = $_POST['dob'];
$mobileno = $_POST['mobileno'];

if (!empty($textnames) || !empty($sex) || !empty($course) || !empty($personaladdress) || !empty($state) || !empty($pincode) || !empty($personcategory) || !empty($emailid) || !empty($dob) || !empty($mobileno)) {
 $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname =" jLWcwDkrOn";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT emailid From register Where emailid = ? Limit 1";
     $INSERT = "INSERT Into register (textnames,sex,course,personaladdress,state,pincode,personcategory,emailid,dob,mobileno) values(?, ?, ?, ?, ?, ?,?,?,?,?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $emailid);
     $stmt->execute();
     $stmt->bind_result($emailid);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssii", $textnames, $sex, $course, $personaladdress, $state, $pincode,$personcategory,$emailid,$dob,$mobileno);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
  
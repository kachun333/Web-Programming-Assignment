<?php 
    include '../session.php';
    include '../config.php';
   
    
    if(isset($_POST['edit'])){
        $id = $_POST["memberId"];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $nophone = $_POST['nophone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        


        $sql = "UPDATE members SET FirstName='$fname', LastName ='$lname', PhoneNumber='$nophone',Email='$email', MemberAddress='$address' WHERE MemberID=$id";
        mysqli_query($conn, $sql);

        header("Location:member.php?memberId=$id");
    }
?>
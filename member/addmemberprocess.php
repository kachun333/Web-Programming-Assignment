<?php 

    include '../config.php';

    if(isset($_POST['addMember'])){
        $fname = addslashes($_POST['fname']);
        $lname = addslashes($_POST['lname']);
        $nophone = $_POST['nophone'];
        $email = $_POST['email'];
        $address = addslashes($_POST['address']);
        $userid = '1';
    
        echo $fname." ".$lname;

        $sql = "INSERT INTO members (FirstName,LastName,PhoneNumber,Email,MemberAddress,UserID,Photo) 
        VALUES ('$fname','$lname','$nophone','$email','$address','$userid','olalalalala')" ; 
        mysqli_query($conn, $sql);

        echo "Done";
        //header("Location:member.php");
    }
?>
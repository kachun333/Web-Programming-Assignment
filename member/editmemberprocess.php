<?php 

    include '../config.php';
    $id = '2';
    if(isset($_POST['edit'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $nophone = $_POST['nophone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        


        $sql = "UPDATE members SET FirstName='$fname', LastName ='$lname', PhoneNumber='$nophone',Email='$email', MemberAddress='$address' WHERE MemberID=$id";
        mysqli_query($conn, $sql);

        header("Location:member.php?id=$id");
    }
?>
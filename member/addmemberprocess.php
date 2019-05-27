<?php 
    include '../session.php';
    include '../config.php';

    
    if(isset($_POST['addMember'])){
        /*Photo*/
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError= $file['error'];
        $fileType = $file['type'];

        $fileExt = explode('.',$fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

       
        /*Details */
        $fname = addslashes($_POST['fname']);
        $lname = addslashes($_POST['lname']);
        $nophone = $_POST['nophone'];
        $email = $_POST['email'];
        $address = addslashes($_POST['address']);
        $id = $_SESSION["UserID"];
        $count = 0;
        $query = "SELECT FirstName, LastName, PhoneNumber, Email, UserID FROM members WHERE PhoneNumber = '$nophone' OR Email = '$email'";
        $record = mysqli_query($conn,$query);

        while($row = mysqli_fetch_assoc($record)){
            if($row["UserID"] == $id){
                $count+=1;
            }
        }

        if($count>0){
            echo '<script type="text/javascript">'; 
            echo 'alert("The member is existed");'; 
            echo 'window.location.href = "member.php";';
            echo '</script>';
        }else{
            if($file){
                $sql = "INSERT INTO members (FirstName,LastName,PhoneNumber,Email,MemberAddress,UserID) 
                VALUES ('$fname','$lname','$nophone','$email','$address','$id')" ; 
                mysqli_query($conn, $sql);
                echo "Done";
                header("Location:member.php");
            }else{
                if(in_array($fileActualExt,$allowed)){
                    if ($fileError === 0){
                        if($fileSize < 500000){
                            $fileNameNew = uniqid('', true).".".$fileActualExt;
                            $fileDestination = '../uploads/'.$fileNameNew;
                            move_uploaded_file($fileTmpName,$fileDestination);
        
                            $sql = "INSERT INTO members (FirstName,LastName,PhoneNumber,Email,MemberAddress,UserID,Photo) 
                            VALUES ('$fname','$lname','$nophone','$email','$address','$id','$fileDestination')" ; 
                            mysqli_query($conn, $sql);
                            echo "Done";
                            header("Location:member.php");
                        }else{
                            echo '<script type="text/javascript">'; 
                            echo 'alert("Your file size is too big");'; 
                            echo 'window.location.href = window.history.back();';
                            echo '</script>';
                        }
                    }else{
                        echo '<script type="text/javascript">'; 
                        echo 'alert("There was an error uploading your file!");'; 
                        echo 'window.location.href = window.history.back();';
                        echo '</script>';
                    }
                }else{
                    echo '<script type="text/javascript">'; 
                    echo 'alert("You cannot upload the file");'; 
                    echo 'window.location.href = window.history.back();';
                    echo '</script>';
                }
            }      
        }
        mysqli_close($conn);
    }

        

       
?>
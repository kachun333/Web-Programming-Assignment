<?php 
    include '../config.php';

    $id = '2';
    //$_GET['memberId']
    $sql = "SELECT FirstName, LastName, PhoneNumber,Email,MemberAddress FROM members WHERE MemberID = $id";
    $data = mysqli_query($conn,$sql);
    $result = mysqli_fetch_assoc($data);

    $fname = $result['FirstName'];
    $lname = $result['LastName'];
    $nophone = $result['PhoneNumber'];
    $email = $result['Email'];
    $address = $result['MemberAddress'];
    
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="media/Bilbio_icon.png">
    <title>Dashboard - Biblio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../biblio.css">

</head>

<body>

    <?php include '../header.php'?>

    <main class="container">
        <form id="editinfo" method="POST" action="editmemberprocess.php">
            <table class="table2">
                <tr>
                    <td class="table-attr">First Name</td>
                    <td><input name="fname" class="form-control" type=text value="<?php echo $fname;?>"></td>
                </tr>
                <tr>
                    <td class="table-attr">Last Name</td>
                    <td><input name="lname" class="form-control" type=text value="<?php echo $lname;?>"></td>
                </tr>
                <tr>
                    <td class="table-attr">Phone Number</td>
                    <td><input name="nophone" class="form-control" type=text value="<?php echo $nophone;?>"></td>
                </tr>
                <tr>
                    <td class="table-attr">Email</td>
                    <td><input name="email" class="form-control" type=text value="<?php echo $email;?>"></td>
                </tr>
                <tr>
                    <td class="table-attr">Address</td>
                    <td><input name="address" class="form-control" type=longtext value="<?php echo $address;?>"></td>
                </tr>  
            </table>
            <br>
            <button name="edit" class="edit-btn" id="edit" type="submit" value="Done">Done</button>
        </form>
    </main>

</body>

</html>
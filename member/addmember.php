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

    <main class="container-fluid">
        <h3 align="center"><em>Register Members</em></h3>
        <br>
        <form method="POST" action="addmemberprocess.php">
            <div class="container-fluid">
                
                <div class="form-group form-row justify-content-center">
                    <label for="fname" class="col-2 col-form-label">First Name</label>
                    <div class="col-3">
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name">
                    </div>
                </div>
                <div class="form-group form-row justify-content-center">
                    <label for="lname" class="col-2 col-form-label">Last Name</label>
                    <div class="col-3">
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name">
                    </div>
                </div>
                <div class="form-group form-row justify-content-center">
                    <label for="nophone" class="col-2 col-form-label">Phone Number</label>
                    <div class="col-3">
                        <input type="text" class="form-control" id="nophone" name="nophone" placeholder="Phone Number">
                    </div>
                </div>
                <div class="form-group form-row justify-content-center">
                    <label for="email" class="col-2 col-form-label">Email</label>
                    <div class="col-3">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="form-group form-row justify-content-center">
                    <label for="address" class="col-2 col-form-label">Address</label>
                    <div class="col-3">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Home Address">
                    </div>
                </div>
                <br>
                <div class="form-group form-row justify-content-center">
                    <button type="submit" name="addMember" class="btn btn-danger">Submit</button>
                </div>
            </div><br>
        </form>
    </main>
    <footer class="text-center font-italic">
        <hr>
        Copyright &copy 2019 Biblio.com<br>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="bookSearchJS.js"></script>
</body>

</html>
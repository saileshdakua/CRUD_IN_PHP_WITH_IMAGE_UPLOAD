<?php
session_start();
if(!isset($_SESSION['id'])){
    header('location:login.php');
}


// Check if the logged-in user's ID matches the profile user's ID
// Allow access for admin user
if ($_SESSION['role'] != 'admin') {
    // echo "Access denied. You are not authorized to view this page.";
    header("Location: index.php");
    exit();
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Student Create</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student Registration 
                            <span class="float-end">
                            <a href="<?php echo ($_SESSION['role'] == 'admin') ? 'admin_index.php' : 'index.php'; ?>" class="btn btn-warning">BACK</a>

                            <a href="logout.php" class="btn btn-danger">Logout</a>
                            </span>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="code.php" onsubmit="validate()">
                        <div class="row g-3">
                        <div class="form-group col-md-6">
                            <label for="fname">First Name:</label>
                            <input id="fname" type="text" class="form-control" name="fname" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="lname">Last Name:</label>
                            <input id="lname" type="text" class="form-control" name="lname" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email">Email:</label>
                            <input id="email" type="email" class="form-control" name="email" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="phno">Phone:</label>
                            <input id="phno" type="number" class="form-control" name="phone" required>
                        </div>

                        <div class="form-group col-md-3 mt-4">
                            <label>Gender:</label>
                            <div class="form-check-inline">
                                <input type="radio" class="form-check-input" id="male" name="gender" value="Male">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check-inline">
                                <input type="radio" class="form-check-input" id="female" name="gender" value="Female">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <div class="form-check-inline">
                                <input type="radio" class="form-check-input" id="other" name="gender" value="Other">
                                <label class="form-check-label" for="other">Other</label>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="pimage">Profile Image:</label>
                            <input id="pimage" type="file" class="form-control col-md-6" name="pimage" accept="image/png, image/jpeg">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="dob">Date Of Birth:</label>
                            <input id="dob" type="date" class="form-control" name="dob" required>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="course">Select your Course:</label>
                            <select class="form-control form-select" name="course" id="course">
                                <option value="">Select Here</option>
                                <option value="B.Tech">B.Tech</option>
                                <option value="BSC">BSC</option>
                                <option value="BA">BA</option>
                                <option value="BCA">BCA</option>
                                <option value="Diploma">Diploma</option>
                                <option value="MSC">MSC</option>
                                <option value="M.Tech">M.Tech</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="address">Address:</label>
                            <textarea id="address" class="form-control" name="address" rows="4" cols="50"></textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="password">Password:</label>
                            <input id="password" type="password" class="form-control" name="password" minlength="3" maxlength="8">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="password_cnf">Confirm Password:</label>
                            <input id="password_cnf" type="password" class="form-control" name="password_cnf" minlength="3" maxlength="8">
                        </div>

                        <div class="form-group col-md-12">
                            <input type="checkbox" id="chk" name="condition_1" value="yes" class="form-check-input">
                            <label for="chk" class="form-check-label">Agree</label>
                        </div>

                        <div class="col-md-12 mb-4 text-center">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-primary" name="save_student">Submit</button>
                        </div>

                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

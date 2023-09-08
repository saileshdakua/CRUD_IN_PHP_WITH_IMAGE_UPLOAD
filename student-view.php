<?php
require 'dbcon.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Student View</title>
</head>
<body>

    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student View Details 
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id']))
                        {
                            $student_id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM students WHERE id='$student_id' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $student = mysqli_fetch_array($query_run);
                                ?>
                                
                                    <div class="row g-3">
                                    <div class="form-group col-md-6">
                                        <label for="fname">First Name:</label>
                                        <p class="form-control">
                                            <?=$student['fname'];?>
                                        </p>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="lname">Last Name:</label>
                                        <p class="form-control">
                                            <?=$student['lname'];?>
                                        </p>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="email">Email:</label>
                                        <p class="form-control">
                                            <?=$student['email'];?>
                                        </p>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="phno">Phone:</label>
                                        <p class="form-control">
                                            <?=$student['phone'];?>
                                        </p>
                                    </div>

                                    <div class="form-group col-md-3 mt-4">
                                        <label>Gender:</label>
                                        <p class="form-control">
                                            <?=$student['gender'];?>
                                        </p>
                                    </div>

                                    <div class="form-group col-md-3">
                                    <label for="pimage">Profile Image:</label>
                                    <?php
                                        $profileImage = $student['pimage'];
                                        if (!empty($profileImage) && file_exists("uploads/$profileImage")) {
                                            ?>
                                            <img src="uploads/<?= $profileImage; ?>"
                                                 alt="<?= $student['fname']; ?>"
                                                 width="100" height="100"
                                                 class="rounded-circle">
                                            <?php
                                        } else {
                                            ?>
                                            <img src="uploads/download (1).png"
                                                 alt="User Image"
                                                 width="100" height="100"
                                                 class="rounded-circle">
                                            <?php
                                        }
                                    ?>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="dob">Date Of Birth:</label>
                                        <p class="form-control">
                                            <?=$student['dob'];?>
                                        </p>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="course">Select your Course:</label>
                                        <p class="form-control">
                                            <?=$student['course'];?>
                                        </p>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="address">Address:</label>
                                        <p class="form-control">
                                            <?=$student['address'];?>
                                    </p>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="password">Password:</label>
                                        <p class="form-control">
                                            <?=$student['password'];?>
                                        </p>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="password_cnf">Confirm Password:</label>
                                        <p class="form-control">
                                            <?=$student['password_cnf'];?>
                                        </p>
                                    </div>
                                    <div class="col-md-12 mb-4 text-center">
                                    <a type="button" class="btn btn-success" href="student-edit.php?id=<?= $student['id']; ?>"
                                    class="btn btn-success btn-sm">Update</a>
                                    </div>



                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
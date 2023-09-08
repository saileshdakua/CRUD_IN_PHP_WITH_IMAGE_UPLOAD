<?php
session_start();
require 'dbcon.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Student Edit</title>
</head>
<body>

<div class="container mt-5">

    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Student Edit 
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
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="student_id" value="<?= $student['id']; ?>">

                                <div class="row g-3">
                                    <div class="form-group col-md-6">
                                        <label for="fname">First Name:</label>
                                        <input id="fname" type="text" class="form-control" name="fname" value="<?=$student['fname'];?>">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="lname">Last Name:</label>
                                        <input id="lname" type="text" class="form-control" name="lname" value="<?=$student['lname'];?>">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="email">Email:</label>
                                        <input id="email" type="email" class="form-control" name="email" value="<?=$student['email'];?>">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="phno">Phone:</label>
                                        <input id="phno" type="number" class="form-control" name="phone" value="<?=$student['phone'];?>">
                                    </div>

                                    <div class="form-group col-md-3 mt-4">
                                        <label>Gender:</label>
                                        <div class="form-check-inline">
                                            <input type="radio" class="form-check-input" id="male" name="gender" value="Male" <?=$student['gender'] == 'Male' ? 'checked' : '';?>>
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input type="radio" class="form-check-input" id="female" name="gender" value="Female" <?=$student['gender'] == 'Female' ? 'checked' : '';?>>
                                            <label class="form-check-label" for="female">Female</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input type="radio" class="form-check-input" id="other" name="gender" value="Other" <?=$student['gender'] == 'Other' ? 'checked' : '';?>>
                                            <label class="form-check-label" for="other">Other</label>
                                        </div>
                                    </div>
                                    <?php $profileImage = $student['pimage']; ?>
                                    <div class="form-group col-md-3">
                                        <label for="pimage">Profile Image:</label>
                                        <input id="pimage" type="file" class="form-control col-md-6" name="pimage" accept="image/png, image/jpeg">
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
                                        <input id="dob" type="date" class="form-control" name="dob" value="<?=$student['dob'];?>">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="course">Select your Course:</label>
                                        <select class="form-control form-select" name="course" id="course">
                                            <option value="">Select Here</option>
                                            <option value="B.Tech" <?=$student['course'] == 'B.Tech' ? 'selected' : '';?>>B.Tech</option>
                                            <option value="BSC" <?=$student['course'] == 'BSC' ? 'selected' : '';?>>BSC</option>
                                            <option value="BA" <?=$student['course'] == 'BA' ? 'selected' : '';?>>BA</option>
                                            <option value="BCA" <?=$student['course'] == 'BCA' ? 'selected' : '';?>>BCA</option>
                                            <option value="Diploma" <?=$student['course'] == 'Diploma' ? 'selected' : '';?>>Diploma</option>
                                            <option value="MSC" <?=$student['course'] == 'MSC' ? 'selected' : '';?>>MSC</option>
                                            <option value="M.Tech" <?=$student['course'] == 'M.Tech' ? 'selected' : '';?>>M.Tech</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="address">Address:</label>
                                        <textarea id="address" class="form-control" name="address" rows="4" cols="50"><?=$student['address'];?></textarea>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="password">Password:</label>
                                        <input id="password" type="password" class="form-control" name="password" minlength="3" maxlength="8" value="<?=$student['password'];?>">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="password_cnf">Confirm Password:</label>
                                        <input id="password_cnf" type="password" class="form-control" name="password_cnf" minlength="3" maxlength="8" value="<?=$student['password_cnf'];?>">
                                    </div>

                                    <div class="mb-3 text-center">
                                    <button type="submit" name="update_student" class="btn btn-primary">
                                        Update Student
                                    </button>
                                    </div>

                                </div>

                            </form>
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

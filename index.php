<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location: login.php');
    exit();
}

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

    <title>Student CRUD</title>
</head>
<body>

<div class="container mt-4">
    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Student Details
                        <span class="float-end">
                        <?php
                        if ($_SESSION['role'] == 'admin') {
                            // Show the "Add Students" button only for admin users
                            echo '<a href="student-create.php" class="btn btn-primary">Add Students</a>';
                        }
                        ?>
                        <a href="logout.php" class="btn btn-danger">Logout</a>
                        </span>
                    </h4>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Profile</th>
                                <th>DOB</th>
                                <th>Course</th>
                                <th colspan="3">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $x = 1; ?>
                            <?php
                            // Get the logged-in user's ID
                            $logged_in_user_id = $_SESSION['id'];

                            // Query to select only the records of the logged-in user
                            $query = "SELECT * FROM students WHERE id = $logged_in_user_id";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $student) {
                                    ?>
                                    <tr>
                                        <td><?= $x++ ?></td>
                                        <td><?= $student['fname']; ?>&nbsp;<?= $student['lname']; ?></td>
                                        <td><?= $student['email']; ?></td>
                                        <td><?= $student['phone']; ?></td>
                                        <td>
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
                                        </td>
                                        <td><?= $student['dob']; ?></td>
                                        <td><?= $student['course']; ?></td>
                                        <td>
                                            <a href="student-view.php?id=<?= $student['id']; ?>"
                                               class="btn btn-info btn-sm">View</a>
                                        </td>
                                        <td>
                                            <a href="student-edit.php?id=<?= $student['id']; ?>"
                                               class="btn btn-success btn-sm">Edit</a>
                                        </td>
                                        <td>
                                            <form action="code.php" method="POST" class="d-inline">
                                                <button type="submit" name="delete_student"
                                                        value="<?= $student['id']; ?>"
                                                        class="btn btn-danger btn-sm">Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<h5> No Record Found </h5>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

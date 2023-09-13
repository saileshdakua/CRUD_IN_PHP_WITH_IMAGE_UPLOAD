<?php
session_start();
require 'dbcon.php';

if (isset($_POST['register'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $password_cnf = mysqli_real_escape_string($con, $_POST['password_cnf']);

    // Validation for required fields
    if (empty($email) || empty($password)) {
        $_SESSION['message'] = "Please fill in all required fields.";
        header("Location: register.php");
        exit(0);
    }

    // Password matching validation
    if ($password !== $password_cnf) {
        $_SESSION['message'] = "Passwords do not match.";
        header("Location: register.php");
        exit(0);
    }
    // Check email Already Exist or Not
    $sql = "SELECT * FROM students WHERE email = '$email'";
    $query_run = mysqli_query($con, $sql);

    if (mysqli_num_rows($query_run) > 0) {
        $_SESSION['message'] = "Already Registered, kindly Login";
        header("Location: login.php");
        exit(0);
    } else {
        $query = "INSERT INTO students (email, password, role) 
        VALUES ('$email','$password','user')";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            // Get the ID of the newly inserted record
            $new_student_id = mysqli_insert_id($con);
            $_SESSION['message'] = "Registered Successfully";
            $_SESSION['id'] = $new_student_id;
            $_SESSION['role'] = 'user';
            // Redirect to student-view.php with the new student's ID
            header("Location: student-view.php?id=$new_student_id");
            exit(0);
        } else {
            $_SESSION['message'] = "Something went Wrong!, Kindly Try After Sometimes.";
            header("Location: register.php");
            exit(0);
        }
    }
}


// if (isset($_POST['login'])) {
//     $email = mysqli_real_escape_string($con, $_POST['email']);
//     $password = mysqli_real_escape_string($con, $_POST['password']);

//     // Validation for required fields
//     if (empty($email) || empty($password)) {
//         $_SESSION['message'] = "Please fill in all required fields.";
//         header("Location: register.php");
//         exit(0);
//     }
//     $sql = "select *from students where email = '$email' and password = '$password'"; 
//     $query_run = mysqli_query($con, $sql); 
//     if (mysqli_num_rows($query_run) > 0) {
//         $student = mysqli_fetch_array($query_run);
//         $_SESSION['message'] = "Login Successfully";
//         $_SESSION['id'] = $student['id'];
//         $sid = $student['id'];
//         header("Location: student-view.php?id=$sid");
//         exit(0);
//     }else{
//         $_SESSION['message'] = "Invalid Login Credentials";
//         header("Location: login.php");
//         exit(0);
//     }
    
// }

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Validation for required fields
    if (empty($email) || empty($password)) {
        $_SESSION['message'] = "Please fill in all required fields.";
        header("Location: login.php");
        exit(0);
    }
    $sql = "SELECT * FROM students WHERE email = '$email' and password = '$password'";
    $query_run = mysqli_query($con, $sql);

    if (mysqli_num_rows($query_run) > 0) {
        $user = mysqli_fetch_assoc($query_run);
        
        // Store user information in session
        $_SESSION['id'] = $user['id'];
        $_SESSION['fname'] = $user['fname'];
        $_SESSION['role'] = $user['role']; // Add role to the session

        if ($user['role'] == "admin") {
            // If the user is an admin, redirect to admin_index.php
            $_SESSION['message'] = "Admin Login Successfully";
            header("Location: admin_index.php");
        } else {
            $sid = $user['id'];
            // If the user is not an admin, redirect to student-view.php
            $_SESSION['message'] = "Login Successfully";
            header("Location: student-view.php?id=$sid");
        }
        exit(0);
    } else {
        $_SESSION['message'] = "Invalid Login Credentials";
        header("Location: login.php");
        exit(0);
    }
}


if(isset($_POST['delete_student']))
{
    
    $student_id = mysqli_real_escape_string($con, $_POST['delete_student']);

    $query = "DELETE FROM students WHERE id='$student_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Deleted Successfully";
        session_unset();
        header("Location: login.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Deleted";
        header("Location: index.php");
        exit(0);
    }
}


// if (isset($_POST['delete_student'])) {
//     // Get the user ID from the session
//     if (!isset($_SESSION['id'])) {
//         // Handle cases where the user ID is not set in the session
//         $_SESSION['message'] = "User ID not found.";
//         header("Location: index.php");
//         exit();
//     }
//     $logged_in_user_id = $_SESSION['id'];

//     // Get the student ID to be deleted from the form data
//     $student_id = mysqli_real_escape_string($con, $_POST['delete_student']);

//     // Check if the logged-in user's ID matches the student's ID
//     if ($logged_in_user_id != $student_id) {
//         $_SESSION['message'] = "Access denied. You are not authorized to delete this student.";
//         header("Location: index.php");
//         exit();
//     }

//     // Perform the deletion of the student record
//     $query = "DELETE FROM students WHERE id='$student_id' ";
//     $query_run = mysqli_query($con, $query);

//     if ($query_run) {
//         session_unset();//if deleting time give some error comment this line.
//         $_SESSION['message'] = "Student Deleted Successfully";
//         header("Location: login.php");
//         exit();
//     } else {
//         $_SESSION['message'] = "Student Not Deleted";
//         header("Location: index.php");
//         exit();
//     }
// }


if (isset($_POST['update_student'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $course = mysqli_real_escape_string($con, $_POST['course']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $password_cnf = mysqli_real_escape_string($con, $_POST['password_cnf']);
    $condition = mysqli_real_escape_string($con, $_POST['condition_1']);

        // Validation for required fields
        if (empty($fname) || empty($lname) || empty($email) || empty($dob) || empty($gender) || empty($course)) {
            $_SESSION['message'] = "Please fill in all required fields.";
            header("Location: student-create.php");
            exit(0);
        }
    
        // Email format validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = "Invalid email format.";
            header("Location: student-create.php");
            exit(0);
        }
    
        // Phone number format validation (assuming a standard format)
        if (!preg_match("/^[0-9]{10}$/", $phone)) {
            $_SESSION['message'] = "Invalid phone number format. Please enter 10 digits.";
            header("Location: student-create.php");
            exit(0);
        }
    
        // Password matching validation
        if ($password !== $password_cnf) {
            $_SESSION['message'] = "Passwords do not match.";
            header("Location: student-create.php");
            exit(0);
        }

    // Check if a new image is uploaded
    if (isset($_FILES['pimage']) && $_FILES['pimage']['error'] === UPLOAD_ERR_OK) {
        // Delete the previous image
        $prev_image = $student['pimage']; // Get the name of the previous image
        if (!empty($prev_image) && file_exists("uploads/$prev_image")) {
            unlink("uploads/$prev_image"); // Delete the previous image file
        }

        // Handle the new image upload
        $target_dir = "uploads/"; // Specify your upload directory
        $imageFileType = strtolower(pathinfo($_FILES['pimage']['name'], PATHINFO_EXTENSION));
        $profile = uniqid() . '.' . $imageFileType; // Generate a unique name for the uploaded file

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($_FILES['pimage']['tmp_name'], $target_dir . $profile)) {
            $profile = mysqli_real_escape_string($con, $profile); // Update the new image name in the database
        } else {
            $_SESSION['message'] = "Failed to upload new image.";
            header("Location: index.php");
            exit(0);
        }
    } else {
        // No new image uploaded, keep the previous image name
        $profile = $student['pimage'];
    }

    // Continue with the rest of your update query
    $query = "UPDATE students SET fname='$fname', lname='$lname', email='$email', phone='$phone', gender='$gender', dob='$dob',
     course='$course', address='$address', password='$password' , condition_1='$condition' , pimage='$profile' WHERE id='$student_id'";

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Updated Successfully";
        // Check the user's role and redirect accordingly
        if ($_SESSION['role'] == 'admin') {
            header("Location: admin_index.php");
        } else {
            header("Location: index.php");
        }
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Updated";
        // Check the user's role and redirect accordingly
        if ($_SESSION['role'] == 'admin') {
            header("Location: admin_index.php");
        } else {
            header("Location: index.php");
        }
        exit(0);
    }

}



if (isset($_POST['save_student'])) {
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $course = mysqli_real_escape_string($con, $_POST['course']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $password_cnf = mysqli_real_escape_string($con, $_POST['password_cnf']);
    $condition = mysqli_real_escape_string($con, $_POST['condition_1']);

    // Validation for required fields
    if (empty($fname) || empty($lname) || empty($email) || empty($dob) || empty($gender) || empty($course)) {
        $_SESSION['message'] = "Please fill in all required fields.";
        header("Location: student-create.php");
        exit(0);
    }

    // Email format validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email format.";
        header("Location: student-create.php");
        exit(0);
    }

    // Phone number format validation (assuming a standard format)
    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        $_SESSION['message'] = "Invalid phone number format. Please enter 10 digits.";
        header("Location: student-create.php");
        exit(0);
    }

    // Password matching validation
    if ($password !== $password_cnf) {
        $_SESSION['message'] = "Passwords do not match.";
        header("Location: student-create.php");
        exit(0);
    }

    // Condition validation
    if ($condition !== "yes") {
        $_SESSION['message'] = "You must accept the conditions.";
        header("Location: student-create.php");
        exit(0);
    }

    // File Upload
    $profile = '';
    if (isset($_FILES['pimage']) && $_FILES['pimage']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/"; // Specify your upload directory
        $imageFileType = strtolower(pathinfo($_FILES['pimage']['name'], PATHINFO_EXTENSION));

        // Generate a unique name for the uploaded file
        $profile = uniqid() . '.' . $imageFileType;

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($_FILES['pimage']['tmp_name'], $target_dir . $profile)) {
            // File uploaded successfully
            $profile = mysqli_real_escape_string($con, $profile);
        } else {
            $_SESSION['message'] = "Failed to upload file.";
            header("Location: student-create.php");
            exit(0);
        }
    } else {
        // Handle file upload error
        $_SESSION['message'] = "File upload error.";
        header("Location: student-create.php");
        exit(0);
    }

    // Insert data into the database
    $query = "INSERT INTO students (fname, lname, email, phone, gender, pimage, dob, course, address, password, condition_1) 
            VALUES ('$fname', '$lname', '$email', '$phone', '$gender', '$profile', '$dob', '$course', '$address', '$password','$condition')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Student Created Successfully";
        // Check the user's role and redirect accordingly
        if ($_SESSION['role'] == 'admin') {
            header("Location: admin_index.php");
        } else {
            header("Location: index.php");
        }
        exit(0);
    } else {
        $_SESSION['message'] = "Student Not Created";
        // Check the user's role and redirect accordingly
        if ($_SESSION['role'] == 'admin') {
            header("Location: admin_index.php");
        } else {
            header("Location: index.php");
        }
        exit(0);
    }
}

?>


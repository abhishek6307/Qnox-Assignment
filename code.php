<?php
session_start();
require 'dbcon.php';

// if(isset($_POST['delete_student']))
// {
//     $student_id = mysqli_real_escape_string($con, $_POST['delete_student']);

//     $query = "DELETE FROM students WHERE id='$student_id' ";
//     $query_run = mysqli_query($con, $query);

//     if($query_run)
//     {
//         $_SESSION['message'] = "Student Deleted Successfully";
//         header("Location: student-view.php");
//         exit(0);
//     }
//     else
//     {
//         $_SESSION['message'] = "Student Not Deleted";
//         header("Location: student-view.php");
//         exit(0);
//     }
// }

if(isset($_POST['update_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $college = mysqli_real_escape_string($con, $_POST['college']);
    $check_email = mysqli_query($con, "SELECT email FROM students where email = '$email' ");
    $check_phone = mysqli_query($con, "SELECT phone FROM students where phone = '$phone' ");
    if(mysqli_num_rows($check_phone) > 0){
        $_SESSION['message'] = "Phone Number Already exists";
        header("Location: student-view.php");

    }
    // elseif(mysqli_num_rows($check_phone) > 0){
    //     $_SESSION['message'] = "Phone Already exists";
    //     header("Location: student-create.php");

    // }
 
    else{
    $query = "UPDATE students SET name='$name', email='$email', phone='$phone', college='$college' WHERE id='$student_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Updated Successfully";
        header("Location: student-view.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Updated";
        header("Location: student-view.php");
        exit(0);
    }

}
}


if(isset($_POST['save_student']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $college = mysqli_real_escape_string($con, $_POST['college']);
    $check_email = mysqli_query($con, "SELECT email FROM students where email = '$email' ");
    $check_phone = mysqli_query($con, "SELECT phone FROM students where phone = '$phone' ");
    if(mysqli_num_rows($check_phone) > 0){
        $_SESSION['message'] = "Phone Number Already exists";
        header("Location: student-view.php");

    }
    // elseif(mysqli_num_rows($check_phone) > 0){
    //     $_SESSION['message'] = "Number Already exists";
    //     header("Location: student-create.php");

    // }
    // elseif(mysqli_num_rows($check_email) > 0){
    //     $_SESSION['message'] = "Number Already exists";
    //     header("Location: student-create.php");

    // }
 
    else{

    $query = "INSERT INTO students (name,email,phone,college) VALUES ('$name','$email','$phone','$college')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Student Created Successfully";
        header("Location: student-view.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Created";
        header("Location: student-create.php");
        exit(0);
    }
}
}

if(isset($_POST['sign_up']))
{   
    if(empty($_POST['username']) || empty($_POST['password'])){
        $_SESSION['message'] = "All Fields must be entered";
        header("Location: index.php");
  
      }else{
        
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $check_user = mysqli_query($con, "SELECT username FROM students where username = '$username' ");
    if(mysqli_num_rows($check_user) > 0){
        $_SESSION['message'] = "User Already exists";
        header("Location: index.php");

    }else{
        $query = "INSERT INTO students (username,password) VALUES ('$username','$password')";

        $query_run = mysqli_query($con, $query);
        if($query_run)
        {
            $_SESSION['message'] = "User Created Successfully";
            header("Location: index.php");
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "User Not Created";
            header("Location: index.php");
            exit(0);
        }
    }


    }
}

if(isset($_POST['login'])){

  if(empty($_POST['username']) || empty($_POST['password'])){
    $_SESSION['message'] = "All Fields must be entered in";
    header("Location: index.php");
    die();
  }else{
    $username =  $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id FROM students WHERE username = '{$username}' AND password= '{$password}'";

    $result = mysqli_query($con, $sql) or die("Query Failed.");
   
    if(mysqli_num_rows($result) > 0){

        header("Location: student-create.php");

    }else{
    echo '<div class="alert alert-danger">Username and Password are not matched.</div>';
  }
}
}
?>


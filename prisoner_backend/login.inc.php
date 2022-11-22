<?php 

if (isset($_POST['prisoner-login'])) {
  require 'config.inc.php';
  $roll = $_POST['prisoner_roll_no'];
  $password = $_POST['pwd'];

  if (empty($roll) || empty($password)) {
    echo ("<script LANGUAGE='JavaScript'>
      window.alert('Empty Feild');
      window.location.href='../index.php';
      </script>");
      exit();
  }
  else {
    $sql = "SELECT *FROM prisoner WHERE prisoner_id = '$roll'";
    $result = mysqli_query($conn, $sql);
    if($row = mysqli_fetch_assoc($result)){
      // $pwdCheck = password_verify($password, $row['password']);
      // if($pwdCheck == false){
      //   header("Location: ../index.php?error=wrongpwd");
      //   exit();
      // }
      if($password == $row['password']) {

        //session_start();
        $_SESSION['roll'] = $row['prisoner_id'];
        $_SESSION['fname'] = $row['f_name'];
        $_SESSION['lname'] = $row['l_name'];
        $_SESSION['department'] = $row['crime'];
        $_SESSION['year_of_study'] = $row['year'];
        $_SESSION['prison_id'] = $row['prison_id'];
        $_SESSION['cell_id'] = $row['cell_id'];
        $_SESSION['gender'] = $row['gender'];

        if(isset($_SESSION['roll'])){
          echo "<script type='text/javascript'>alert('success')</script>";
        }
        else {
          echo "<script type='text/javascript'>alert('Not SET')</script>";
        }
         echo $_SESSION['roll'];

        header("Location: ../prisoner/home.php?login=success");
        exit();
      }
      else {
        echo ("<script LANGUAGE='JavaScript'>
      window.alert('Password is incorrect');
      window.location.href='../index.php';
      </script>");
      exit();
      }
    }
    else{
      echo ("<script LANGUAGE='JavaScript'>
      window.alert('No user exist');
      window.location.href='../index.php';
      </script>");
      exit();
    }
  }

}
else {
  header("Location: ../index.php");
  exit();
}

?>
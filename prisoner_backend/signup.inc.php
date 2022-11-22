
<?php

if (isset($_POST['signup-prisoner'])) {//

  require 'config.inc.php';

  $prisoner_id = $_POST['username'];//
  $password = $_POST['password'];
  $confpassword =$_POST['confpassword'];
  $f_name = $_POST['f_name'];
  $l_name = $_POST['l_name'];
  $mobile = $_POST['mobile'];
  $gender = $_POST['gender'];
  $year = $_POST['year'];
  $crime = $_POST['crime'];
  $_SESSION['roll'] = $_POST['username'];
  $_SESSION['year_of_study'] = $_POST['year'];
  $_SESSION['department'] = $_POST['crime'];
  $_SESSION['prisoner_id'] = $_POST['username'];

  if (empty($prisoner_id) || empty($password) || empty($f_name) || empty($l_name) || empty($confpassword) || empty($mobile) || empty($gender) || empty($year) || empty($crime)) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Empty Feilds!!');
        window.location.href='../index_signup.php';
        </script>");
        exit();
  }
  else {
    if($confpassword!=$password)
    {
    //  echo "<script type='text/javascript'>alert('Please Enter same password!')</script>";
    echo ("<script LANGUAGE='JavaScript'>
      window.alert('Passwords not matching');
      window.location.href='../index_signup.php';
      </script>");
      exit();
    }
    $sql = "SELECT* FROM prisoner WHERE prisoner_id = '$prisoner_id';";
    $result = mysqli_query($conn, $sql);
    if($result) {
      $row = mysqli_fetch_assoc($result);
        if(!empty($row)) {
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('User Already exist');
        window.location.href='../index_signup.php';
        </script>");
          exit();
      } 
    }

    $sql = "INSERT INTO prisoner VALUES ('$prisoner_id','$f_name', '$l_name', '$year','$crime', '$password', NULL ,NULL,$gender,'$mobile');";
    $result = mysqli_query($conn, $sql);
    if($result) {
      echo ("<script LANGUAGE='JavaScript'>
      window.alert('Prisoner Successfully Created');
      window.location.href='../prisoner/prisons.php';
      </script>");
      exit();
    }
    else {
      echo ("<script LANGUAGE='JavaScript'>
      window.alert('Error Please try agin Later');
      window.location.href='../index_signup.php';
      </script>");
      exit();
    }
  }
}

?>

<?php include('admin-header.php') ?>

<div class ="container contact-container">

    <h2 style="text-align: center;">Enter the details</h2>
    <br>
    <form action="appoint.php" method="post">
        <div class="row">

            <div class="col-md-8" style="padding-left:400px ;">
            <input type="text" name="username" class="form-control prisoner-text" placeholder="User Name">
                <input type="text" name="f_name" class="form-control prisoner-text" placeholder="First Name">
                <input type="text" name="l_name" class="form-control prisoner-text" placeholder="Last Name">
                <input type="password" name="password" class="form-control prisoner-text" placeholder="Password">
                <select class="custom-select" name="prison_name">
                    <option selected>Jail Name</option>
                    <option value="A">JAIL A</option>
                    <option value="B">JAIL B</option>
                    <option value="C">JAIL C</option>
                    <option value="D">JAIL D</option>
                    <option value="E">JAIL E</option>
                    <option value="F">JAIL F</option>
                </select>
                <input type="text" name="mobile" class="form-control prisoner-text" placeholder="Mobile">
            </div>
            <div class="col-md-10" style="padding-left: 540px;">
            <button type="submit" name="appoint-hm"  class="btn-lg btn-success" style="margin-top:10px;">Submit</button>
            </div>
        </div>
    </form>

</div>

<?php include('admin-footer.php'); ?>

<?php

if (isset($_POST['appoint-hm'])) {

  $username = $_POST['username'];
  $password = $_POST['password'];
  $f_name = $_POST['f_name'];
  $l_name = $_POST['l_name'];
  $prison_name = $_POST['prison_name'];
  $mobile = $_POST['mobile'];
  $ha_id= $_SESSION['ha_id'];

  if (empty($username) || empty($password) || empty($f_name) || empty($l_name) || empty($prison_name) || empty($mobile)) {
    echo "<script type='text/javascript'>alert('Empty Feild!')</script>";
    exit();
  }
  else {
    $sql = "SELECT * FROM prison WHERE prison_name='$prison_name';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $prison_id= $row['prison_id'];
    //echo $prison_id;
    //echo $row;
    $sql = "INSERT INTO prison_manager (f_name, l_name, username, mobile, password, admin, prison_id) VALUES ('$f_name', '$l_name', '$username', '$mobile', '$password', '$ha_id', '$prison_id');";
    $result = mysqli_query($conn, $sql);
  //  echo "<script type='text/javascript'>alert('Sucessfully Inserted!')</script>";
    if($result) {
        echo "<script type='text/javascript'>alert('Prison Manager insertion Success!')</script>";
        exit(); 
    }
    else {
        echo "<script type='text/javascript'>alert('Prison Manager insertion Failed!')</script>";
        exit(); 
    }
  }
}

?>


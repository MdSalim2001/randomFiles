<?php include('admin-header.php') ?>

<div class ="container contact-container">

    <h2 style="text-align: center;">Enter the details</h2>
    <br>
    <form action="remove.php" method="post">
        <div class="row">

            <div class="col-md-8" style="padding-left:400px ;">
            <input type="text" name='username' class="form-control prisoner-text" placeholder="User Name">
            <select class="custom-select" name="prison_name">
            <option selected>Jail Name</option>
                    <option value="A">JAIL A</option>
                    <option value="B">JAIL B</option>
                    <option value="C">JAIL C</option>
                    <option value="D">JAIL D</option>
                    <option value="E">JAIL E</option>
                    <option value="F">JAIL F</option>
            </select>
             <input type="password" name='password' class="form-control prisoner-text" placeholder="Admin Password">
            </div>
            <div class="col-md-10" style="padding-left: 540px;">
            <button type="submit" name="remove-hm"  class="btn-lg btn-success" style="margin-top:10px;">Submit</button>
            </div>
        </div>
    </form>

</div>
<br>
<br>
<?php include('admin-footer.php'); ?>

<?php

if (isset($_POST['remove-hm'])) {

  $username = $_POST['username'];
  $password = $_POST['password'];
  $prison_name = $_POST['prison_name'];
//  echo $username;
//  echo $password;
//  echo $prison_name;

  if (empty($username) || empty($password) || empty($prison_name) ) {
    echo "<script type='text/javascript'>alert('Empty Feild!')</script>";
    exit();
  }
  else if($_SESSION['password']!=$password){
    echo "<script type='text/javascript'>alert('Wrong Password!')</script>";
    exit();
  }
  else {
    $sql = "SELECT * FROM prison WHERE prison_name='$prison_name'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $prison_id= $row['prison_id'];
    $sql = "DELETE FROM prison_manager WHERE username='$username' and prison_id='$prison_id'";
    $result = mysqli_query($conn, $sql);
    
    if($result) {
        echo "<script type='text/javascript'>alert('Sucessfully Deleted!')</script>";
        exit();
    }
    else {
        echo "<script type='text/javascript'>alert('Deletion Failed!')</script>";
        exit();
    }
  }
}

?>

<?php include('prisoner-header.php') ?>

<?php 
    //For retrieving prison name using prison id from prisoner

    $prison_id = $_SESSION['prison_id'];
    $sql = "SELECT prison_name FROM prison WHERE prison_id = $prison_id";
    $result = mysqli_query($conn, $sql);
    if($result) {
        if($result->num_rows!=0) {
            if($row = mysqli_fetch_assoc($result)){
                $prison_name = $row['prison_name'];
            }
        }
    }
    else {
        $prison_name ="not alloted";
    }

?>

<div class ="container contact-container">

    <h2>Contact Us</h2>
    <br>
    <form action="contact.php" method="post">
        <div class="row">

            <div class="col-md-6">
                <input type="text" class="form-control prisoner-text" placeholder="prison Name" value= "<?php echo $prison_name; ?>" readonly>   
                <input type="text" class="form-control prisoner-text" placeholder ="Roll No" value= <?php echo $_SESSION['roll']; ?> readonly>
                <input type="text" class="form-control prisoner-text" placeholder="Name" value= "<?php echo $_SESSION['fname'] . ' ' . $_SESSION['lname']; ?>" readonly>
                <input type="text" class="form-control prisoner-text" name="subject" placeholder="Subject">
            </div>

            <div class="col-md-6">
                <textarea class="form-control prisoner-text-area" id="exampleFormControlTextarea1" rows="7" placeholder="Message..." name="message"></textarea>
                
            </div>
            <div class="col-md-5" style="padding-left: 540px;">
            <button type="submit" name="submit"  class="btn-lg btn-primary" style="margin-top:10px;">Submit</button>
            </div>
        </div>
    </form>

</div>

<?php include('prisoner-footer.php'); ?>

<?php
if(isset($_POST['submit'])){
	// echo "<script type='text/javascript'>alert('hello');</script>";
	$subject = $_POST['subject'];
    $message = $_POST['message'];

    $query6 = "SELECT * FROM prison_manager WHERE prison_id = '$prison_id'";
    $result6 = mysqli_query($conn,$query6);
    $row6 = mysqli_fetch_assoc($result6);
    $hm_id = $row6['hm_id'];

    echo $hm_id;

	$roll = $_SESSION['roll'];
    date_default_timezone_set('Asia/Calcutta');
    $t=time();
    $time_stamp = date('Y-m-d H:i:s',$t);

    if(empty($message) || empty($subject) || strlen(trim($message)) == 0 || strlen(trim($subject)) == 0) {
        echo "<script type='text/javascript'>alert('column empty!')</script>";
        exit();
    }
    else if($prison_name =="not alloted") {
        echo "<script type='text/javascript'>alert('prison not alloted!')</script>";
        exit();
    }

	$query = "INSERT INTO messages (hm_id,prisoner_id,subject,message,time_stamp,sender) VALUES ('$hm_id','$roll','$subject','$message','$time_stamp','1')";
    $result = mysqli_query($conn,$query);
    if($result){
         echo ("<script LANGUAGE='JavaScript'>
        window.alert('Message sent to prison manager Successfully!');
        window.location.href='home.php';
        </script>");
        exit();
         
    }
    else{
         echo "<script type='text/javascript'>alert('Error in sending message!!! Please try again.')</script>";
         exit();
   }
  }


?>
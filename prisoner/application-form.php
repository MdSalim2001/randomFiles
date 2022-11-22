<?php include('../HM/hm-header.php') ?>

<div class ="container application-container">

    <h2>PRISONER CELL ALLOCATION</h2>
    <br>
    <form action="application-form.php?id=<?php echo $_GET['id']?>" method="post">
        <div class="row">

            <div class="col-md-6">
                <input type="text" class="form-control prisoner-text" placeholder="Prisoner ID" value = <?php echo $_SESSION['roll']; ?> readonly>   
                <input type="text" class="form-control prisoner-text" placeholder ="Jail" value = <?php echo $_GET['id'] . " prison"; ?> readonly>

            </div>

            <div class="col-md-6">
                <textarea class="form-control prisoner-text-area" id="exampleFormControlTextarea1" rows="3" placeholder="Message..." name="message"></textarea>
                
            </div>
        </div>
        <h5 style ="margin: 20px auto 20px;">Select Cell :</h5>
        <div class="row">
        <!--- Cell booking set up ---------->
            
        <div class="container boxed">
                <?php
                    $prison_name = $_GET['id'];
                    $query = "SELECT * FROM cell NATURAL JOIN prison WHERE prison_name='$prison_name' ORDER BY cell_no ASC";
                    $result = mysqli_query($conn,$query);
                    
                    // Checking wheather someone applied
                    $query2 = "SELECT cell_id FROM application WHERE status='0' OR status ='1'";
                    $result2 = mysqli_query($conn,$query2);
                    $cell_set = array();
                    while($row2 = mysqli_fetch_array($result2))
                    {
                        array_push($cell_set,$row2['cell_id']);
                    }

                    while($row = mysqli_fetch_assoc($result)) {
                        if($row['allocated'] == 1 || in_array($row['cell_id'], $cell_set)) {
                            continue;
                        }
                        $x = $row['cell_no'];
                ?>
                    <input type="radio" id= <?php echo $x ?> name= "cell_no" value=<?php echo $x ?>>
                    <label for=<?php echo $x ?> > <?php echo $x ?> </label>
                <?php } ?> 

                <br><br>
            </div>
        <!-------------------------------->
                <div class="col-md-5" style="padding-left: 540px; margin-bottom: 20px;">
                <button type="submit" name="application"  class="btn-lg btn-primary" style="margin-top:10px;margin-bottom: 30px;">Submit</button>
                </div>
        </div>
    </form>

</div>

<?php include('prisoner-footer.php'); ?>

<?php 
    if(isset($_POST['application'])){
        // echo "<script type='text/javascript'>alert('hello');</script>";
        $message = $_POST['message'];
        $cell_no = $_POST['cell_no'];
        $prisoner_id = $_SESSION['roll'];
        $prison_name = $_GET['id'];

        //verifying wheather prisoner already alloted
        $query = "SELECT cell_id FROM prisoner WHERE prisoner_id = '$prisoner_id'";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($result);
        if(!empty($row['cell_id'])) {
            echo "<script type='text/javascript'>alert('Already Cell is alloted this prisoner')</script>";
            exit();
        }

        //verifying wheather prisoner already applied
        $query = "SELECT * FROM application WHERE prisoner_id = '$prisoner_id'";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($result);
        if(!empty($row['prisoner_id'])) {
            echo "<script type='text/javascript'>alert('Application already sent for this prisoner')</script>";
            exit();
        }
        //prison manager id selecting
        $query = "SELECT * FROM prison_manager NATURAL JOIN prison WHERE prison_name = '$prison_name'";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($result);
        $hm_id = $row['hm_id'];
        $prison_id = $row['prison_id'];
        
        echo "Cell No : " . $cell_no;
        echo "prison id : " . $prison_id;

        //cell_id selecting
        $query = "SELECT * FROM cell WHERE prison_id = '$prison_id' AND cell_no='$cell_no'";
        $result = mysqli_query($conn,$query);
        if($result) {
            if(mysqli_num_rows($result) == 0) {
                echo "rows are empty";
            }
            else {
                $row = mysqli_fetch_assoc($result);
                echo "success Cell id : " . $row['cell_id'];
                $cell_id = $row['cell_id'];
            }
        }
        else {
            echo "fail";
        }
        
        //application form submission
        $query = "INSERT INTO application (prisoner_id,cell_id,hm_id,message,status) VALUES ('$prisoner_id','$cell_id','$hm_id','$message','0')";
        $result = mysqli_query($conn,$query);
        if($result){
         echo ("<script LANGUAGE='JavaScript'>
        window.alert('Application sent Successfully!');
        window.location.href='../HM/home.php';
        </script>");
        exit();
        }
        else{
            echo "<script type='text/javascript'>alert('Error in sending Application!!! Please try again.')</script>";
            exit();
        }

    }
?>
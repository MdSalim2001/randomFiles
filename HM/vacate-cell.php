<?php include('hm-header.php') ?>

<?php
   $prison_id = $_SESSION['prison_id'];
   $query1 = "SELECT * FROM prison WHERE prison_id = '$prison_id'";
   $result1 = mysqli_query($conn,$query1);
   $row1 = mysqli_fetch_assoc($result1);
   $prison_name = $row1['prison_name'];
?>

<div class ="container contact-container">

    <h2 style="text-align: center;">Enter the details</h2>
    <br>
    <form action="vacate-cell.php" method="post">
        <div class="row">

            <div class="col-md-8" style="padding-left:400px ;">
                <input type="text" class="form-control prisoner-text" placeholder="Jail-Name" name="prison" value="<?php echo $row1['prison_name']?>" readonly>   
                <input type="text" class="form-control prisoner-text" name="roll_no" placeholder ="Prisoner ID" >
                <input type="number" class="form-control prisoner-text" name="cell_no" placeholder ="CELL Number" >
              
            </div>

           
            <div class="col-md-10" style="padding-left: 540px;">
            <button type="submit" name="contact-button"  class="btn-lg btn-success" style="margin: 8px auto 0px;; padding: 3px 25px 3px;">Submit</button>
            </div>
        </div>
    </form>

</div>
<br>
<br>

<?php
if(isset($_POST['contact-button'])){
     $roll = $_POST['roll_no'];
     $prison = $_POST['prison'];
     $cell_number =(int)$_POST['cell_no'];

    $query2 = "SELECT * FROM cell WHERE prison_id = '$prison_id' and cell_no = '$cell_number'";
    $result2 = mysqli_query($conn,$query2);
    if(mysqli_num_rows($result2)==0){
        echo "<script type='text/javascript'>alert('Incorrect Details')</script>";
        exit();
    }
    $row2 = mysqli_fetch_assoc($result2);
    if($row2['allocated']=='0'){
    	echo "<script type='text/javascript'>alert('Cell Not Allocated')</script>";
    	exit();
    }
    $cell_id = (int)$row2['cell_id'];
    /*echo "<script type='text/javascript'>alert('<?php echo $cell_id ?>')</script>";*/
	$query3 = "SELECT * FROM prisoner WHERE prisoner_id = '$roll' and prison_id = '$prison_id' and cell_id = '$cell_id'";
	$result3 = mysqli_query($conn,$query3);
    if(mysqli_num_rows($result3)==0){
        echo "<script type='text/javascript'>alert('Incorrect Details 2')</script>";
        exit();
    }
    $row3 = mysqli_fetch_assoc($result3);
    if($result3){
    	$query4 = "UPDATE prisoner SET prison_id = NULL, cell_id = NULL WHERE prisoner_id = '$roll'";
    	$result4 = mysqli_query($conn,$query4);
    	if($result4){
    		$query5 = "UPDATE cell SET allocated = '0' WHERE cell_id = '$cell_id'";
    		$result5 = mysqli_query($conn,$query5);
    		if($result5){
    			$query6 = "DELETE FROM Application WHERE prisoner_id = '$roll'";
    			$result6 = mysqli_query($conn,$query6);
    			if($result6){
    			    echo "<script type='text/javascript'>alert('Vacated Successfully')</script>";	
    			}
    			
    		}
    	}
    }
}
?>

<?php include('hm-footer.php');
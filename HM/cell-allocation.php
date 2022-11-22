<?php include('hm-header.php') ?>

<div class ="container contact-container">

    <h2>Applications</h2>
    <br>
    <form action="cell-allocation.php" method="post">
        <div class="row">

            <div class="col-md-6">
                <input type="text" class="form-control prisoner-text" name="search_box" placeholder="Prisoner ID">   
                
            </div>

            <div class="col-md-6">
                <button type="submit" name="contact-button"  class="btn-md btn-success" style="margin-top:10px;  padding: 5px 25px 5px;">Submit</button>
            </div>
        </div>
    </form>
<br>
    <?php
   if (isset($_POST['contact-button'])) {
   	   $search_box = $_POST['search_box'];
   	   /*echo "<script type='text/javascript'>alert('<?php echo $search_box; ?>')</script>";*/
   	   $hm_id = $_SESSION['hm_id'];
   	   $query_search = "SELECT * FROM application WHERE prisoner_id like '$search_box%' and hm_id = '$hm_id'";
   	   $result_search = mysqli_query($conn,$query_search);

   	   //select the prison name from prison table
       $query6 = "SELECT * FROM prison_manager,prison WHERE prison_manager.prison_id=prison.prison_id and prison_manager.hm_id = '$hm_id'";
       $result6 = mysqli_query($conn,$query6);
       $row6 = mysqli_fetch_assoc($result6);
       $prison_name = $row6['prison_name'];

     
   	   ?>
   	   <div >
   	   <table class="table table-hover">
    <thead>
      <tr>
        <th>Prisoner Name</th>
        <th>Prisoner ID</th>
        <th>Jail</th>
        <th>Cell Number</th>
        <th>Message</th>
      </tr>
    </thead>
    <tbody>

    <?php
   	   if(mysqli_num_rows($result_search)==0){
   	   	  echo '<tr><td colspan="4">No Rows Returned</td></tr>';
   	   }
   	   else{
   	   	  while($row_search = mysqli_fetch_assoc($result_search)){
      		//get the name of the prisoner to display
            $prisoner_id = $row_search['prisoner_id'];
            $cell_id=$row_search['cell_id'];

            $query7 = "SELECT * FROM prisoner WHERE prisoner_id = '$prisoner_id'";
            $result7 = mysqli_query($conn,$query7);
            $row7 = mysqli_fetch_assoc($result7);
            $prisoner_name = $row7['f_name']." ".$row7['l_name'];
            
            //get cell_no
            $query10 = "SELECT * FROM cell WHERE cell_id = '$cell_id'";
            $result10 = mysqli_query($conn,$query10);
            $row10 = mysqli_fetch_assoc($result10);
            $cell_no = $row10['cell_no'];


              echo "<tr><td>{$prisoner_name}</td>
              <td>{$row_search['prisoner_id']}</td>
              <td>{$prison_name}</td>
              <td>{$cell_no}</td>
              <td>{$row_search['message']}</td>
              </tr>\n";
   	   }
   }
   ?>
   </tbody>
  </table>
</div>
<?php } ?>



<div>
<h2 class="heading text-capitalize mb-sm-5 mb-4"> Applications Received </h2>
<?php
  $hm_id = $_SESSION['hm_id'];
  $query1 = "SELECT * FROM application WHERE hm_id = '$hm_id' and status='0'";
  $result1 = mysqli_query($conn,$query1);

  //select the prison name from prison table
$query12 = "SELECT * FROM prison_manager,prison WHERE prison_manager.prison_id=prison.prison_id and prison_manager.hm_id = '$hm_id'";
$result12 = mysqli_query($conn,$query12);
$row12 = mysqli_fetch_assoc($result12);
$prison_name1 = $row12['prison_name'];
?>
        
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Prisoner Name</th>
        <th>Prisoner ID</th>
        <th>Jail</th>
        <th>Cell Number</th>
        <th>Message</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php
      if(mysqli_num_rows($result1)==0){
         echo '<tr><td colspan="4">No Applications have been found</td></tr>';
      }
      else{
      	while($row1 = mysqli_fetch_assoc($result1)){
      		//get the name of the prisoner to display
            $prisoner_id = $row1['prisoner_id']; 
            $cell_id=$row1['cell_id'];

            $query7 = "SELECT * FROM prisoner WHERE prisoner_id = '$prisoner_id'";
            $result7 = mysqli_query($conn,$query7);
            $row7 = mysqli_fetch_assoc($result7);
            $prisoner_name = $row7['f_name']." ".$row7['l_name'];

             //get cell_no
             $query14 = "SELECT * FROM cell WHERE cell_id = '$cell_id'";
             $result14 = mysqli_query($conn,$query14);
             $row14 = mysqli_fetch_assoc($result14);
             $cell_no1 = $row14['cell_no'];
            //    
              echo "<tr><td>{$prisoner_name}</td>
              <td>{$row1['prisoner_id']}</td>
              <td>{$prison_name1}</td>
              <td>{$cell_no1}</td>
              <td>{$row1['message']}</td>
              <td>
              <form action='cell-allocation.php' method='get'>
               <button type='submit' style='margin-top: 0px;' name='alloc' value='{$row1['prisoner_id']}' class='btn-md btn-success' style='margin-top:10px; margin-left: -10px; padding: 8px 25px 8px;''>Allocate</button>
               </form>
               </td></tr>\n";
      	}
      }
    ?>
 
    </tbody>
  </table>
</div>

<?php
if(isset($_GET['alloc'])){
  
  //header("Location:cell-allocation.php");
    $roll=$_GET['alloc'];

    $que = "SELECT * FROM application WHERE prisoner_id = '$roll'";
    $res = mysqli_query($conn,$que);
    $rows = mysqli_fetch_assoc($res);

     //select the prison name from prison table
     $que4 = "SELECT * FROM prison_manager,prison WHERE prison_manager.prison_id=prison.prison_id and prison_manager.hm_id = '$hm_id'";
     $res4 = mysqli_query($conn,$que4);
     $rows2 = mysqli_fetch_assoc($res4);
     $prison_id = $rows2['prison_id'];

    
    $que2="UPDATE application SET status = '1' WHERE prisoner_id = '$roll'";
    $res2 = mysqli_query($conn,$que2);

        $que3="UPDATE prisoner SET cell_id = '$rows[cell_id]',prison_id='$prison_id' WHERE prisoner_id = '$roll'";
        $res3 = mysqli_query($conn,$que3);
 
            $que4="UPDATE cell SET allocated='1' WHERE  cell_id = '$rows[cell_id]'";
            $res4 = mysqli_query($conn,$que4);
        
}
?>

<br>
<br>
</div>


<?php include('hm-footer.php');

<?php include('hm-header.php') ?>

<div class ="container contact-container">

    <h2>Search By Prisoner ID</h2>
    <br>
    <form action="alloted-cells.php" method="post">
        <div class="row">

            <div class="col-md-6">
                <input type="text" class="form-control prisoner-text" name="search_box" placeholder="Prisoner ID">   
                
            </div>

            <div class="col-md-6">
                <button type="submit" name="contact-button"  class="btn-lg btn-success" style="margin-top: 5px;">Submit</button>
            </div>
        </div>
    </form>
<br>
    <?php
   if (isset($_POST['contact-button'])) {
   	   $search_box = $_POST['search_box'];
   	   /*echo "<script type='text/javascript'>alert('<?php echo $search_box; ?>')</script>";*/
   	   $prison_id = $_SESSION['prison_id'];
   	   $query_search = "SELECT * FROM prisoner WHERE prisoner_id like '$search_box%' and prison_id = '$prison_id'";
   	   $result_search = mysqli_query($conn,$query_search);

   	   //select the prison name from prison table
       $query6 = "SELECT * FROM prison WHERE prison_id = '$prison_id'";
       $result6 = mysqli_query($conn,$query6);
       $row6 = mysqli_fetch_assoc($result6);
       $prison_name = $row6['prison_name'];
   	   ?>
   	   <div class="container">
   	   <table class="table table-hover">
    <thead>
      <tr>
        <th>Prisoner Name</th>
        <th>Prisoner ID</th>
        <th>Contact Number</th> 
        <th>Jail</th>
        <th>Cell Number</th>
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
            $cell_id = $row_search['cell_id']; 
            $query7 = "SELECT * FROM cell WHERE cell_id = '$cell_id'";
            $result7 = mysqli_query($conn,$query7);
            $row7 = mysqli_fetch_assoc($result7);
            $cell_no = $row7['cell_no'];
            //prisoner name
            $prisoner_name = $row_search['f_name']." ".$row_search['l_name'];
            
      		echo "<tr><td>{$prisoner_name}</td><td>{$row_search['prisoner_id']}</td><td>{$row_search['mobile']}</td><td>{$prison_name}</td><td>{$cell_no}</td></tr>\n";
   	   }
   }
   ?>
   </tbody>
  </table>
  <?php
}
  ?>
<br>
<h2 > Cells Allotted </h2>
<br>
<?php
   $prison_id = $_SESSION['prison_id'];
   $query1 = "SELECT * FROM prisoner where prison_id = '$prison_id'";
   $result1 = mysqli_query($conn,$query1);
   //select the prison name from prison table
   $query6 = "SELECT * FROM prison WHERE prison_id = '$prison_id'";
   $result6 = mysqli_query($conn,$query6);
   $row6 = mysqli_fetch_assoc($result6);
   $prison_name = $row6['prison_name'];


?>
        
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Prisoner Name</th>
        <th>Prisoner ID</th>
        <th>Contact Number</th> 
        <th>Jail</th>
        <th>Cell Number</th>
      </tr>
    </thead>
    <tbody>
    <?php
      if(mysqli_num_rows($result1)==0){
         echo '<tr><td colspan="4">No Rooms have been Allocated</td></tr>';
      }
      else{
      	while($row1 = mysqli_fetch_assoc($result1)){
      		//get the cell_no of the prisoner from cell_id in cell table
            $cell_id = $row1['cell_id']; 
            $query7 = "SELECT * FROM cell WHERE cell_id = '$cell_id'";
            $result7 = mysqli_query($conn,$query7);
            $row7 = mysqli_fetch_assoc($result7);
            $cell_no = $row7['cell_no'];
            //prisoner name
            $prisoner_name = $row1['f_name']." ".$row1['l_name'];
            
      		echo "<tr><td>{$prisoner_name}</td><td>{$row1['prisoner_id']}</td><td>{$row1['mobile']}</td><td>{$prison_name}</td><td>{$cell_no}</td></tr>\n";
      	}
      }
    ?>
    </tbody>
  </table>
          </div>
</div>

<?php include('hm-footer.php');
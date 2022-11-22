<?php include('hm-header.php') ?>

<div class ="container contact-container">

    <h2>Search By Cell Number</h2>
    <br>
    <form action="empty-cells.php" method="post">
        <div class="row">

            <div class="col-md-6">
                <input type="text" name="search_box" class="form-control prisoner-text" placeholder="Cell Number">   
                
            </div>

            <div class="col-md-6">
                <button type="submit" name="contact-button"  class="btn-lg btn-success" style="margin-top:8px; padding: 3px 25px 3px;">Submit</button>
            </div>
        </div>
    </form>
<br><br>   

<?php 
    if(isset($_POST['contact-button']))
    {
        $search_box = $_POST['search_box'];
        /*echo "<script type='text/javascript'>alert('<?php echo $search_box; ?>')</script>";*/
        $prison_id = $_SESSION['prison_id'];
        $query_search = "SELECT * FROM cell WHERE cell_no like '$search_box%' and prison_id = '$prison_id' and allocated = '0'";
        $result_search = mysqli_query($conn,$query_search);

        //select the prison name from prison table
     $query6 = "SELECT * FROM prison WHERE prison_id = '$prison_id'";
     $result6 = mysqli_query($conn,$query6);
     $row6 = mysqli_fetch_assoc($result6);
     $prison_name = $row6['prison_name'];
    ?>
    <table class="table table-bordered">
    <thead>
      <tr>
        <th>Jail</th>
        <th>Cell Number</th>
      </tr>
    </thead>
    <tbody>
    <?php
   	   if(mysqli_num_rows($result_search)==0){
   	   	  echo '<tr><td colspan="4">No Empty Cells</td></tr>';
   	   }
   	   else{
   	   	  while($row_search = mysqli_fetch_assoc($result_search)){
         
      		echo "<tr><td>{$prison_name}</td><td>{$row_search['cell_no']}</td></tr>\n";
   	   }
   }
   ?>
    </tbody>
    </table>
    <?php }?>
    <br>
    <h2>Empty Cells</h2>
<br>
    <?php
   $prison_id = $_SESSION['prison_id'];
   $query1 = "SELECT * FROM cell where prison_id = '$prison_id' and allocated = '0'";
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
        <th>Jail</th>
        <th>Cell Number</th>
      </tr>
    </thead>
    <tbody>
    <?php
      if(mysqli_num_rows($result1)==0){
         echo '<tr><td colspan="4">No Empty Cells</td></tr>';
      }
      else{
      	while($row1 = mysqli_fetch_assoc($result1)){
      		echo "<tr><td>{$prison_name}</td><td>{$row1['cell_no']}</td></tr>\n";
      	}
      }
    ?>
    </tbody>
  </table>
</div>
<?php include('hm-footer.php');
<?php include('admin-header.php') ?>

<div class ="container contact-container">

    <h2>Search By Prisoner Number</h2>
    <br>
    <form action="prisoners.php" method="post">
        <div class="row">

            <div class="col-md-6">
                <input type="text" name="search_box" class="form-control prisoner-text" placeholder="Prisoner Number">   
                
            </div>

            <div class="col-md-6">
                <button type="submit" name="contact-button"  class="btn-lg btn-success" style="margin-top:10px;">Submit</button>
            </div>
        </div>
    </form>
    <br><br>

    <?php 
    if(isset($_POST['contact-button']))
    {
        $search_box = $_POST['search_box'];
        
        //select the prison name from prison table
     $query6 = "SELECT * FROM prisoner WHERE prisoner_id like '$search_box%'";
     $result6 = mysqli_query($conn,$query6);
    
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
   	   if(mysqli_num_rows($result6)==0){
   	   	  echo '<tr><td colspan="4">No Prisoner Found</td></tr>';
   	   }
   	   else{
   	   	  while($row6 = mysqli_fetch_assoc($result6)){

            $name=$row6['f_name']." ".$row6['l_name'];

            $query7 = "SELECT * FROM prison WHERE prison_id = '$row6[prison_id]'";
            $result7 = mysqli_query($conn,$query7);
            $row7 = mysqli_fetch_assoc($result7);
        
            $query8 = "SELECT * FROM cell WHERE cell_id = '$row6[cell_id]'";
            $result8 = mysqli_query($conn,$query8);
            $row8 = mysqli_fetch_assoc($result8);
            
            if(!isset($row7['prison_name'])) {
                $prison_name = "not alloted";
                $cell_no = "not alloted";
            }
            else {
                $prison_name = $row7['prison_name'];
                $cell_no = $row8['cell_no'];
            }
      		echo "<tr><td>{$name}</td><td>{$row6['prisoner_id']}</td><td>{$row6['mobile']}</td><td>{$prison_name}</td><td>{$cell_no}</td></tr>\n";
   	   }
   }
   ?>
    </tbody>
    </table>
    <?php }?>


</div>
<br>
<br>

<br><br><br><br><br><br><br>
<?php include('admin-footer.php');

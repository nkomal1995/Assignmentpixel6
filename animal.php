<!DOCTYPE html>
<html lang="en">
<head>
  <title>Display animal Record</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">


  <!-- <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> -->
  
  <!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script> -->
  <!-- <script type="text/javascript" src="jquery.dataTables.js"></script> -->
 <!-- <script type="text/javascript" src="dataTables.filter.html.js"></script> -->

  <!-- <link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>



<div class="container-fluid">
   <div class="row">
        <div class="col-sm-6"><a href="submission.php">BackTo Animal Detail</a>
  </div>
<div class="row">
  <?php
  include("config_db.php");

$fcount = mysqli_query($conn,"select * from count"); 
global $newcount;
while($data = mysqli_fetch_array($fcount))
{
    $curcount=$data['count'];
    $newcount= $curcount+1;
    $updatecount=mysqli_query($conn,"UPDATE `count` SET `count`='$newcount'");


}
  ?>
  <div class="col-sm-8">
    <label>No Of View:</label>
    <?php echo $newcount;?>   
  </div>

</div>
<div class="container">
 
  <h1 class="text-center">Animal List</h1>
  <div>
  <form action="" class="form-horizontal card" method="POST" enctype="multipart/form-data">

  <div class="form-group">
                <label  class="control-label col-sm-1" for="Lifeexpectancy">expectancy:</label>
                <div class="col-sm-1">
                <select class="form-control" name="expectancy" id="Lifeexpectancy">
                <option value="All">All</option>
                 <option value="0-1 year">0-1 year</option>
                    <option value="1-5 years">1-5 years</option>
                    <option value="5-10 years">5-10 years</option>
                    <option value="10+ years">10+ years</option>
                </select>
              </div>

              <label  class="control-label col-sm-1" for="category">category:</label>

               <div class="col-sm-1">
               
               <select class="form-control" name="category" id="category">
                    <option value="All">All</option>
                 <option value="herbivores">herbivoresr</option>
                    <option value="omnivores">omnivores</option>
                    <option value="carnivores">carnivores</option>
                  
                </select>
               </div>

           
          <label class="control-label col-sm-1" for="Date">Date:</label>
            <div class="col-sm-2">
              <input type="date" name="date1" class="form-control" id="date1">
            </div>
          
         
            <div class="col-sm-1">
               
               <select class="form-control" name="aphabetic" id="aphabetic">
                   <option selected="selected">Sort BY Alpabetically</option>
                    <option value="A_Z">A_Z</option>
                    <option value="Z_A">Z_A</option>
                  
                </select>
               </div>
          
               <div class="col-sm-1"">
                   <input class="btn btn-primary" type="Submit" value="search" name="Submit"/>
           </div>
     

            </div>
     </form>
    <div>
  <div class="table-responsive">

<table id="animaldata" class="table table-striped table-bordered">
  
<thead>  
<tr>
    <th>Sr.No.</th>
    <th>Animalname</th>
    <th>Category</th>
    <th>Description</th>
    <th>Expectancy</th>
    <!-- <th>Date</th> -->
    <th>Image</th>
</tr>
</thead>
<?php


include("config_db.php");

if(isset($_POST['Submit'])){
  $expectancy=$_POST['expectancy'];
  $category=$_POST['category'];
  $date1=$_POST['date1'];
  $aphabetic=$_POST['aphabetic'];
 if( $date1){
          $records = mysqli_query($conn,"select * from animalrecord where date = '$date1'"); 

  }
 
    //  elseif ($aphabetic='Z_A') {
    //  $records = mysqli_query($conn,"select * from animalrecord ORDER BY animalname DESC");
    //   }

    //  elseif ($aphabetic='A_Z') {
    // $records = mysqli_query($conn,"select * from animalrecord ORDER BY animalname ASC");
    // } 
    
  else{
  $records = mysqli_query($conn,"select * from animalrecord where expectancy= '$expectancy' And category= '$category'"); 
 
   }
}
else{
  $records = mysqli_query($conn,"select * from animalrecord ORDER BY id DESC");

}

while($data = mysqli_fetch_array($records))
{
?>
 <tbody>
   <tr>
    <td><?php echo $data['id']; ?></td>
    <td><?php echo $data['animalname']; ?></td>
    <td><?php echo $data['category']; ?></td>
    <td><?php echo $data['description']; ?></td>
    <td><?php echo $data['expectancy']; ?></td>
   
    <td><img src="<?php echo $data['image']; ?>" width="100" height="100"></td>
   </tr>

  </tbody>
<?php
}
?>
</table>
</div>
</div>
<!-- <script type="text/javascript">
$(document).ready(function(){
$('#animaldata').DataTable();
});  
</script> -->

</body>

</html>




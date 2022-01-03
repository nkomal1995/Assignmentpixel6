<!DOCTYPE html>
<html lang="en">
<head>
  <title>Display animal Record</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">


  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="jquery.dataTables.js"></script>
 <script type="text/javascript" src="dataTables.filter.html.js"></script>

  <link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
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
  <div class="table-responsive">

<table id="animaldata" class="table table-striped table-bordered">
  
<thead>  
<tr>
    <th>Sr.No.</th>
    <th>Animalname</th>
    <th>Category</th>
    <th>Description</th>
    <th>Expectancy</th>
    <th>Date</th>
    <th>Image</th>
</tr>
</thead>
<?php


include("config_db.php");

$records = mysqli_query($conn,"select * from animalrecord ORDER BY id DESC");



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
    <td><?php echo $data['date']; ?></td>
  
    <td><img src="<?php echo $data['image']; ?>" width="100" height="100"></td>
   </tr>
  </tbody>
<?php
}
?>
</table>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
$('#animaldata').DataTable();
});
</script>

</body>
</html>




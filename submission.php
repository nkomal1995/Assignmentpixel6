<?php
include("config_db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Simple PHP Form</title>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
 
<body>
 
<div class="container">
  <h1 class="text-center">Enter Animal Details</h1>
    <form action="" class="form-horizontal card" method="POST" enctype="multipart/form-data">
      
                <div class="form-group">
                    <label class="control-label col-sm-2" for="animalname">Animal Name:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="animalname" id="animalname" placeholder="Animal Name:" required>
                    </div>
              </div>
            <div class="form-group">
                    <label class="control-label col-sm-2" for="Category">Category:</label>
                  <div class="radio">
                    <label><input type="radio" name="category" value="herbivores"  checked>herbivores</label>
                    <label><input type="radio" name="category"  value="omnivores">omnivores</label>
                    <label><input type="radio" name="category" value="carnivores">carnivores</label>
               </div>
            </div>
           
             <div class="form-group">
                    <label class="control-label col-sm-2" for="Description">Description:</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="description" rows="5" id="Description"></textarea>
                    </div>
            </div>
            <div class="form-group">
                <label  class="control-label col-sm-2" for="Lifeexpectancy">Life expectancy:</label>
                <div class="col-sm-10">
                <select class="form-control" name="expectancy" id="Lifeexpectancy">
                    <option value="0-1 year">0-1 year</option>
                    <option value="1-5 years">1-5 years</option>
                    <option value="5-10 years">5-10 years</option>
                    <option value="10+ years">10+ years</option>
                </select>
               </div>
            </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="Date">Date:</label>
            <div class="col-sm-10">
             <input type="date" name="date" class="form-control" id="date">
            </div>
        </div>
        <div class="form-group">
            <label class=" form-label control-label col-sm-2" for="formFileLg">Image:</label>
            <div class="col-sm-10">
             <input class="form-control form-control-lg" name="imageUpload" id="formFileLg" type="file" required>
            </div>
      </div>
     
       <div class="form-group">
         <label class=" form-label control-label col-sm-2" for="formFileLg">Verfiy:</label>
         <div class="col-sm-10">
            <div class="g-recaptcha" data-sitekey="6LdvfOgdAAAAAP31_wxcxsEP8abdKI2NfrlJvYA1"></div>
          </div> 
      </div>
      <div class="form-group">
          <div class="col-sm-10 text-center">
           <input class="btn btn-primary" type="Submit" name="Submit"/>
           </div>
      </div>
 </form>
 
  <?php
 
  if(isset($_POST['Submit'])){
    $animalname=$_POST['animalname'];
    $category=$_POST['category'];
    $description=$_POST['description'];
    $expectancy=$_POST['expectancy'];
    $date=$_POST['date'];
    // $image=$_POST['imageUpload'];
    $Get_image_name = $_FILES['imageUpload'];
    //$image = addslashes($Get_image_name);
    //print_r($Get_image_name);
    $filename=$Get_image_name['name'];
    $fileerr=$Get_image_name['error'];
    $filetemp=$Get_image_name['tmp_name'];

    $filetxt=explode('.',$filename);
    $filechk=strtolower(end($filetxt));

    $filestor=array('png','jpg','jpeg');
    if(in_array($filechk,$filestor)){
      $destfile='images/'. $filename;
      move_uploaded_file($filetemp,$destfile);
    }
    // $filetemp=$Get_image_name['tmp_name'];

    // $image=basename( $_FILES["imageUpload"]["name"],".jpg");
  
    $secretk="6LdvfOgdAAAAAKVCtygycj_-5PmBdGFmX78YlZnB";
    $responsek=$_POST['g-recaptcha-response'];
    $uip=$_SERVER['REMOTE_ADDR'];
    $url="https://www.google.com/recaptcha/api/siteverify?secret=$secretk&response=$responsek&remoteip=$uip";
    $responce=file_get_contents($url);
    $responce=json_decode($responce);
    if($responce->success){
      //echo "verfify";
      $sql="INSERT INTO `animalrecord` (`id`, `animalname`, `category`, `description`, `expectancy`, `date`,`image`) VALUES (NULL, '$animalname', '$category ', '$description', '$expectancy', '$date',' $destfile')";
      $outp=mysqli_query($conn,$sql);
      if($outp){
      // echo "data inserted sucessufuly";
      echo '<script>alert("Data inserted sucessufuly")</script>';
     
      header( "Refresh:0; url=animal.php");
       }
      else{
          echo "Data is not Inserted";
  
       }

  }
  else{
      echo '<script>alert("Please Verfify Captcha")</script>';

   }
 }
mysqli_close($conn);
  ?>
  </div>
</body>
</html>
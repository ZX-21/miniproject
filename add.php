<?php
require_once 'config/db.php';

if (isset($_REQUEST["btn_insert"])) {
    $id = $_REQUEST['txt_id'];
    $size = $_REQUEST['txt_size'];
    $bed = $_REQUEST['txt_bed'];
    $status = $_REQUEST['txt_status'];

    if (empty($id)) {
        $errorMsg = "Please enter id room";
    } else if (empty($size)) {
        $errorMsg = "Please enter size";
    } else if (empty($bed)) {
        $errorMsg = "Please enter bed";
    } else if (empty($status)) {
        $errorMsg = "Please enter status";
    } else {
        try {
            if (!isset($errorMsg)) {
                $insert_stmt = $conn->prepare("INSERT INTO room(id_room, size ,bed, status) VALUES (:aid , :asize, :abed, :astatus) ");
                $insert_stmt->bindParam("aid", $id);
                $insert_stmt->bindParam("asize", $size);
                $insert_stmt->bindParam("abed", $bed);
                $insert_stmt->bindParam("astatus", $status);
                if ($insert_stmt->execute()) {
                    $insertMsg = "Insert Successfully...";
                    header("refresh:1;admin.php");
                }
            }
        }catch(PDOException $e) {
           echo $e->getMessage();
    }
    }
    }

?>

<!doctype html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Add data</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


 <div class="container">
 <div class="display-3 text-center">เพิ่มข้อมูล</div>

 <?php 
 if (isset($errorMsg)) {
 ?>
 <div class="alert alert-danger">
    <strong?>Wrong! <?php echo $errorMsg; ?></strong>
 </div>
 <?php } ?>

 <?php 
 if (isset($insertMsg)) {
 ?>
 <div class="alert alert-success">
    <strong?>Success! <?php echo $insertMsg; ?></strong>
 </div>
 <?php } ?>

 <form method="post" class="form-horizontal">

<div class="form-group mt-3">
<div class="row text-center">
   <label for="id" class="col-sm-3 control-label">Id_room</label>
   <div class="col-sm-6">
       <input type="number" name="txt_id" class="form-control" placeholder="Enter ID_room....">
   </div>
</div>
</div>

 <div class="form-group mt-3">
 <div class="row text-center">
    <label for="name" class="col-sm-3 control-label">Size</label>
    <div class="col-sm-6 text">
        <input type="text" name="txt_size" class="form-control" placeholder="Enter Size....">
    </div>
 </div>
 </div>

<div class="form-group mt-3">
<div class="row text-center">
   <label for="unit" class="col-sm-3 control-label">bed</label>
   <div class="col-sm-6">
       <input type="text" name="txt_bed" class="form-control" placeholder="Enter bed....">
   </div>
</div>
</div>

<div class="form-group mt-3">
<div class="row text-center">
   <label for="price" class="col-sm-3 control-label">Status</label>
   <div class="col-sm-6">
       <input type="text" name="txt_status" class="form-control" placeholder="Enter Status....">
   </div>
</div>
</div>
<div class="form-group">
   <div class="col-dm-offset-3 col-sm mt-3 text-center">
       <input type="submit" name="btn_insert" class="btn btn-success" value="Insert">
       <a href="admin.php" class="btn btn-danger">Cancel</a>
   </div>
</div>
</form>
 </div>
</body>
</html>
<?php
require_once 'config/db.php';
if (isset($_REQUEST["update_id"])) {
    try {
        $id = $_REQUEST["update_id"];
        $select_stmt = $conn->prepare("SELECT * FROM room WHERE id = :aid");
        $select_stmt->bindParam(":aid", $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            $size = $row['size'];
            $bed = $row['bed'];
            $status = $row['status'];
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


if (isset($_POST["btn_update"])) {
    $size_up = $_POST["txt_size"];
    $bed_up = $_POST["txt_bed"];
    $status_up = $_POST["txt_status"];

    if (empty($size_up)) {
        $errorMsg = "Please enter size";
    } else if (empty($bed_up)) {
        $errorMsg = "Please enter bed";
    } else if (empty($status_up)) {
        $errorMsg = "Please enter status";
    } else {
        try {
            if (!isset($errorMsg)) {
                $id_up = $_REQUEST["update_id"]; 
                $update_stmt = $conn->prepare("UPDATE room SET size = :size_up, bed = :bed_up, status = :status_up WHERE id = :id_up");
                $update_stmt->bindParam(":size_up", $size_up);
                $update_stmt->bindParam(":bed_up", $bed_up);
                $update_stmt->bindParam(":status_up", $status_up);
                $update_stmt->bindParam(":id_up", $id_up);

                if ($update_stmt->execute()) {
                    $updateMsg = "Update successfully";
                    header("refresh:1;admin.php");
                }
            }
        } catch(PDOException $e) {
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
 <title>Update data</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


 <div class="container">
 <div class="display-3 text-center">แก้ไขข้อมูล</div>

 <?php 
 if (isset($errorMsg)) {
 ?>
 <div class="alert alert-danger">
    <strong?>Wrong! <?php echo $errorMsg; ?></strong>
 </div>
 <?php } ?>

 <?php 
 if (isset($updateMsg)) {
 ?>
 <div class="alert alert-success">
    <strong?>Success! <?php echo $updateMsg; ?></strong>
 </div>
 <?php } ?>

 <form method="post" class="form-horizontal">

 <div class="form-group mt-3">
 <div class="row text-center">
    <label for="name" class="col-sm-3 control-label">Size</label>
    <div class="col-sm-6 text">
        <input type="text" name="txt_size" class="form-control" value="<?php echo $size; ?>">
    </div>
 </div>
 </div>

<div class="form-group mt-3">
<div class="row text-center">
   <label for="unit" class="col-sm-3 control-label">bed</label>
   <div class="col-sm-6">
       <input type="text" name="txt_bed" class="form-control" value="<?php echo $bed; ?>">
   </div>
</div>
</div>

<div class="form-group mt-3">
<div class="row text-center">
   <label for="price" class="col-sm-3 control-label">status</label>
   <div class="col-sm-6">
       <input type="text" name="txt_status" class="form-control" value="<?php echo $status; ?>">
   </div>
</div>
</div>
<div class="form-group">
   <div class="col-dm-offset-3 col-sm mt-3 text-center">
       <input type="submit" name="btn_update" class="btn btn-success" value="Update">
       <a href="admin.php" class="btn btn-danger">Cancel</a>
   </div>
</div>
</form>
 </div>
</body>
</html>
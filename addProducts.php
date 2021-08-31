<?php
session_start();

if(empty($_SESSION['userId']))
	header('Location: index.html');

require __DIR__.'/classes/Database.php';
require __DIR__.'/classes/JwtHandler.php';

$db_connection	= new Database();
$conn 			= $db_connection->dbConnection();

if(isset($_POST['submit']))	{
	
	$name 			= $_POST['name'];
	$price 			= $_POST['price'];
	$description	= $_POST['description'];
	
	$insert_query	= "INSERT INTO products (`name`,`price`,`description`,`add_by_user`) VALUES ('".$name."','".$price."','".$description."','".$_SESSION['userId']."')";
	
	$insert_stmt 	= $conn->prepare($insert_query);
	
	$insert_stmt->execute();
	
	$productId 		= $conn->lastInsertId();
	
	if(isset($productId))	{
		echo '<script>alert("Success");
					  window.location = "dashboard.php";
			</script>';
	}
	
}
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Dashboard</title>
	  <link href="dash/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
      <link href="dash/css/bootstrap.min.css" rel="stylesheet">
      <link href="dash/css/plugins/toastr/toastr.min.css" rel="stylesheet">
      <link href="dash/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
      <link href="dash/css/plugins/c3/c3.min.css" rel="stylesheet">
      <link href="dash/css/animate.css" rel="stylesheet">
      <link href="dash/css/style.css" rel="stylesheet">
      <script type="text/javascript" src="dash/js/date_time.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
   </head>
   <body>
       <div id="wrapper">
	   <?php include("left_menu.php"); ?>
         <div id="page-wrapper" class="gray-bg">
            <?php include("header.php"); ?>
            <div class="row wrapper border-bottom white-bg page-heading">
               <div class="col-lg-8">
                  <h2>Products</h2>
                  <ol class="breadcrumb">
                     <li>
                        <a href="dashboard.php">Home</a>
                     </li>
                     <li class="active">
                        <strong>Products</strong>
                     </li>
                  </ol>
               </div>
               <div class="col-lg-2">
                  <a href="addexpensives"><button type="button" class="btn btn-primary btn-xs btn-block">Add Products</button></a>
               </div>
               <div class="col-lg-2">
                  <a onclick="goBack()" ><button type="button" class="btn btn-danger btn-xs btn-block">Back</button></a>
               </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight ecommerce">
               <div class="row">
                  <div class="col-lg-12">
				  <fieldset class="form-horizontal">
					<form method="post" autocomplete="off">
                     <div class="ibox">
                        <div class="ibox-content">
							<div class="ibox">
								<div class="ibox-title">
									<h5>Product Details</h5>
									<div class="ibox-tools">
										<a class="collapse-link">
											<i class="fa fa-chevron-up"></i>
										</a>
									</div>
								</div>
								<div class="ibox-content">  
									<div class="form-group">												
										<div class="col-sm-4">
											<label>Product Name</label>								
											<input type="text" class="form-control" name="name" placeholder="Product Name" />   
										</div>	
										<div class="col-sm-4">
											<label>product Price</label>								
											<input type="text" class="form-control" name="price" placeholder="Price" />
										</div>	
										<div class="col-sm-4">
											<label>Description</label>
											<textarea class="form-control" name="description" placeholder="Description"></textarea>
										</div>
									</div>
									<div class="form-group pull-right">
										<input name="submit" type="submit" class="btn btn-submit btn-xs btn-primary" />
									</div>
								</div>
							</div>
                        </div>
                     </div>
					 </form>
				  </fieldset>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Mainly scripts -->
      <script src="dash/js/jquery-3.1.1.min.js"></script>
      <script src="dash/js/bootstrap.min.js"></script>
      <script src="dash/js/plugins/metisMenu/jquery.metisMenu.js"></script>
      <script src="dash/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
      <!-- Flot -->
      <script src="dash/js/plugins/flot/jquery.flot.js"></script>
      <script src="dash/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
      <script src="dash/js/plugins/flot/jquery.flot.spline.js"></script>
      <script src="dash/js/plugins/flot/jquery.flot.resize.js"></script>
      <script src="dash/js/plugins/flot/jquery.flot.pie.js"></script>
      <!-- Peity -->
      <script src="dash/js/plugins/peity/jquery.peity.min.js"></script>
      <script src="dash/js/demo/peity-demo.js"></script>
      <!-- Custom and plugin javascript -->
      <script src="dash/js/inspinia.js"></script>
      <script src="dash/js/plugins/pace/pace.min.js"></script>
      <!-- jQuery UI -->
      <script src="dash/js/plugins/jquery-ui/jquery-ui.min.js"></script>
      <!-- GITTER -->
      <script src="dash/js/plugins/gritter/jquery.gritter.min.js"></script>
      <!-- Sparkline -->
      <script src="dash/js/plugins/sparkline/jquery.sparkline.min.js"></script>
      <!-- Sparkline demo data  -->
      <script src="dash/js/demo/sparkline-demo.js"></script>
      <!-- d3 and c3 charts -->
      <script src="dash/js/plugins/d3/d3.min.js"></script>
      <script src="dash/js/plugins/c3/c3.min.js"></script>
      <!-- Toastr -->
      <script src="dash/js/plugins/toastr/toastr.min.js"></script>
   </body>
</html>
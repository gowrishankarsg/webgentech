<?php
session_start();
if(empty($_SESSION['userId']))
	header('Location: index.html');

require __DIR__.'/classes/Database.php';
require __DIR__.'/classes/JwtHandler.php';

$db_connection = new Database();
$conn = $db_connection->dbConnection();
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
                        <a href="dashboard">Home</a>
                     </li>
                     <li class="active">
                        <strong>Products</strong>
                     </li>
                  </ol>
               </div>
               <div class="col-lg-2">
                  <a href="addProducts.php"><button type="button" class="btn btn-primary btn-xs btn-block">Add Products</button></a>
               </div>
               <div class="col-lg-2">
                  <a onclick="goBack()" ><button type="button" class="btn btn-danger btn-xs btn-block">Back</button></a>
               </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight ecommerce">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="ibox">
                        <div class="ibox-content">
                           <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover dataTables-example" >
                                 <thead>
                                    <tr>
                                       <th>S No</th>
                                       <th>Product</th>
                                       <th>Price</th>
                                       <th>Description</th>
                                       <th>Created</th>
                                       <th>Updated</th>
                                       <th class="text-right" data-sort-ignore="true">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $i=0;
									   
									   $fetchProducts =  "SELECT * FROM products WHERE add_by_user = '".$_SESSION['userId']."' ORDER BY productId DESC";
									   $query_stmt = $conn->prepare($fetchProducts);
									   $query_stmt->execute();
									   
									   if($query_stmt->rowCount()) {
                                       while($result = $query_stmt->fetch(PDO::FETCH_ASSOC)) 
                                       {
                                       	   $i++;
                                    ?>
                                    <tr>
                                       <td><?php echo $i; ?></td>
                                       <td><?php echo $result['name']; ?></td>
                                       <td><?php echo $result['price']; ?></td>
                                       <td><?php echo $result['description']; ?></td>
                                       <td><?php echo $result['created_at'] ;?></td>
                                       <td><?php echo $result['updated_at'] ;?></td>
                                       <td class="text-center">
                                          <div class="btn-group ">
                                             <a href="editProducts.php?pId=<?php echo $result['productId'] ?>"><button class="btn-warning btn btn-xs">Update</button></a>
                                             <a href="deleteProduct.php?pId=<?php echo $result['productId'] ?>"><button class="btn-primary btn btn-xs">Delete</button></a>
                                          </div>
                                       </td>
                                    </tr>
									   <?php } } ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Mainly scripts -->
      <script src="dash/js/jquery-3.1.1.min.js"></script>
      <script src="dash/js/plugins/dataTables/datatables.min.js"></script>
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
	   <script>
         $(document).ready(function(){
             $('.dataTables-example').DataTable({
                 pageLength: 10,
                 responsive: true,
                 dom: '<"html5buttons"B>lTfgitp',
                 buttons: [
                     {extend: 'csv', title: 'Product List'},
                     {extend: 'excel', title: 'Product List'},
                     {extend: 'pdf', title: 'Product List'},
         
                     {extend: 'print',
                      customize: function (win){
                             $(win.document.body).addClass('white-bg');
                             $(win.document.body).css('font-size', '10px');
         
                             $(win.document.body).find('table')
                                     .addClass('compact')
                                     .css('font-size', 'inherit');
                     }
                     }
                 ]
         
             });
         
         });
         
      </script>
   </body>
</html>
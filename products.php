<?php
include_once 'products_crud.php';
include_once 'session.php';
?>

<!DOCTYPE html>
<html>
<head>
    <style>
  body {
    background-image: url("wallpaper.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
    background-attachment: fixed;
  }

  @media (max-width: 768px) {
    body {
      background-size: contain;
    }
  }
  
</style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dog Food & Supplies System : Products</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">


  


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">


    

</head>
<body>

  <?php include_once 'nav_bar.php'; ?>
  <?php if ($pos === "Admin") { ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
          <div class="page-header">
            <h2>Create New Product</h2>
          </div>

          <form action="products.php" method="post" class="form-horizontal">

            <div class="form-group">
              <label for="productid" class="col-sm-3 control-label">ID</label>
              <div class="col-sm-9">
                <input name="pid" type="text" class="form-control" id="productid" placeholder="Product ID" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_product_id']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="productname" class="col-sm-3 control-label">Name</label>
              <div class="col-sm-9">
                <input name="name" type="text" class="form-control" id="productname" placeholder="Product Name" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="productprice" class="col-sm-3 control-label">Price</label>
              <div class="col-sm-9">
                <input name="price" type="text" class="form-control" id="productprice" placeholder="Product Price" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>" required>
              </div>
            </div>
                <div class="form-group">
          <label for="brand" class="col-sm-3 control-label">Brand</label>
          <div class="col-sm-9">
          <input name="brand" type="text" class="form-control" id="brand" placeholder=Brand value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_brand']; ?>" required>
        </div>
      </div>
      <div class="form-group">
          <label for="type" class="col-sm-3 control-label">Type</label>
          <div class="col-sm-9">
          <select name="type" class="form-control" id="type" required>
            <option value="">Please select</option>
        <option value="Food" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Food") echo "selected"; ?>>Food</option>
        <option value="Treat" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Treat") echo "selected"; ?>>Treat</option>
        <option value="Rawhide & Chews" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Rawhide & Chews") echo "selected"; ?>>Rawhide & Chews</option>
        <option value="Fleas & Ticks" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Fleas & Ticks") echo "selected"; ?>>Fleas & Ticks</option>
        <option value="Health Care" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Health Care") echo "selected"; ?>>Health Care</option>
        <option value="Grooming Supplies" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Grooming Supplies") echo "selected"; ?>>Grooming Supplies</option>
      </select>
        </div>
        </div>
        <div class="form-group">
          <label for="description" class="col-sm-3 control-label">Description</label>
          <div class="col-sm-9">
          <input name="desc" type="text" class="form-control" id="productdescription" placeholder="Description" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_desc']; ?>" required>
        </div>
      </div>
      <div class="form-group">
          <label for="stock" class="col-sm-3 control-label">Quantity</label>
          <div class="col-sm-9">
          <input name="stock" type="text" class="form-control" id="stock" placeholder="Stock" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_stock']; ?>" required>
        </div>
      </div>


            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-9">
                <?php if (isset($_GET['edit'])) { ?>
                  <input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_id']; ?>">
                  <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Update</button>
                <?php } else { ?>
                  <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Create</button>
                <?php } ?>
                <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span>Clear</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  <?php } ?>






  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Product List</h2>
      </div>
      <table id="product-table" class="table table-striped table-bordered">
        <thead>
          <tr style="font-weight:bold; background-color: #;">
            <th>Product ID</th>
            <th>Name</th>
            <th>Price (RM)</th>
            <th>Brand</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Read
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("select * from tbl_products_a189016_pt2");
            $stmt->execute();
            $result = $stmt->fetchAll();
          } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
          foreach ($result as $readrow) {
          ?>
            <tr>
              <td><?php echo $readrow['fld_product_id']; ?></td>
              <td><?php echo $readrow['fld_product_name']; ?></td>
              <td><?php echo $readrow['fld_product_price']; ?></td>
              <td><?php echo $readrow['fld_product_brand']; ?></td>
              <td>
                <button data-href="products_details.php?pid=<?php echo $readrow['fld_product_id']; ?>" class="btn btn-warning btn-xs btn-details" role="button">Details</button>

                <?php if ($pos === "Admin" ) { ?>
                  <a href="products.php?edit=<?php echo $readrow['fld_product_id']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
                  <a href="products.php?delete=<?php echo $readrow['fld_product_id']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
                <?php } ?>
              </td>
            </tr>
          <?php
          }
          $conn = null;
          ?>
        </tbody>
      </table>
    </div>
  </div>


 <div class="bs-example">

  <div id="myModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Product Details</h3>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

</div>




  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <script src="js/bootstrap.min.js"></script>

  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>


<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>



 <script>
  $(document).ready(function() {

    var table = $('#product-table').DataTable({
      "order": [[1, "asc"]], 
      "pagingType": "full_numbers", 
      "pageLength": 5, 
      "lengthMenu": [[5, 10, 20, 30, -1], [5, 10, 20, 30, "All"]], 
      "searching": true, 
      "columnDefs": [{ "searchable": false, "targets": 2 }],  
      "dom": 'lBfrtip', 
      "buttons": [
        {
          extend: 'excelHtml5',
          text: 'Excel',
          exportOptions: {
            columns: [0, 1, 2, 3]
          },
          className: 'btn btn-primary' 
        }
      ]
    });



    $('#product-table tbody').on('click', 'button.btn-details', function() {
      var dataURL = $(this).attr('data-href');
      $('.modal-body').load(dataURL, function() {

        $('#myModal').modal({
        backdrop: 'static', // Prevents modal from closing when clicking outside
        keyboard: false // Disables closing the modal using the escape key
      });



      });
    });


    var exportContainer = $('<div class="export-container"></div>').insertAfter('.dataTables_info');
    table.buttons().container().appendTo(exportContainer);


    $('.export-container .btn-primary').removeClass('btn-secondary').addClass('btn-primary');

  });
</script>


</body>
</html>

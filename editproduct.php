<?php

include_once "connectdb.php";
								
session_start();

if($_SESSION['useremail']=="" OR $_SESSION['role']=="User"){
		header("location:index.php");
}

include_once "header.php";

$id = $_GET['id'];

$select = $pdo->prepare("select * from tbl_product where pid=$id");
$select->execute();
$row=$select->fetch(PDO::FETCH_ASSOC);

$id_db = $row['pid'];

$productname_db = $row['pname'];

$category_db = $row['pcategory'];

$purchaseprice_db = $row['purchaseprice'];

$saleprice_db = $row['saleprice'];

$stock_db = $row['pstock'];

$description_db = $row['pdescription'];

$productimage_db = $row['pimage'];

//print_r($row);

if(isset($_POST['btnupdate'])){

    $productname_txt = $_POST['txtpname'];

    $category_txt = $_POST['txtselect_option'];

    $purchaseprice_txt = $_POST['txtpprice'];

    $saleprice_txt = $_POST['txtsaleprice'];

    $stock_txt = $_POST['txtstock'];

    $description_txt = $_POST['txtdescription'];

    $f_name = $_FILES['myfile'] ['name'];

    if(!empty($f_name)){

        $f_tmp = $_FILES['myfile']['tmp_name'];

        $f_size = $_FILES['myfile']['size'];
    
        $f_extension = explode('.',$f_name);
    
        $f_extension = strtolower(end($f_extension));
    
         $f_newfile = uniqid().'.'.$f_extension;
        $store = "productimages/".$f_newfile;
    
        if($f_extension == "jpg" || $f_extension == "jpeg" || $f_extension == "png"|| $f_extension == "gif")
        {
            if($f_size>=1000000){
             //   echo 'Max file should be 1MB';
                $error = '<script type="text/javascript">
                    jQuery(function validation() {
                    Swal.fire({
                        position: \'center\',
                        icon: \'error\',
                        title: "Error!",
                        text: \'Max File should be 1MB\',
                        showConfirmButton: false,
                        timer: 1500
                        });
                    });
                </script>';
    
                echo $error;
                
            }else{
                if(move_uploaded_file($f_tmp,$store)){
                    
                    $f_newfile;
                    
                    if(!isset($error)){
                        $update = $pdo->prepare("update tbl_product set pname=:pname, pcategory=:pcategory, purchaseprice=:pprice, saleprice=:saleprice, pstock=:pstock, pdescription=:pdescription,pimage=:pimage where pid=$id");

                        $update->bindParam(':pname',$productname_txt);
                        $update->bindParam(':pcategory',$category_txt);
                        $update->bindParam(':pprice',$purchaseprice_txt);
                        $update->bindParam(':saleprice',$saleprice_txt);
                        $update->bindParam(':pstock',$stock_txt);
                        $update->bindParam(':pdescription',$description_txt);

                        $update->bindParam(':pimage',$f_newfile);
    
                        if($update->execute()){
                            echo '<script type="text/javascript">
                            jQuery(function validation() {
                             Swal.fire({
                                  position: \'center\',
                                  icon: \'success\',
                                  title: "Add Product Successfull",
                                  text: \'Product Added\',
                                  showConfirmButton: false,
                                  timer: 1500
                                });
                            });
                        </script>';
                        }else{
                            echo '<script type="text/javascript">
                            jQuery(function validation() {
                             Swal.fire({
                                  position: \'center\',
                                  icon: \'error\',
                                  title: "Error!",
                                  text: \'Product is not Added\',
                                  showConfirmButton: false,
                                  timer: 1500
                                });
                            });
                        </script>';
                        }
                    }
                }
            }
        }else{
           // echo "only jpg,jpeg,png and gif can be uploaded";
            $error = '<script type="text/javascript">
                    jQuery(function validation() {
                    Swal.fire({
                        position: \'center\',
                        icon: \'error\',
                        title: "Error!",
                        text: \'only jpg,jpeg,png and gif can be uploaded\',
                        showConfirmButton: false,
                        timer: 1500
                        });
                    });
                </script>';
    
                echo $error;
        }

    }else{
        
        $update = $pdo->prepare("update tbl_product set pname=:pname, pcategory=:pcategory, purchaseprice=:pprice, saleprice=:saleprice, pstock=:pstock, pdescription=:pdescription,pimage=:pimage where pid=$id");

        $update->bindParam(':pname',$productname_txt);
        $update->bindParam(':pcategory',$category_txt);
        $update->bindParam(':pprice',$purchaseprice_txt);
        $update->bindParam(':saleprice',$saleprice_txt);
        $update->bindParam(':pstock',$stock_txt);
        $update->bindParam(':pdescription',$description_txt);
        $update->bindParam(':pimage',$productimage_db);

        if($update->execute()){

            $error = '<script type="text/javascript">
            jQuery(function validation() {
            Swal.fire({
                position: \'center\',
                icon: \'success\',
                title: "Product update successful",
                text: \'Updated\',
                showConfirmButton: false,
                timer: 1500
                });
            });
        </script>';

        echo $error;

        }else{

            $error = '<script type="text/javascript">
            jQuery(function validation() {
            Swal.fire({
                position: \'center\',
                icon: \'error\',
                title: "update fail!",
                text: \'Try Again\',
                showConfirmButton: false,
                timer: 1500
                });
            });
        </script>';

        echo $error;

        }

    }

}

$select = $pdo->prepare("select * from tbl_product where pid=$id");
$select->execute();
$row=$select->fetch(PDO::FETCH_ASSOC);

$id_db = $row['pid'];

$productname_db = $row['pname'];

$category_db = $row['pcategory'];

$purchaseprice_db = $row['purchaseprice'];

$saleprice_db = $row['saleprice'];

$stock_db = $row['pstock'];

$description_db = $row['pdescription'];

$productimage_db = $row['pimage'];

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Product
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!--------------------------
          | Your Page Content Here |
          -------------------------->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">
                    <a href="productlist.php" class="btn btn-primary" role="button">
                        Back To Product List
                    </a>
                </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           

            <form action="" method="post" name="formproduct" enctype="multipart/form-data">
            
                <div class="box-body">

                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Product Name</label>
                              <input type="text" class="form-control" name="txtpname" value="<?php echo $productname_db; ?>" placeholder="Enter Name" required>
                          </div>
                          <div class="form-group">
                              <label>Category</label>
                              <select class="form-control" name="txtselect_option">
                                <option value="" disabled selected>Select Category</option>
                                <?php 
                                $select = $pdo->prepare("select * from tbl_category order by catid desc");
                                $select->execute();
                                while($row=$select->fetch(PDO::FETCH_ASSOC)){
                                    extract($row);
                                ?>
                                
                                <option <?php if($row['category']==$category_db) { ?> selected="selected" <?php } ?> >
                                
                                    <?php echo $row['category']; ?>
                            
                                </option>

                                <?php
                                }
                                  
                                ?>
                                </select>
                          </div>
                          <div class="form-group">
                              <label>Purchase Price</label>
                              <input type="number" min="1" step="1" class="form-control" name="txtpprice" value="<?php echo $purchaseprice_db; ?>" placeholder="Enter Purchase Price" required>
                          </div>
                          <div class="form-group">
                              <label>Sale Price</label>
                              <input type="number" min="1" step="1" class="form-control" name="txtsaleprice" value="<?php echo $saleprice_db; ?>" placeholder="Enter ..." required>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Stock</label>
                              <input type="number" min="1" step="1" class="form-control" name="txtstock" value="<?php echo $stock_db; ?>" placeholder="Enter ..." required>
                          </div>
                          <div class="form-group">
                              <label>Description</label>
                              <textarea class="form-control" name="txtdescription"  rows="4" placeholder="Enter ..." ><?php echo $description_db; ?>    </textarea>
                          </div>
                          <div class="form-group">
                              <label>Product Image</label>
                              <img src="productimages/<?php echo $productimage_db; ?>" class="img-responsive" width="50px" height="50px">
                              <input type="file" class="input-group" name="myfile" value="" >
                              <p>upload image</p>
                          </div>

                      </div>
                    </div>
                    
                    <div class="box-footer">
            
                        <button type="submit" class="btn btn-warning" name="btnupdate">Update Product</button>

                    </div>
            </form>
		</div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php

include_once "footer.php"

?>

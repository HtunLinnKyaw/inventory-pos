<?php

include_once "connectdb.php";

session_start();

if($_SESSION['useremail']=="" OR $_SESSION['role']=="User"){
    header("location:index.php");
}

include_once "header.php";

// add category data to database

if(isset($_POST['btnsave'])){
    $category = $_POST['txtcategory'];
    
   // echo $category;
    
    if(empty($category)){
        $error ='<script type="text/javascript">
                jQuery(function validation() {
                 Swal.fire({
                      position: \'center\',
                      icon: \'warning\',
                      title: "Error",
                      text: \'Please Fill the Field\',
                      showConfirmButton: false,
                      timer: 1500
                    });
                });
            </script>';
        
        echo $error;
    }
    
    if(!isset($error)){
        
        $insert = $pdo->prepare("insert into tbl_category(category) values(:category)");
        
        $insert->bindparam(':category',$category);
        
        if($insert->execute()){
            echo '<script type="text/javascript">
                jQuery(function validation() {
                 Swal.fire({
                      position: \'center\',
                      icon: \'success\',
                      title: "Good job!",
                      text: \'Your Category is Added\',
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
                      icon: \'warning\',
                      title: "Error",
                      text: \'query fail\',
                      showConfirmButton: false,
                      timer: 1500
                    });
                });
            </script>';
        }
        
    }
}

// btnadd end

// btnupdate start 

if(isset($_POST['btnupdate'])){
    $category = $_POST['txtcategory'];
    $id = $_POST['txtid'];
    
    if(empty($category)){
        $errorupdate = '<script type="text/javascript">
                jQuery(function validation() {
                 Swal.fire({
                      position: \'center\',
                      icon: \'warning\',
                      title: "Error",
                      text: \'Field is empty,Please enter category!\',
                      showConfirmButton: true,
                      timer: 2000
                    });
                });
            </script>'; 
        
        echo $errorupdate;
    }
    
    if(!isset($errorupdate)){
        $update = $pdo->prepare("update tbl_category set category=:category where catid=".$id);
        
        $update->bindParam(':category',$category);
        
        if($update->execute()){
             echo '<script type="text/javascript">
                jQuery(function validation() {
                 Swal.fire({
                      position: \'center\',
                      icon: \'success\',
                      title: "Updated",
                      text: \'Your Category is Updated\',
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
                      icon: \'warning\',
                      title: "Error",
                      text: \'Your Category is not Updated\',
                      showConfirmButton: false,
                      timer: 1500
                    });
                });
            </script>';
        }
    }
    
} 

// btnupate end

// btndelete start

if(isset($_POST['btndelete'])){
    
    $delete = $pdo->prepare("delete from tbl_category where catid=".$_POST['btndelete']);
    
    if($delete->execute()){
         echo '<script type="text/javascript">
                jQuery(function validation() {
                 Swal.fire({
                      position: \'center\',
                      icon: \'success\',
                      title: "Delete!",
                      text: \'Your category is deleted\',
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
                      title: "Error",
                      text: \'Your Category is not deleted\',
                      showConfirmButton: false,
                      timer: 1500
                    });
                });
            </script>';
    }
    
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Category
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
              <h3 class="box-title">Category Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
                <div class="box-body">
                 
                  <form role="form" action="" method="post">
                  <?php 
                      
                    if(isset($_POST['btnedit'])){
                        
                        $select = $pdo->prepare("select * from tbl_category where catid=".$_POST['btnedit']);
                        $select->execute();
                        
                        if($select){
                        $row = $select->fetch(PDO::FETCH_OBJ);
                              echo '<div class="col-md-4">
                               <div class="form-group">
                                  <label>Category</label>
                                  <input type="hidden" class="form-control" name="txtid" value="'.$row->catid.'" placeholder="Enter Category">
                                  <input type="name" class="form-control" name="txtcategory" value="'.$row->category.'" placeholder="Enter Category">
                                </div>


                                <button type="submit" class="btn btn-warning" name="btnupdate">Update</button>

                            </div>';   
                        }
                        
                    }else{
                        echo '<div class="col-md-4">
                               <div class="form-group">
                                  <label>Category</label>
                                  <input type="name" class="form-control" name="txtcategory"  placeholder="Enter Category">
                                </div>


                                <button type="submit" class="btn btn-warning" name="btnsave" >Save</button>

                            </div>';
                    }  
                      
                    ?>
                
                <div class="col-md-8">
                      <table id="tablecategory" class="table table-striped">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Category</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                              </tr>
                          </thead>
                          <tbody>
                             <?php 
                              
                              $select = $pdo->prepare("select * from tbl_category order by catid desc");
                              
                              $select->execute();
                              
                              while($row=$select->fetch(PDO::FETCH_OBJ)){
                                  
                                  echo '<tr>
                                            <td>'.$row->catid.'</td>
                                            <td>'.$row->category.'</td>
                                            <td>
                                                <button type="submit" value="'.$row->catid.'" class="btn btn-success" name="btnedit">Edit</button>
                                            </td>
                                            <td>
                                                <button type="submit" value="'.$row->catid.'" class="btn btn-danger" name="btndelete">Delete</button>
                                            </td>
                                        </tr>';
                                  
                              }
                              
                              
                                  
                              ?>
                          </tbody>
                      </table>
                </div>
               
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
              </div>
            </form>
          </div>

    </section>
    
</div>


<script>
    $(document).ready( function () {
    $('#tablecategory').DataTable();
    } );
</script>


<?php

include_once "footer.php"

?>

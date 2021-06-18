<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php'?>
<?php include '../lib/database.php';?>
<?php include '../helpers/format.php';?>
<?php include '../classes/customer.php';?>
<?php
    $cs = new customer();
    if(!isset($_GET['Id']) && $_GET['Id']==NULL){
        echo "<script>window.location = 'inbox.php'</script>";
    }else{
        $id = $_GET['Id'];
    }
?>
<?php  ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa danh mục</h2>
               <div class="block copyblock">
                <?php
                    $get_customer = $cs->show_customers($id);
                    if($get_customer){
                        while($result = $get_customer->fetch_assoc()){
                        
                ?>   
                    <form action="" method="post">
                        <table class="form">					
                            <tr>
                                <td>Tên</td>
                                <td></td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['Name'] ?>" name="Name" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>SĐT</td>
                                <td></td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['Phone'] ?>" name="Name" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Thành phố</td>
                                <td></td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['City'] ?>" name="Name" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Quốc gia</td>
                                <td></td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['Country'] ?>" name="Name" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Zipcode</td>
                                <td></td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['Zipcode'] ?>" name="Name" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td></td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['Email'] ?>" name="Name" class="medium" />
                                </td>
                            </tr>
    						
                        </table>
                    </form>
                <?php
                        }
                    } 
                ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>
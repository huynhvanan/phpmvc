<?php include 'inc/header.php';
include 'inc/sidebar.php';

 include '../classes/brand.php';
 include '../classes/category.php';
 include '../classes/product.php';
 ?>
<?php
    $pd = new product();
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        // $Name = $_POST['Name']; 
        $insertProduct = $pd->insert_product($_POST, $_FILES);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm sản phẩm mới</h2>
        <div class="block">
        <?php
                if(isset($insertProduct)){
                    echo $insertProduct;
                }  
                ?>               
         <form action="productadd.php" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Tên</label>
                    </td>
                    <td>
                        <input type="text" name='Name' placeholder="Nhập tên sản phẩm..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Danh mục</label>
                    </td>
                    <td>
                        <select id="select" name="danhmuc">
                            <option>------Chọn danh mục------</option>
                            <?php
                                $cat = new category();
                                $show_cate = $cat->show_category();
                                if($show_cate){
                                    while($result = $show_cate->fetch_assoc()){
                                    
                            ?>
                            <option value="<?php echo $result['Id']?>"><?php echo $result['Name']?></option>
                            <?php
                                    }
                                }
                            ?> 
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Thương hiệu</label>
                    </td>
                    <td>
                        <select id="select" name="thuonghieu">
                            <option>------Chọn thương hiệu------</option>
                            <?php
                                $brand = new brand ();
                                $show_brand = $brand->show_brand();
                                if($show_brand){
                                    while($result = $show_brand->fetch_assoc()){
                                    
                            ?>
                            <option value="<?php echo $result['Id']?>"><?php echo $result['Name']?></option>
                            <?php
                                    }
                                }
                            ?> 
   
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Mô tả</label>
                    </td>
                    <td>
                        <textarea name="mota" class="tinymce"></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Gía</label>
                    </td>
                    <td>
                        <input type="text" name="gia" placeholder="Nhập giá..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Hình ảnh</label>
                    </td>
                    <td>
                        <input type="file" name="hinhanh"/>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Loại sản phẩm</label>
                    </td>
                    <td>
                        <select id="select" name="kieu">
                            <option>Chọn loại</option>
                            <option value="1">Nổi bật</option>
                            <option value="0">Không nổi bật</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>



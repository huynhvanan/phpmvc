<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php';?>
<?php include_once '../helpers/format.php'?>
<?php
	$pd = new product();
	$fm = new Format();
	if(isset($_GET['Id'])){
		$id = $_GET['Id'];
		$deleteProduct = $pd->delete_product($id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách sản phẩm</h2>
        <div class="block">
		<?php
			if(isset($delete_product)){
				echo $delete_product;
			}
		?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Sản phẩm</th>
					<th>Gía</th>
					<th>Hình ảnh</th>
					<th>Danh mục</th>
					<th>Thương hiệu</th>
					<!-- <th>Mô tả</th> -->
					<th>Loại</th>
					<th>Thao tác</th>
				</tr>
			</thead>
			<tbody>
			<?php
				
				$pdlist = $pd->show_product();
				if($pdlist){
					$i = 0;
					while($result = $pdlist->fetch_assoc()){
						$i++;
			?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['Name'] ?></td>
					<td><?php echo $fm->format_currency($result['gia'])." "."VNĐ" ?></td>
					<td><img src="upload/<?php echo $result['hinhanh'] ?>" width="50" </td>
					<td><?php echo $result['nameDM'] ?></td>
					<td><?php echo $result['nameTH'] ?></td>
					<!-- <td><?php 
							// echo $fm->textShorten($result['mota'], 50) 
						?>	
					</td> -->
					<td><?php 
						if($result['kieu']==1){
							echo 'Nổi bật';
						}else{
							echo 'Không nổi bật';
						} 
						?></td>
					<td><a href="productedit.php?Id=<?php echo $result['Id'] ?>">Sửa</a> || <a href="?Id=<?php echo $result['Id'] ?>">Xóa</a></td>
				</tr>
			<?php
					}
				}
			?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>

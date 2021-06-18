<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php'?>
<?php
    $brand = new brand();
    if(isset($_GET['deleteId'])){
		$id = $_GET['deleteId'];
		$deleteBrand = $brand->delete_brand($id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách thương hiệu</h2>
                <div class="block">
				<?php
                    if(isset($deleteBrand)){
                        echo $deleteBrand;
                    }  
                ?>           
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Tên thương hiệu</th>
							<th>Thao tác</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$show_brand =  $brand->show_brand();
						if($show_brand){
							$i =0;
							while ($result = $show_brand->fetch_assoc()) {
								$i++;
					?>	
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['Name']; ?></td>
							<td><a href="brandedit.php?Id=<?php echo $result['Id'] ?>">Sửa</a> || <a onclick = "return confirm('Bạn có muốn xóa')" href="?deleteId=<?php echo $result['Id'] ?>">Xóa</a></td>
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


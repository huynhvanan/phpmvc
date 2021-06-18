<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php'?>
<?php
    $cat = new category();
    if(isset($_GET['deleteId'])){
		$id = $_GET['deleteId'];
		$deleteCat = $cat->delete_category($id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách danh mục</h2>
                <div class="block">
				<?php
                    if(isset($deleteCat)){
                        echo $deleteCat;
                    }  
                ?>           
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Tên danh mục</th>
							<th>Thao tác</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$show_cate =  $cat->show_category();
						if($show_cate){
							$i =0;
							while ($result = $show_cate->fetch_assoc()) {
								$i++;
					?>	
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['Name']; ?></td>
							<td><a href="catedit.php?Id=<?php echo $result['Id'] ?>">Sửa</a> || <a onclick = "return confirm('Bạn có muốn xóa')" href="?deleteId=<?php echo $result['Id'] ?>">Xóa</a></td>
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


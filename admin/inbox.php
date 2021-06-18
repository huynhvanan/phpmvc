<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../lib/database.php';?>
<?php include '../helpers/format.php';?>
<?php include '../classes/cart.php';?>
<?php
    $ct = new cart();
    if(isset($_GET['shiftId'])){
		$id = $_GET['shiftId'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$shifted = $ct->shifted($id, $time, $price);
	}
	if(isset($_GET['deleteId'])){
		$id = $_GET['deleteId'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$deleteshifted = $ct->delete_shifted($id, $time, $price);
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Hộp thư đến</h2>
                <div class="block">
				<?php
					if(isset($shifted)){
						echo $shifted;
					}
				?>
				<?php
					if(isset($deleteshifted)){
						echo $deleteshifted;
					}
				?>        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Ngày đặt hàng</th>
							<th>Sản phẩm</th>
							<th>Số lượng</th>
							<th>Gía</th>
							<th>ID khách hàng</th>
							<th>Địa chỉ</th>
							<th>Thao tác</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$ct = new cart();
							$fm = new Format();
							$i = 0;
							$get_inbox_cart = $ct->get_inbox_cart();
							if($get_inbox_cart){
								while($result = $get_inbox_cart->fetch_assoc()){
									$i++;
							
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $fm->formatDate($result['Ngay']) ?></td>
							<td><?php echo $result['Tensanpham'] ?></td>
							<td><?php echo $result['Soluong'] ?></td>
							<td><?php echo $fm->format_currency($result['Gia'])." "."VNĐ" ?></td>
							<td><?php echo $result['Id_khachhang'] ?></td>
							<td><a href="customer.php?Id=<?php echo $result['Id_khachhang']?>">Xem khách hàng</td>
							<td>
								<?php
									if($result['Trangthai']==0){
								?>
								<?php
								//  echo 'Đang xử lý';
								?>
								<a href="?shiftId=<?php echo $result['Id']?>&price=<?php echo $result['Gia']?>&time=<?php echo $result['Ngay']?>">Đang xử lý</a>
								<?php
								}elseif($result['Trangthai']==1){
								?>
								<?php
								 echo 'Đang vận chuyển';
								?>
								
								<?php
								}elseif($result['Trangthai']==2){
								?>
								<a href="?deleteId=<?php echo $result['Id']?>&price=<?php echo $result['Gia']?>&time=<?php echo $result['Ngay']?>">Xóa</a>
								<?php
									}
								}
								?>
							</td>
						</tr>
						<?php
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

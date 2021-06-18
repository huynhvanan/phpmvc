<?php
	

    include 'lib/session.php';
    // bắt buộc đăng nhập bằng tài khoản
    Session::init();
?>
<?php
	include_once 'lib/database.php';
	include_once 'classes/product.php';
	include 'helpers/format.php';

	

    spl_autoload_register(function($class){
        include_once "classes/".$class.".php";
    });
    $db = new Database();
    $fm = new Format();
    $cat = new category();
    $ct = new cart();
    $us = new user();
    $cs = new customer();
    $product = new product();

?>
<!DOCTYPE HTML>
<head>
<title>AnStore</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  	<div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/9077082265df9881c1ce.jpg" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				<form action="search.php" method="POST">
						<input type="text" placeholder="Tìm kiếm sản phẩm" name="tukhoa">
						<input type="submit" name="search_product" value="Tìm">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
							<span class="cart_title">Cart</span>
							<span class="no_product"></span>
						</a>
					</div>
			    </div>
				<?php
					
				?>
		   		<div class="login">
				   <?php
                        
                    ?>
		   	   		
		   		</div>
		 		<div class="clear">

				</div>
	 		</div>
	 		<div class="clear"></div>
 		</div>
		<div class="menu">
			<ul id="dc_mega-menu-orange" class="dc_mm-orange">
			<li><a href="index.php">Trang chủ</a></li>
			
			<li><a href="cart.php">Giỏ hàng</a></li>
			<?php
							$customer_Id = Session::get('customer_Id');
							$check_order = $ct->check_order($customer_Id);
							if($check_order==true){
								echo '<li><a href="orderdetails.php">Đơn hàng đã đặt</a></li>';
							}else{
								echo '';
							}
	 					?>
			<li><a href="profile.php">Thông tin</a></li>
			
			
			
			
	  		
	  			<div class="clear"></div>
			</ul>
		</div>
		<?php
			if(isset($_GET['Id']) && $_GET['Id']=='order'){
				$customer_Id = Session::get('customer_Id');

				// echo $customer_Id.'fdhdfhdfhdfhd';
				$insertOrder = $ct->insertOrder($customer_Id);
				$deleteCart = $ct->delete_all_data_cart();
				header('Location:success.php');
			}
			// if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
			// 	$quantity = $_POST['soluong']; 
			// 	$AddtoCart = $ct->add_to_cart($quantity, $id);
			// }
		?>
		<style>
            .box_left{
                width: 50%;
                border: 1px solid #666;
                float: left;
                padding: 4px;
            }
            .box_right{
                width: 48%;
                border: 1px solid #666;
                float: right;
                padding: 4px;
            }
			a.a_order{
				padding: 7px 30px;
				/* border: none; */
				background: red;
				font-size: 21px;
				color: #fff;
				/* margin: 20px; */
				/* cursor: pointer; */
			}
        </style>
		<fomr action="" method="POST">
		<div class="main">
    		<div class="content">
    		    <div class="section group">
                    <div class="heading">
                        <h3>Thanh toán ngoại tuyến</h3>
                    </div>       
                    <div class="clear"></div>
                    <div class="box_left">
                    <div class="cartpage">
			    	<!-- <h3 style="color:red;"><strong>Giỏ hàng của bạn</strong></h3></br> -->
					<?php
						if(isset($update_quantity_cart)){
							// echo $update_quantity_cart;
						}
					?></br>
					<?php
						if(isset($deleteCart)){
							echo $deleteCart;
						}
					?></br>
						<table class="tblone">
							<tr>
                                <th width="5%">STT</th>
								<th width="15%">Tên sản phẩm</th>
								<!-- <th width="10%">Hình ảnh</th> -->
								<th width="15%">Gía</th>
								<th width="25%">Số lượng</th>
								<th width="20%">Tổng giá</th>
								<!-- <th width="10%">Thao tác</th> -->
							</tr>
							<?php
								$get_product_cart = $ct->get_product_cart();
								if($get_product_cart){
									$subtotal = 0;
                                    $qty = 0;
                                    $i = 0;
									while($result = $get_product_cart->fetch_assoc()){
                                        $i++;
									

								
							?>
							<tr>
                                <td><?php echo $i ?></td>
								<td><?php echo $result['tensanpham'] ?></td>
								<!-- <td><img src="admin/upload/<?php echo $result['hinhanh'] ?>" alt=""/></td> -->
								<td><?php echo $fm->format_currency($result['gia'])." VND" ?></td>
								<td>
									
                                    <?php echo $result['soluong'] ?>
									
								</td>
								<td>
								<?php
									$total = $result['gia'] * $result['soluong'];
									echo $fm->format_currency($total)." VND";
								?>
								</td>
								<!-- <td><a href="?Id_giohang=<?php echo $result['Id_giohang'] ?>">Xóa</a></td> -->
							</tr>
							<?php
								$subtotal += $total;
								$qty = $qty + $result['soluong'];
								}	
							}
							?>
							
							
						</table>
						<?php
							$ckeck_cart = $ct->check_cart();
							if($ckeck_cart){
									
						?>
						
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Tạm thu : </th>
								<td><?php
										
										echo $fm->format_currency($subtotal)." VND";
										Session::set('sum',$subtotal);
										Session::set('qty',$qty);
									?></td>
							</tr>
							<tr>
								<th>Phí VAT : </th>
								<td>10% (<?php echo $fm->format_currency($vat = $subtotal * 0.1); ?>)</td>
							</tr>
							<tr>
								<th>Tổng cộng :</th>
								<td>
								<?php
									$vat = $subtotal * 0.1;
									$gtotal = $subtotal + $vat;
									echo $fm->format_currency($gtotal)." VND";
								?>
								</td>
							</tr>
					   </table>
					   <?php
						}else{
							echo 'Giỏ hàng của bạn rỗng! Vui lòng chọn mua!';
						}
					   ?>
					</div>
                    </div>
                    <div class="box_right">
                    <table class="tblone">
                        <?php
                            $id = Session::get('customer_Id');
                            $get_customers = $cs->show_customers($id);
                            if($get_customers){
                                while($result = $get_customers->fetch_assoc()){

                                
                            
                        ?>
                        <tr>
                            <td>Họ và tên</td>
                            <td></td>
                            <td><?php echo $result['Name'] ?></td>
                        </tr>
                        <tr>
                            <td>Thành phố</td>
                            <td></td>
                            <td><?php echo $result['City'] ?></td>
                        </tr>
                        <tr>
                            <td>SĐT</td>
                            <td></td>
                            <td><?php echo $result['Phone'] ?></td>
                        </tr>
                        <!-- <tr>
                            <td>Quốc gia</td>
                            <td></td>
                            <td><?php echo $result['Country'] ?></td>
                        </tr> -->
                        <tr>
                            <td>Zipcode</td>
                            <td></td>
                            <td><?php echo $result['Zipcode'] ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td></td>
                            <td><?php echo $result['Email'] ?></td>
                        </tr>
                        <tr>
                            <td>Địa chỉ</td>
                            <td></td>
                            <td><?php echo $result['Address'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3"><a href="editprofile.php">Cập nhật thông tin</a></td>
                            
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </table>
                    </div>
			    </div>	
			</div>
			<center><a href="?Id=order" class="a_order">Đặt hàng ngay</a></center>
		</div>
		</form>	
 	</div>

	<div class="footer">
   	  <div class="wrapper">	
	     <div class="section group">
		 <div class="col_1_of_4 span_1_of_4">
						<h4>Thông tin</h4>
						<ul>
						<li><a href="#">Về chúng tôi</a></li>
						<li><a href="#">Dịch vụ CSKH</a></li>
						<li><a href="#"><span>Tìm kiếm nâng cao</span></a></li>
						<li><a href="#">Đơn hàng và trả lại</a></li>
						<li><a href="#"><span>Liên hệ chúng tôi</span></a></li>
						</ul>
					</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Tại sao mua từ chúng tôi</h4>
						<ul>
						<li><a href="about.html">Về chúng tôi</a></li>
						<li><a href="faq.html">Dịch vụ CSKH</a></li>
						<li><a href="#">Chính sách bảo mật</a></li>
						<!-- <li><a href="contact.html"><span>Site Map</span></a></li>
						<li><a href="preview-2.html"><span>Search Terms</span></a></li> -->
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Tài khoản của tôi</h4>
						<ul>
							<li><a href="contact.php">Đăng nhập</a></li>
							<li><a href="index.php">Xem giỏ hàng</a></li>
							<!-- <li><a href="#">My Wishlist</a></li>
							<li><a href="#">Track My Order</a></li>
							<li><a href="faq.html">Help</a></li> -->
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Liên hệ</h4>
						<ul>
							<li><span>0398579414</span></li>
							<!-- <li><span>+00-123-000000</span></li> -->
						</ul>
						<div class="social-icons">
							<h4>Theo dõi chúng tôi</h4>
					   		  <ul>
							      <li class="facebook"><a href="#" target="_blank"> </a></li>
							      <li class="twitter"><a href="#" target="_blank"> </a></li>
							      <li class="googleplus"><a href="#" target="_blank"> </a></li>
							      <li class="contact"><a href="#" target="_blank"> </a></li>
							      <div class="clear"></div>
						     </ul>
   	 					</div>
				</div>
			</div>
			<div class="copy_right">
				<p></a> </p>
		   </div>
     </div>  
    </div>
    <script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
</body>
</html>


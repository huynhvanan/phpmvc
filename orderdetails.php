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
    // $us = new user();
    $product = new product();

?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
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
<html>
<body>
    <!-- <div class="wrap"> -->
		<div class="header_top">
			<div class="logo">
				<a href="index.html"><img src="images/logo.png" alt="" /></a>
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
							<span class="cart_title"></span>
							<span class="no_product">
								<?php
									$ckeck_cart = $ct->check_cart();
									if($ckeck_cart){
										$qty = Session::get("qty");
										$sum = Session::get("sum");
										echo $fm->format_currency($sum).''.' VND'.'-'.'SL:'.$qty;
									}else{
										echo 'Trống';
									}
										
								?>
							</span>
						</a>
					</div>
			    </div>
			<div class="login">		
				<?php
					if(isset($_GET['Id'])){
						$deleteCart = $ct->delete_all_data_cart();
						Session::destroy();
					}
				?>	
				<?php
					if(isset($_SESSION['customer_login'])){
						echo '<a href="?Id='.Session::get('customer_Id').'">Đăng xuất</a>';
					}else{
						echo '<a href="login.php">Đăng nhập</a>';
					}
				?>
				
		    </div>
			</div>
		    <!-- <div class="clear"></div> -->
	    </div>
	 <div class="clear"></div>
 <!-- </div> -->
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
		<li><a href="index.php">Trang chủ</a></li>
		<!-- <li><a href="products.php">Sản phẩm</a> </li>
		<li><a href="topbrands.php">Thương hiệu</a></li> -->
		<?php
			$check_cart = $ct->check_cart();
			if($check_cart==true){
				echo '<li><a href="cart.php">Giỏ hàng</a></li>';
			}else{
				echo '';
			}
		?>
        <?php
					$customer_Id = Session::get('customer_Id');
					$check_order = $ct->check_order($customer_Id);
					if($check_order==true){
						echo '<li><a href="orderdetails.php">Đã đặt hàng</a></li>';
					}else{
						echo '';
					}
	  			?>
		
		<?php
			$login_check = Session::get('customer_login');
			if($login_check==false){
				echo '';
			}else{
				echo '<li><a href="profile.php">Thông tin</a></li>';
			}
		?>
		
		<!-- <li><a href="contact.php">Liên hệ</a> </li> -->
	  <div class="clear"></div>
	</ul>
</div>
<?php
    $login_check = Session::get('customer_login');
    if($login_check==false){
        header('Location: login.php');
    }
    $ct = new cart();
    if(isset($_GET['confirmId'])){
		$id = $_GET['confirmId'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$shifted_confirm = $ct->shifted_confirm($id, $time, $price);
    }
?>	
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h3 style="color:red;"><strong>Chi tiết đơn hàng của bạn</strong></h3><br></br>
					<div>
						<table class="tblone">
							<tr>
                                <th width="10%">STT</th>
								<th width="20%">Tên sản phẩm</th>
								<th width="10%">Hình ảnh</th>
								<th width="20%">Gía</th>
								<th width="5%">Số lượng</th>
                                <th width="15%">Ngày</th>
								<th width="10%">Trạng thái</th>
								<th width="10%">Thao tác</th>
							</tr>
							<?php
                                $customer_Id = Session::get('customer_Id');
								$get_cart_ordered = $ct->get_cart_ordered($customer_Id);
								if($get_cart_ordered){
                                    // $subtotal = 0;
                                    $i = 0;
									$qty = 0;
									while($result = $get_cart_ordered->fetch_assoc()){
                                        $i++;
									

								
							?>
							<tr>
                                <td><?php echo $i; ?></td>
								<td><?php echo $result['Tensanpham'] ?></td>
								<td><img src="admin/upload/<?php echo $result['Hinhanh'] ?>" alt=""/></td>
								<td><?php echo $fm->format_currency($result['Gia'])." VND" ?></td>
								<td>
									<!-- <form action="" method="post"> -->
                                    <?php echo $result['Soluong'] ?>
									<!-- </form> -->
								</td>
                                <td><?php echo $fm->formatDate($result['Ngay']) ?></td>
								<td>
                                    <?php
                                        if($result['Trangthai']=='0'){
                                            echo 'Đang chờ xử lý';
                                        }elseif($result['Trangthai']=='1'){
                                    ?>
                                    <span>Đang vận chuyển</span>
                                    
                                    <?php
                                    }elseif($result['Trangthai']=='2'){
                                        echo 'Đã nhận hàng';
                                    }
                                    ?>
                                </td>
                                <?php
                                    if($result['Trangthai']=='0'){
                                ?><td><?php echo 'N/A';?></td>
                                <?php
                                
                                }elseif($result['Trangthai']=='1'){
                                ?>
                                <td><a href="?confirmId=<?php echo $customer_Id ?>&price=<?php echo $result['Gia'] ?>&time=<?php echo $result['Ngay']?>">Đã nhận hàng</a></td>
                                <?php
                                }else{
                                ?>
								<td><?php echo 'Đã nhận hàng'; ?></td>
                                <?php
                                }
                                ?>
							</tr>
                            <?php
                                    }
                                }
                                ?>
						</table>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/aefb1daf70528d0cd443.jpg" width="300px;" alt="" /></a>
						</div>
						<!-- <div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div> -->
					</div>
    	        </div>  	
            <div class="clear"></div>
        </div>
    </div>
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
		
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
</body>
</html>
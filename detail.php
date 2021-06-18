<?php
	// $filepath = realpath(dirname(__FILE__));
	// echo $filepath;
	// include 'config/config.php';
	
	// define("DB_HOST", "localhost");
	// define("DB_USER", "root");
	// define("DB_PASS", "");
	// define("DB_NAME", "php_mvc");

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
				    <form>
				    	<input type="text" value="Tìm kiếm sản phẩm" placeholder="Nhập tên sản phẩm" value="Tìm">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
							<span class="cart_title"></span>
							<span class="no_product"></span>
						</a>
					</div>
			    </div>
				
		   		
		 		<!-- <div class="clear">

				</div> -->
	 		</div>
	 		<!-- <div class="clear"></div> -->
 		</div>
		<div class="menu">
			<ul id="dc_mega-menu-orange" class="dc_mm-orange">
			<li><a href="index.php">Trang chủ</a></li>
			
			<li><a href="cart.php">Giỏ hàng</a></li>
			<li><a href="profile.php">Thông tin</a></li>
			
	  			
			</ul>
		</div>
		<div class="clear"></div>
		<?php
			if(isset($_GET['Id']) && $_GET['Id']==NULL){
				echo "<script>window.location = '404.php'</script>";
			}else{
				$id = $_GET['Id'];
			}
			if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
				$quantity = $_POST['soluong']; 
				$AddtoCart = $ct->add_to_cart($quantity, $id);
			}
		?>
		
		<div class="main">
		
    		<div class="content">
    			<div class="section group">
				<?php
					$get_product_details = $product->get_details($id);
					if($get_product_details){
						while($result_details = $get_product_details->fetch_assoc()){	
					
				?>
					<div class="cont-desc span_1_of_2">				
						<div class="grid images_3_of_2">
							<img src="admin/upload/<?php echo $result_details['hinhanh'] ?>">
						</div>
					<div class="desc span_3_of_2">
						<h2 style="color:black;"><?php echo $result_details['Name'] ?></h2>
						<p><?php echo $result_details['mota'] ?></p>					
						<div class="price">
							<p>Gía: <span><?php echo $fm->format_currency($result_details['gia'])." "." VND" ?></span></p>
							<p>Danh mục: <span style="color:black;"><?php echo $result_details['nameDM'] ?></span></p>
							<p>Thương hiệu:<span style="color:black;"> <?php echo $result_details['nameTH'] ?></span></p>
						</div>
						<div class="add-cart">
							<form action="" method="post">
								<input type="number" class="buyfield" name="soluong" value="1" min="1"/>
								<input type="submit" class="buysubmit" name="submit" value="Mua ngay"/>
								
							</form></br>
							<?php
									if(isset($AddtoCart)){
										echo '<span style="color:red; font-size:20px;">Sản phẩm đã được thêm</span>';
									}
								?>			
						</div>
						<!-- <div class="add-cart">
							<a href="?wlist=<?php echo $result_details['Id_sanpham'] ?>" class="buysubmit">Lưu vào danh sách yêu thích</a>
							<a href="?compare=<?php echo $result_details['Id_sanpham'] ?>" class="buysubmit">So sánh sản phẩm</a>		
						</div> -->
					</div>
					<div class="product-desc">
						<h2>Chi tiết sản phẩm</h2>
						<p><?php echo $result_details['mota'] ?></p>
						<!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p> -->
						<!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p> -->
					</div>
				
				</div>
			
			<?php
				}
			}
			?>
			<div class="rightsidebar span_3_of_1">
				<h2>DANH MỤC</h2>
					<ul>
					<?php
						$getall = $cat->show_category();
						if($getall){
							while($result = $getall->fetch_assoc()){
						
					?>
						<li><a href="productbycat.php?Id=<?php echo $result['Id'] ?>"><?php echo $result['Name'] ?></a></li>
					<?php
						}
					}
					?>		
					</ul>
				
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


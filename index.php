
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
    $cs = new customer();
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
			<?php
				if(isset($_GET['Id'])){
					
					Session::destroy();
					
				}
			?>	  
		   <div class="login">
		   
		   <?php
				// $login_check = Session::get('customer_login');
				// // echo $login_check;
				// if($login_check==true){
				// 	echo '<a href="login.php">Đăng nhập</a></div>';
				// }else{
				// 	echo '<a href="?Id='.Session::get('customer_Id').'">Đăng xuất</a></div>';
				// }
				if(isset($_SESSION['customer_login'])){
					echo '<a href="?Id='.Session::get('customer_Id').'">Đăng xuất</a></div>';
				}else{
					echo '<a href="login.php">Đăng nhập</a></div>';
				}
			?>
			
			<!-- <a href="login.php">Đăng nhập</a></div> -->
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
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
	  <!-- <li><a href="compare.php">So sánh</a> </li> -->
	  <!-- <li><a href="contact.php">Liên hệ</a> </li> -->
	  <div class="clear"></div>
	</ul>
</div>
	<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
					$getLastesSamSung = $product->getLastesSamSung();
					if($getLastesSamSung){
						while($result = $getLastesSamSung->fetch_assoc()){
						
						
					
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="#"> <img src="admin/upload/<?php echo $result['hinhanh'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>SAMSUNG</h2>
						<p><?php echo $result['Name'] ?></p>
						<div class="button"><span><a href="detail.php?Id=<?php echo $result['Id'] ?>">Mua ngay</a></span></div>
				   </div>
			   </div>
			   <?php
					}
				}
			   ?>
			   <?php
					$getLastesApple = $product->getLastesApple();
					if($getLastesApple){
						while($result = $getLastesApple->fetch_assoc()){
						
						
					
				?>			
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="#"><img src="admin/upload/<?php echo $result['hinhanh'] ?>" width="100px;" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>APPLE</h2>
						  <p><?php echo $result['Name'] ?></p>
						  <div class="button"><span><a href="detail.php?Id=<?php echo $result['Id'] ?>">Mua ngay</a></span></div>
					</div>
				</div>
				<?php
					}
				}
				?>
			</div>
			<div class="section group">
				<?php
					$getLastesBelkin = $product->getLastesBelkin();
					if($getLastesBelkin){
						while($result = $getLastesBelkin->fetch_assoc()){
						
						
					
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="#"> <img src="admin/upload/<?php echo $result['hinhanh'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>BELKIN</h2>
						<p><?php echo $result['Name'] ?></p>
						<div class="button"><span><a href="detail.php?Id=<?php echo $result['Id'] ?>">Mua ngay</a></span></div>
				   </div>
				   <?php
						}
					}
				   ?>
			   </div>
			   <?php
					$getLastesXiaoMi = $product->getLastesXiaoMi();
					if($getLastesXiaoMi){
						while($result = $getLastesXiaoMi->fetch_assoc()){
						
						
					
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="#"><img src="admin/upload/<?php echo $result['hinhanh'] ?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>XIAOMI</h2>
						  <p><?php echo $result['Name'] ?></p>
						  <div class="button"><span><a href="detail.php?Id=<?php echo $result['Id'] ?>">Mua ngay</a></span></div>
					</div>
				</div>
				<?php
					}
				}
				?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	

 <div class="main">
 	
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Sản phẩm nổi bật</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
		  <?php
			  $product_feathred = $product->getproduct_feathred();
			  if($product_feathred){
				while($result = $product_feathred->fetch_assoc()){
		  ?>
				<div class="grid_1_of_4 images_1_of_4" >
					 <img src="admin/upload/<?php echo $result['hinhanh'] ?>" width="200">
					 <h2 style="color:black;"><?php echo $result['Name'] ?></h2>
					 
					 <p><span class="price"><?php echo $fm->format_currency($result['gia'])." "." VND" ?></span></p>
				     <div class="button"><span><a href="detail.php?Id=<?php echo $result['Id'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				<?php
				}
			  }
				?>
				
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>Sảm phẩm mới</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php
			  $product_new = $product->getproduct_new();
			  if($product_new){
				while($result_new = $product_new->fetch_assoc()){
		  ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <img src="admin/upload/<?php echo $result_new['hinhanh'] ?>" width="100">
					 <h2 style="color:black;"><?php echo $result_new['Name'] ?></h2>
					 
					 <p><span class="price"><?php echo $fm->format_currency($result_new['gia'])." "." VND" ?></span></p>
				     <div class="button"><span><a href="detail.php?Id=<?php echo $result_new['Id'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				<?php
				}
			  }
				?>
				
			</div>
			<div class="">
			  <?php
				  $product_all = $product->get_all_product();
				  $product_count = mysqli_num_rows($product_all);
				  $product_button = ceil($product_count/4);
				//   echo $product_button;
				  $i = 1;
				  echo '<p>Trang: </p>';
				  for($i=1;$i<=$product_button;$i++){
					  echo '<a style="margin:0 5px;"href="index.php?trang='.$i.'">'.$i.'</a>';
				  }
			  ?>
			</div>
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
    <link href="css/flexslider.css" rel='stylesheet' type='text/css' />
	  <script defer src="js/jquery.flexslider.js"></script>
	  <script type="text/javascript">
		$(function(){
		  SyntaxHighlighter.all();
		});
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
	  </script>
</body>
</html>

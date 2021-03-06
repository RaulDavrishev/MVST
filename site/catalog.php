<?php
require "db.php";

$input_year_from=0;
$input_year_to=3000;
if(isset($_POST['input_year_from'])){
	$input_year_from=$_POST['input_year_from'];
}
if(isset($_POST['input_year_to'])){
	$input_year_to=$_POST['input_year_to'];
}
if(isset($_POST['apply_filter']) && isset($_POST['genre_input']) && $_POST['genre_input']!='All'){
	$genre_input=$_POST['genre_input'];
	$all_row = oci_parse($conn, "SELECT m.MOVIE_ID, m.TITLE, m.YEAR, m.LENGTH, g.GENRE_NAME, c.COUNTRY_NAME, 
	                                 gn.GENDER, p.PERSON_NAME FROM MOVIE m 
	                                             JOIN MOVIE_GENRE mg ON m.MOVIE_ID=mg.MOVIE_ID
	                                             JOIN GENRE g ON mg.GENRE_ID=g.GENRE_ID
	                                             JOIN PRODUCTION_COUNTRY pc ON m.MOVIE_ID=pc.MOVIE_ID
	                                             JOIN COUNTRY c ON pc.COUNTRY_ID=c.COUNTRY_ID
	                                             JOIN MOVIE_CAST mc ON m.MOVIE_ID=mc.MOVIE_ID
	                                             JOIN GENDER gn ON mc.GENDER_ID=gn.GENDER_ID
	                                             JOIN PERSON p ON mc.PERSON_ID=p.PERSON_ID
	                                             WHERE LOWER(g.GENRE_NAME)=LOWER('$genre_input')
	                                             AND m.YEAR<='$input_year_to'
	                                             AND m.YEAR>='$input_year_from' 
	                                             ORDER BY m.MOVIE_ID");
}
else{
$all_row = oci_parse($conn, "SELECT m.MOVIE_ID, m.TITLE, m.YEAR, m.LENGTH, g.GENRE_NAME, c.COUNTRY_NAME, 
	                                 gn.GENDER, p.PERSON_NAME FROM MOVIE m 
	                                             JOIN MOVIE_GENRE mg ON m.MOVIE_ID=mg.MOVIE_ID
	                                             JOIN GENRE g ON mg.GENRE_ID=g.GENRE_ID
	                                             JOIN PRODUCTION_COUNTRY pc ON m.MOVIE_ID=pc.MOVIE_ID
	                                             JOIN COUNTRY c ON pc.COUNTRY_ID=c.COUNTRY_ID
	                                             JOIN MOVIE_CAST mc ON m.MOVIE_ID=mc.MOVIE_ID
	                                             JOIN GENDER gn ON mc.GENDER_ID=gn.GENDER_ID
	                                             JOIN PERSON p ON mc.PERSON_ID=p.PERSON_ID
	                                             ORDER BY m.MOVIE_ID");	
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600%7CUbuntu:300,400,500,700" rel="stylesheet"> 

	<!-- CSS -->
	<link rel="stylesheet" href="css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/ionicons.min.css">
	<link rel="stylesheet" href="css/plyr.css">
	<link rel="stylesheet" href="css/photoswipe.css">
	<link rel="stylesheet" href="css/default-skin.css">
	<link rel="stylesheet" href="css/main.css">

	<!-- Favicons -->
	<link rel="icon" type="image/png" href="icon/favicon-32x32.png" sizes="32x32">
	<link rel="apple-touch-icon" href="icon/favicon-32x32.png">
	<link rel="apple-touch-icon" sizes="72x72" href="icon/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="icon/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="144x144" href="icon/apple-touch-icon-144x144.png">

	<title>FlixGo</title>

</head>
<body class="body">
	
	<!-- header -->
	<header class="header">
		<div class="header__wrap">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="header__content">
							<!-- header logo -->
							<a href="index.php" class="header__logo">
								<img src="img/logo.svg" alt="">
							</a>
							<!-- end header logo -->

							<!-- header nav -->
							<ul class="header__nav">
								<!-- dropdown -->
								<li class="header__nav-item">
									<a class="dropdown-toggle header__nav-link" href="index.php">Home</a>

								</li>
								<!-- end dropdown -->

								
								<li class="header__nav-item">
									<a href="catalog.php" class="header__nav-link">Catalog</a>
								</li>

								<li class="header__nav-item">
									<a href="details.php" class="header__nav-link">Details</a>
								</li>

								<li class="header__nav-item">
									<a href="pricing.php" class="header__nav-link">Pricing Plan</a>
								</li>

                                <li class="header__nav-item">
										<a href="about.php" class="header__nav-link">About</a>
								</li>
							</ul>
							<!-- end header nav -->

							<!-- header auth -->
							<?php if(isset($_SESSION["logged_user"])) : ?>
            	            <a style="color:white;margin-left:200px;font-size:21px;"><?php echo $_SESSION['logged_user']; ?><a>

            	<div><a href="logout.php" class="button" style="color:pink; margin-left:10px;">Exit</a></div></div>
                <?php else : ?> 
							<div class="header__auth">
								<button class="header__search-btn" type="button">
									<i class="icon ion-ios-search"></i>
								</button>

								<a href="signin.php" class="header__sign-in">
									<i class="icon ion-ios-log-in"></i>
									<span>sign in</span>
								</a>
							</div>
							<!-- end header auth -->
                <?php endif; ?>
							<!-- header menu btn -->
							<button class="header__btn" type="button">
								<span></span>
								<span></span>
								<span></span>
							</button>
							<!-- end header menu btn -->
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- header search -->
		<form action="#" class="header__search">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="header__search-content">
							<input type="text" placeholder="Search for a movie, TV Series that you are looking for">

							<button type="button">search</button>
						</div>
					</div>
				</div>
			</div>
		</form>
		<!-- end header search -->
	</header>
	<!-- end header -->

	<!-- page title -->
	<section class="section section--first section--bg" data-bg="img/section/section.jpg">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section__wrap">
						<!-- section title -->
						<h2 class="section__title">Catalog grid</h2>
						<!-- end section title -->

						<!-- breadcrumb -->
						<ul class="breadcrumb">
							<li class="breadcrumb__item"><a href="#">Home</a></li>
							<li class="breadcrumb__item breadcrumb__item--active">Catalog grid</li>
						</ul>
						<!-- end breadcrumb -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end page title -->
</a></a>


	<div class="filter">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="filter__content">
						<div class="filter__items">
							<!-- filter item -->

                            <form action="catalog.php" method="POST" class="filter__items">

							<div class="filter__item" id="filter__genre">
								<span class="filter__item-label">GENRE:</span>
								<div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-genre" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<input type="button" value="Drama/Action">
									<span></span>
								</div>


                                <select type="text" name="genre_input" class="selectpicker" data-style="btn-primary" >
                                        <option><?php echo @$_POST['genre_input']; ?></option>
                                        <option>All</option>
                                        <option>Drama</option>
                                        <option>Comedy</option>
                                        <option>Fantasy</option>
                                        <option>Sci-fi</option>
                                        <option>Animation</option>
                                        <option>Action</option>
                                </select>
 
							</div>
							<!-- end filter item -->
						
							<!-- filter item -->
							<div class="filter__item" id="filter__year">
								<span class="filter__item-label">YEAR FROM:</span>
								
								<input size="2" type="text" name="input_year_from" placeholder="RELEASE YEAR" 
								value="<?php echo @$_POST['input_year_from']; ?>" style="color:black;"></input>
							</div>
                            
                            <div class="filter__item" style="color:white;font-size:50px;margin-right:20px;margin-left:-45px;margin-top:10px;">-</div>

							<div class="filter__item" id="filter__year">
								<span class="filter__item-label">TO:</span>
								
								<input size="2" type="text" name="input_year_to" placeholder="RELEASE YEAR" 
								value="<?php echo @$_POST['input_year_to']; ?>" style="color:black;"></input>
							</div>
							<!-- end filter item -->
						</div>
						
						<!-- filter btn -->
						<button class="filter__btn" type="submit" name="apply_filter">apply filter</button>
						<!-- end filter btn -->
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>







	<div class="catalog">
		<div class="container">
			<div class="row">
<?php
//echo '<div style="color:white">'.$input_year_from.'</div>';
oci_execute($all_row);
while(oci_fetch($all_row)){			

				echo '<div class="col-6 col-sm-4 col-lg-3 col-xl-2">
					<div class="card">
						<div class="card__cover">
							<img src="img/covers/'.oci_result($all_row, 'MOVIE_ID').'.jpg" style="width:160px;height:240px">
							<a href="#" class="card__play">
								<i class="icon ion-ios-play"></i>
							</a>
						</div>
						<div class="card__content">
							<h3 class="card__title"><a href="#">'.oci_result($all_row, 'TITLE').'</a></h3>
							<span class="card__category">
								<a>'.oci_result($all_row, 'GENRE_NAME').'</a>
							</span>
							<span class="card__rate">'.oci_result($all_row, 'YEAR').'</span>
						</div>
					</div>
				</div>';
			}
?>



				<!-- section btn -->
				<div class="col-12">
					<a class="section__btn">Show more</a>
				</div>
				<!-- end section btn -->
			</div>
		</div>
	</section>
	<!-- end expected premiere -->

	<!-- footer -->
	<footer class="footer">
		<div class="container">
			<div class="row">
				<!-- footer list -->
				<div class="col-12 col-md-3">
					<h6 class="footer__title">Download Our App</h6>
					<ul class="footer__app">
						<li><a href="#"><img src="img/Download_on_the_App_Store_Badge.svg" alt=""></a></li>
						<li><a href="#"><img src="img/google-play-badge.png" alt=""></a></li>
					</ul>
				</div>
				<!-- end footer list -->

				<!-- footer list -->
				<div class="col-6 col-sm-4 col-md-3">
					<h6 class="footer__title">Resources</h6>
					<ul class="footer__list">
						<li><a href="#">About Us</a></li>
						<li><a href="#">Pricing Plan</a></li>
						<li><a href="#">Help</a></li>
					</ul>
				</div>
				<!-- end footer list -->

				<!-- footer list -->
				<div class="col-6 col-sm-4 col-md-3">
					<h6 class="footer__title">Legal</h6>
					<ul class="footer__list">
						<li><a href="#">Terms of Use</a></li>
						<li><a href="#">Privacy Policy</a></li>
						<li><a href="#">Security</a></li>
					</ul>
				</div>
				<!-- end footer list -->

				<!-- footer list -->
				<div class="col-12 col-sm-4 col-md-3">
					<h6 class="footer__title">Contact</h6>
					<ul class="footer__list">
						<li><a href="tel:+18002345678">+1 (800) 234-5678</a></li>
						<li><a href="mailto:support@moviego.com">support@flixgo.com</a></li>
					</ul>
					<ul class="footer__social">
						<li class="facebook"><a href="#"><i class="icon ion-logo-facebook"></i></a></li>
						<li class="instagram"><a href="#"><i class="icon ion-logo-instagram"></i></a></li>
						<li class="twitter"><a href="#"><i class="icon ion-logo-twitter"></i></a></li>
						<li class="vk"><a href="#"><i class="icon ion-logo-vk"></i></a></li>
					</ul>
				</div>
				<!-- end footer list -->

				<!-- footer copyright -->
				<div class="col-12">
					<div class="footer__copyright">
						<small><a target="_blank" href="https://www.templateshub.net">Templates Hub</a></small>

						<ul>
							<li><a href="#">Terms of Use</a></li>
							<li><a href="#">Privacy Policy</a></li>
						</ul>
					</div>
				</div>
				<!-- end footer copyright -->
			</div>
		</div>
	</footer>
	<!-- end footer -->

	<!-- JS -->
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.mousewheel.min.js"></script>
	<script src="js/jquery.mCustomScrollbar.min.js"></script>
	<script src="js/wNumb.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/plyr.min.js"></script>
	<script src="js/jquery.morelines.min.js"></script>
	<script src="js/photoswipe.min.js"></script>
	<script src="js/photoswipe-ui-default.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html>
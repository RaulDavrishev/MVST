<?php
require "db.php";
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

	<!-- home -->
	<section class="home home--bg">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1 class="home__title"><b>NEW ITEMS</b> OF THIS SEASON</h1>

					<button class="home__nav home__nav--prev" type="button">
						<i class="icon ion-ios-arrow-round-back"></i>
					</button>
					<button class="home__nav home__nav--next" type="button">
						<i class="icon ion-ios-arrow-round-forward"></i>
					</button>
				</div>

				<div class="col-12">
					<div class="owl-carousel home__carousel">
						
<?php
$all_row = oci_parse($conn, "SELECT m.MOVIE_ID, m.TITLE, m.YEAR, m.LENGTH, TO_CHAR(m.DESCRIPTION) DESCRIPTION, 
	                                g.GENRE_NAME, c.COUNTRY_NAME, 
	                                gn.GENDER, p.PERSON_NAME FROM MOVIE m 
	                                            JOIN MOVIE_GENRE mg ON m.MOVIE_ID=mg.MOVIE_ID
	                                            JOIN GENRE g ON mg.GENRE_ID=g.GENRE_ID
	                                            JOIN PRODUCTION_COUNTRY pc ON m.MOVIE_ID=pc.MOVIE_ID
	                                            JOIN COUNTRY c ON pc.COUNTRY_ID=c.COUNTRY_ID
	                                            JOIN MOVIE_CAST mc ON m.MOVIE_ID=mc.MOVIE_ID
	                                            JOIN GENDER gn ON mc.GENDER_ID=gn.GENDER_ID
	                                            JOIN PERSON p ON mc.PERSON_ID=p.PERSON_ID
	                                            ORDER BY m.MOVIE_ID");
oci_execute($all_row);
while(oci_fetch($all_row)){
							echo '<div class="item">
							<div class="card card--big">
								<div class="card__cover">
								<img src="img/covers/'.oci_result($all_row, 'MOVIE_ID').'.jpg" alt="" style="width:255px;height:385px">
									<a href="#" class="card__play">
										<i class="icon ion-ios-play"></i>
									</a>
								</div>
								<div class="card__content">
									<h3 class="card__title"><a href="#">'.oci_result($all_row, 'TITLE').'</a></h3>
									<span class="card__category">
										<a href="#">'.oci_result($all_row, 'GENRE_NAME').'</a>
									</span>
									<span class="card__rate">'.oci_result($all_row, 'YEAR').'</span>
								</div>
							</div>
						</div>';
					}
?>

					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end home -->

	<!-- content -->
	<section class="content">
		<div class="content__head">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<!-- content title -->
						<h2 class="content__title">New items</h2>
						<!-- end content title -->

						<!-- content tabs nav -->
						<ul class="nav nav-tabs content__tabs" id="content__tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">NEW RELEASES</a>
							</li>
						</ul>
						<!-- end content tabs nav -->

						<!-- content mobile tabs nav -->
						<div class="content__mobile-tabs" id="content__mobile-tabs">
							<div class="content__mobile-tabs-btn dropdown-toggle" role="navigation" id="mobile-tabs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<input type="button" value="New items">
								<span></span>
							</div>

							<div class="content__mobile-tabs-menu dropdown-menu" aria-labelledby="mobile-tabs">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item"><a class="nav-link active" id="1-tab" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">NEW RELEASES</a></li>
								</ul>
							</div>
						</div>
						<!-- end content mobile tabs nav -->
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<!-- content tabs -->
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab">
					<div class="row">
						<!-- card -->
<?php
$all_row2 = oci_parse($conn, "SELECT m.MOVIE_ID, m.TITLE, m.YEAR, m.LENGTH, TO_CHAR(m.DESCRIPTION) DESCRIPTION, 
	                                g.GENRE_NAME, c.COUNTRY_NAME, 
	                                gn.GENDER, p.PERSON_NAME FROM MOVIE m 
	                                            JOIN MOVIE_GENRE mg ON m.MOVIE_ID=mg.MOVIE_ID
	                                            JOIN GENRE g ON mg.GENRE_ID=g.GENRE_ID
	                                            JOIN PRODUCTION_COUNTRY pc ON m.MOVIE_ID=pc.MOVIE_ID
	                                            JOIN COUNTRY c ON pc.COUNTRY_ID=c.COUNTRY_ID
	                                            JOIN MOVIE_CAST mc ON m.MOVIE_ID=mc.MOVIE_ID
	                                            JOIN GENDER gn ON mc.GENDER_ID=gn.GENDER_ID
	                                            JOIN PERSON p ON mc.PERSON_ID=p.PERSON_ID
	                                            ORDER BY m.MOVIE_ID");
oci_execute($all_row2);
while(oci_fetch($all_row2)){
						echo '<div class="col-6 col-sm-12 col-lg-6">
							<div class="card card--list">
								<div class="row">
									<div class="col-12 col-sm-4">
										<div class="card__cover">
											<img src="img/covers/'.oci_result($all_row2, 'MOVIE_ID').'.jpg" alt="">
											<a href="#" class="card__play">
												<i class="icon ion-ios-play"></i>
											</a>
										</div>
									</div>

									<div class="col-12 col-sm-8">
										<div class="card__content">
											<h3 class="card__title"><a href="#">'.oci_result($all_row2, 'TITLE').'</a></h3>
											<span class="card__category">
												<a href="#">'.oci_result($all_row2, 'GENRE_NAME').'</a>
											</span>

											<div class="card__wrap">
												<span class="card__rate"><i class="icon ion-ios-time"></i>'.oci_result($all_row2, 'LENGTH').' min</span>

												<ul class="card__list">
													<li>HD</li>
													<li>16+</li>
												</ul>
											</div>

											<div class="card__description">
												<p>'
										           .oci_result($all_row2, 'DESCRIPTION').
									        '</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>';
				}
						
?>
</div>
</div>
</div>
</section>
	<!-- end content -->

	<!-- expected premiere -->
	<section class="section section--bg" data-bg="img/section/section.jpg">
		<div class="container">
			<div class="row">
				<!-- section title -->
				<div class="col-12">
					<h2 class="section__title">Expected premiere</h2>
				</div>
				<!-- end section title -->
<?php
$all_row3 = oci_parse($conn, "SELECT m.MOVIE_ID, m.TITLE, m.YEAR, m.LENGTH, g.GENRE_NAME, c.COUNTRY_NAME, 
	                                 gn.GENDER, p.PERSON_NAME FROM MOVIE m 
	                                             JOIN MOVIE_GENRE mg ON m.MOVIE_ID=mg.MOVIE_ID
	                                             JOIN GENRE g ON mg.GENRE_ID=g.GENRE_ID
	                                             JOIN PRODUCTION_COUNTRY pc ON m.MOVIE_ID=pc.MOVIE_ID
	                                             JOIN COUNTRY c ON pc.COUNTRY_ID=c.COUNTRY_ID
	                                             JOIN MOVIE_CAST mc ON m.MOVIE_ID=mc.MOVIE_ID
	                                             JOIN GENDER gn ON mc.GENDER_ID=gn.GENDER_ID
	                                             JOIN PERSON p ON mc.PERSON_ID=p.PERSON_ID WHERE m.MOVIE_ID<7 ORDER BY PERSON_NAME");
oci_execute($all_row3);
while(oci_fetch($all_row3)){
				echo'<div class="col-6 col-sm-4 col-lg-3 col-xl-2">
					<div class="card">
						<div class="card__cover">
							<img src="img/covers/'.oci_result($all_row3, 'MOVIE_ID').'.jpg" alt="">
							<a href="#" class="card__play">
								<i class="icon ion-ios-play"></i>
							</a>
						</div>
						<div class="card__content">
							<h3 class="card__title"><a href="#">'.oci_result($all_row3, 'TITLE').'</a></h3>
							<span class="card__category">
								<a href="#">'.oci_result($all_row3, 'GENRE_NAME').'</a>
							</span>
							<span class="card__rate"><i class="icon ion-ios-time"></i>8.4</span>
						</div>
					</div>
				</div>';
		}
				
?>

				<!-- section btn -->
				<div class="col-12">
					<a href="" class="section__btn">Show more</a>
				</div>
				<!-- end section btn -->
			</div>
		</div>
	</section>
	<!-- end expected premiere -->

	<!-- partners -->
	<section class="section">
		<div class="container">
			<div class="row">
				<!-- section title -->
				<div class="col-12">
					<h2 class="section__title section__title--no-margin">Our Partners</h2>
				</div>
				<!-- end section title -->

				<!-- section text -->
				<div class="col-12">
					<p class="section__text section__text--last-with-margin">It is a long <b>established</b> fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using.</p>
				</div>
				<!-- end section text -->

				<!-- partner -->
				<div class="col-6 col-sm-4 col-md-3 col-lg-2">
					<a href="#" class="partner">
						<img src="img/partners/themeforest-light-background.png" alt="" class="partner__img">
					</a>
				</div>
				<!-- end partner -->

				<!-- partner -->
				<div class="col-6 col-sm-4 col-md-3 col-lg-2">
					<a href="#" class="partner">
						<img src="img/partners/audiojungle-light-background.png" alt="" class="partner__img">
					</a>
				</div>
				<!-- end partner -->

				<!-- partner -->
				<div class="col-6 col-sm-4 col-md-3 col-lg-2">
					<a href="#" class="partner">
						<img src="img/partners/codecanyon-light-background.png" alt="" class="partner__img">
					</a>
				</div>
				<!-- end partner -->

				<!-- partner -->
				<div class="col-6 col-sm-4 col-md-3 col-lg-2">
					<a href="#" class="partner">
						<img src="img/partners/photodune-light-background.png" alt="" class="partner__img">
					</a>
				</div>
				<!-- end partner -->

				<!-- partner -->
				<div class="col-6 col-sm-4 col-md-3 col-lg-2">
					<a href="#" class="partner">
						<img src="img/partners/activeden-light-background.png" alt="" class="partner__img">
					</a>
				</div>
				<!-- end partner -->

				<!-- partner -->
				<div class="col-6 col-sm-4 col-md-3 col-lg-2">
					<a href="#" class="partner">
						<img src="img/partners/3docean-light-background.png" alt="" class="partner__img">
					</a>
				</div>
				<!-- end partner -->
			</div>
		</div>
	</section>
	<!-- end partners -->

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
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
  <link rel="stylesheet" href="css/style.css">

  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
                  <a class="header__nav-link" href="index.php">Home</a>

                </li>
                <!-- end dropdown -->
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




<?php

if(isset($_POST['submit'])){
$movie_id = $_POST['movie_id'];
$title = $_POST['title'];
$length = $_POST['length'];
$year = $_POST['year'];
if($_POST['genre']=="Drama"){$genre = 1;}
elseif($_POST['genre']=="Comedy"){$genre = 2;}
elseif($_POST['genre']=="Horror"){$genre = 3;}
elseif($_POST['genre']=="Fantasy"){$genre = 4;}
elseif($_POST['genre']=="Scifi"){$genre = 5;}
elseif($_POST['genre']=="Animation"){$genre = 6;}
else{$genre = 7;}
if($_POST['country']=="France"){$country=1;}
elseif($_POST['country']=="USA"){$country=2;}
elseif($_POST['country']=="Australia"){$country=3;}
elseif($_POST['country']=="UK"){$country=4;}
elseif($_POST['country']=="India"){$country=5;}
else{$country=2;}
if($_POST['gender']=="woman"){$gender=2;}
else{$gender=1;}
$actor = $_POST['actor'];


$query_insert_1 = oci_parse($conn, "INSERT INTO MOVIE(MOVIE_ID,TITLE,LENGTH,YEAR) VALUES('$movie_id','$title','$length','$year')");
$query_insert_2 = oci_parse($conn, "INSERT INTO MOVIE_GENRE(MOVIE_ID,GENRE_ID) VALUES('$movie_id','$genre')");
$query_insert_3 = oci_parse($conn, "INSERT INTO PRODUCTION_COUNTRY(MOVIE_ID,COUNTRY_ID) VALUES('$movie_id','$country')");
$query_insert_4 = oci_parse($conn, "INSERT INTO MOVIE_CAST(MOVIE_ID,GENDER_ID,PERSON_ID) VALUES('$movie_id','$gender','$movie_id')");
$query_insert_5 = oci_parse($conn, "INSERT INTO PERSON(PERSON_ID,PERSON_NAME) VALUES('$movie_id','$actor')");

oci_execute($query_insert_1);
oci_execute($query_insert_2);
oci_execute($query_insert_3);
oci_execute($query_insert_4);
oci_execute($query_insert_5);

}
else if(isset($_GET['id'])){
    $row = oci_parse($conn, "SELECT m.MOVIE_ID, m.TITLE, m.YEAR, m.LENGTH, g.GENRE_NAME, c.COUNTRY_NAME, 
                                   gn.GENDER, p.PERSON_NAME FROM MOVIE m 
                                               JOIN MOVIE_GENRE mg ON m.MOVIE_ID=mg.MOVIE_ID
                                               JOIN GENRE g ON mg.GENRE_ID=g.GENRE_ID
                                               JOIN PRODUCTION_COUNTRY pc ON m.MOVIE_ID=pc.MOVIE_ID
                                               JOIN COUNTRY c ON pc.COUNTRY_ID=c.COUNTRY_ID
                                               JOIN MOVIE_CAST mc ON m.MOVIE_ID=mc.MOVIE_ID
                                               JOIN GENDER gn ON mc.GENDER_ID=gn.GENDER_ID
                                               JOIN PERSON p ON mc.PERSON_ID=p.PERSON_ID
                                               WHERE m.MOVIE_ID='".$_GET['id']."'
                                               ORDER BY m.MOVIE_ID");
    oci_execute($row);
    while(oci_fetch($row)){
    $movie_id = oci_result($row, 'MOVIE_ID');
    $title = oci_result($row, 'TITLE');
    $length = oci_result($row, 'LENGTH');
    $year = oci_result($row, 'YEAR');
    $genre = oci_result($row, 'GENRE_NAME');
    $country = oci_result($row, 'COUNTRY_NAME');
    $gender = oci_result($row, 'GENDER');
    $actor = oci_result($row, 'PERSON_NAME');}
}
else if(isset($_POST['Update'])){

$movie_id = $_POST['movie_id'];
$title = $_POST['title'];
$length = $_POST['length'];
$year = $_POST['year'];
if($_POST['genre']=="Drama"){$genre = 1;}
elseif($_POST['genre']=="Comedy"){$genre = 2;}
elseif($_POST['genre']=="Horror"){$genre = 3;}
elseif($_POST['genre']=="Fantasy"){$genre = 4;}
elseif($_POST['genre']=="Scifi"){$genre = 5;}
elseif($_POST['genre']=="Animation"){$genre = 6;}
else{$genre = 7;}
if($_POST['country']=="France"){$country=1;}
elseif($_POST['country']=="USA"){$country=2;}
elseif($_POST['country']=="Australia"){$country=3;}
elseif($_POST['country']=="UK"){$country=4;}
elseif($_POST['country']=="India"){$country=5;}
else{$country=2;}
if($_POST['gender']=="woman"){$gender=2;}
else{$gender=1;}
$actor = $_POST['actor'];

$query_update_1 = oci_parse($conn, "UPDATE MOVIE SET MOVIE_ID = '$movie_id', TITLE = '$title', LENGTH = $length, YEAR = $year
WHERE MOVIE_ID=$movie_id");
$query_update_2 = oci_parse($conn, "UPDATE MOVIE_GENRE SET MOVIE_ID = '$movie_id', GENRE_ID = '$genre' 
WHERE MOVIE_ID=$movie_id");
$query_update_3 = oci_parse($conn, "UPDATE PRODUCTION_COUNTRY SET MOVIE_ID = '$movie_id', COUNTRY_ID = '$country'
WHERE MOVIE_ID=$movie_id");
$query_update_4 = oci_parse($conn, "UPDATE MOVIE_CAST SET MOVIE_ID = '$movie_id', GENDER_ID = '$gender', PERSON_ID = '$movie_id'
WHERE MOVIE_ID=$movie_id");
$query_update_5 = oci_parse($conn, "UPDATE PERSON SET PERSON_ID = '$movie_id', PERSON_NAME = '$actor'
WHERE PERSON_ID=$movie_id");

oci_execute($query_update_1);
oci_execute($query_update_2);
oci_execute($query_update_3);
oci_execute($query_update_4);
oci_execute($query_update_5);
    
}
else if(isset($_POST['Delete'])){

$del_id = $_POST['movie_id'];

$query_delete_1 = oci_parse($conn, "DELETE FROM  MOVIE  WHERE MOVIE_ID=$del_id");
$query_delete_2 = oci_parse($conn, "DELETE FROM  MOVIE_GENRE  WHERE MOVIE_ID=$del_id");
$query_delete_3 = oci_parse($conn, "DELETE FROM  PRODUCTION_COUNTRY  WHERE MOVIE_ID=$del_id");
$query_delete_4 = oci_parse($conn, "DELETE FROM  MOVIE_CAST  WHERE MOVIE_ID=$del_id");
$query_delete_5 = oci_parse($conn, "DELETE FROM  PERSON  WHERE PERSON_ID=$del_id");

oci_execute($query_delete_1);
oci_execute($query_delete_2);
oci_execute($query_delete_3);
oci_execute($query_delete_4);
oci_execute($query_delete_5);
  
}

?>


<section class="ftco-section contact-section bg-dark">
<div class="container">
<form action="admin.php" method="POST" class="bg-white p-5 contact-form">
<div class="form-group">
Movie id :<input  class="form-control" placeholder="Movie id" name="movie_id" type="text" value="<?php echo (isset($movie_id))?$movie_id:'';?>"></div>
<div class="form-group">
Title :<input class="form-control" placeholder="Title" name="title" type="text" value="<?php echo (isset($title))?$title:'';?>"></div>
<div class="form-group">
Length (min) :<input class="form-control" placeholder="Length" name="length" type="text" value="<?php echo (isset($length))?$length:'';?>"></div>
<div class="form-group">
Year :<input class="form-control" placeholder="Year" name="year" type="text" value="<?php echo (isset($year))?$year:'';?>"></div>
<div class="form-group">
Genre :<input class="form-control" placeholder="Genre" name="genre" type="text" value="<?php echo (isset($genre))?$genre:'';?>"></div>
<div class="form-group">
Country :<input class="form-control" placeholder="Country" name="country" type="text" value="<?php echo (isset($country))?$country:'';?>"></div>
<div class="form-group">
Gender :<input class="form-control" placeholder="Gender" name="gender" type="text" value="<?php echo (isset($gender))?$gender:'';?>"></div>
<div class="form-group">
Actor :<input class="form-control" placeholder="Actor" name="actor" type="text" value="<?php echo (isset($actor))?$actor:'';?>"></div>


<div class="form-group">
<input  name="submit"  class="btn btn-primary py-2 px-5" type="submit" value="Insert"/>
<input  name="Update"  class="btn btn-primary py-2 px-5" type="submit" value="Update"/>
<input  name="Delete"  class="btn btn-primary py-2 px-5" type="submit" value="Delete"/>
</div>
</form>
</section>



<?php
$all_row = oci_parse($conn, "SELECT m.MOVIE_ID, m.TITLE, m.YEAR, m.LENGTH, g.GENRE_NAME, c.COUNTRY_NAME, 
                                   gn.GENDER, p.PERSON_NAME FROM MOVIE m 
                                               JOIN MOVIE_GENRE mg ON m.MOVIE_ID=mg.MOVIE_ID
                                               JOIN GENRE g ON mg.GENRE_ID=g.GENRE_ID
                                               JOIN PRODUCTION_COUNTRY pc ON m.MOVIE_ID=pc.MOVIE_ID
                                               JOIN COUNTRY c ON pc.COUNTRY_ID=c.COUNTRY_ID
                                               JOIN MOVIE_CAST mc ON m.MOVIE_ID=mc.MOVIE_ID
                                               JOIN GENDER gn ON mc.GENDER_ID=gn.GENDER_ID
                                               JOIN PERSON p ON mc.PERSON_ID=p.PERSON_ID
                                               ORDER BY MOVIE_ID");

oci_execute($all_row);

echo'<table class="w3-table-all w3-small">
  <thead>
    <tr style="background-color: #212529; color: white">
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Length (min)</th>
      <th scope="col">Year</th>
      <th scope="col">Genre</th>
      <th scope="col">Country</th>
      <th scope="col">Gender</th>
      <th scope="col">Actor</th>
      <th scope="col">Update / Delete</th>
    </tr>
  </thead>
  <tbody>';
while(oci_fetch($all_row)){
    echo '
    <tr class="w3-hover-gray" style="cursor:pointer;"">
      <th scope="row">'.oci_result($all_row, 'MOVIE_ID').'</th>
      <td>'.oci_result($all_row, 'TITLE').'</td>
      <td>'.oci_result($all_row, 'LENGTH').'</td>
      <td>'.oci_result($all_row, 'YEAR').'</td>
      <td>'.oci_result($all_row, 'GENRE_NAME').'</td>
      <td>'.oci_result($all_row, 'COUNTRY_NAME').'</td>
      <td>'.oci_result($all_row, 'GENDER').'</td>
      <td>'.oci_result($all_row, 'PERSON_NAME').'</td>
      <td><a href="admin.php?id='.oci_result($all_row, 'MOVIE_ID').'">Select</a></td>
    </tr>';
}
echo '
</tbody>
</table>';
?>















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
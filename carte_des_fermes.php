<?php
//$website = 1;
//$url_hit = 'XadminZz/stats2/';
//include ($url_hit.'hit.php');
?>

<!DOCTYPE html>
<!--[if lte IE 8]>
<html class="ie8 no-js" lang="en">     <![endif]-->
<!--[if IE 9]>
<html class="ie9 no-js" lang="en-US">  <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->   
    
<html class="not-ie no-js" lang="en">  <!--<![endif]-->
<head>
    <!-- Google Web Fonts
    ================================================== -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,300italic,400,400italic,500,700%7cCourgette%7cRaleway:400,700,500%7cCourgette%7cLato:700'
          rel='stylesheet' type='text/css'>

    <!-- Basic Page Needs
    ================================================== -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Carte géographique de FERMES QUÉBEC - Photographie aérienne</title>

    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="images/favicon.png">

    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/grid.css"/>
    <link rel="stylesheet" href="css/layout.css"/>
    <link rel="stylesheet" href="css/fontello.css"/>
    <link rel="stylesheet" href="css/animation.css"/>

    <!-- HTML5 Shiv
    ================================================== -->
    <script src="js/jquery.modernizr.js"></script>
    
</head>
<body class="animated loaded" oncontextmenu="return false" ondragstart="return false" onselectstart="return false">

<div id="wrapper">

    <div id="mobile-menu" class="mobile-menu">

        <a href="#" id="menu-hide"></a>

    </div>


    <!-- - - - - - - - - - - - - Header - - - - - - - - - - - - - - -->


    <header id="header">

        <div class="top-header-line">

            <div class="container">

                <div class="row">

                    <div class="col-xs-12">
                        <div class="contact-icons clearfix">
                            <ul class="contact-details">
                                <li><i class=" icon-mail-5"></i>Courriel: <a href="mailto:info@fermes.quebec">info@fermes.quebec</a></li>
                                <li><i class="icon-phone-2"></i>514-953-2434</li>
                            </ul>
                        </div>

                    </div>

                </div>
                <!--/ .row-->

            </div>
            <!--/ .container-->

        </div>
        
        <!--/ .top-header-line-->

        <div class="middle-header-line">

            <div class="container">

                <div class="row">

                    <div class="col-md-12 col-sm-10">

                        <div class="header-in">

                            <h1 id="logo">
                                <a href="index.php"><img src="images/logo.png"></a>
                            </h1>

                            <a id="responsive-nav-button" class="responsive-nav-button" href="#"></a>

                            <div class="nav-wrapper">
                            <nav id="navigation" class="navigation">
                                <ul>
                                    <li><a href="index.php">ACCUEIL</a></li>
                                    <li><a href="galerie.php">GALERIE</a></li>
                                  <!--  <li ><a href="fermes.php">FERME QU&Eacute;BEC</a></li>-->
                                    <li><a href="services.php">FORFAITS</a></li>
                                    <li><a href="equipe.php">NOUS SOMMES</a></li>
                                    <li><a href="carte_des_fermes.php">CARTE</a></li>
                                    <li><a href="contacts.php">CONTACT</a></li>
                                </ul>

                            </nav>
                                <!--/ .navigation-->

                            </div>
                            <!--/ .nav-wrapper-->

                        </div>
                        <!--/ .header-in-->

                    </div>

                </div>
                <!--/ .row-->

            </div>
            <!--/ .container-->

        </div>
        <!--/ .middle-header-line-->

    </header>
    <!--/ #header-->

    <!-- - - - - - - - - - - - - end Header - - - - - - - - - - - - - - -->


    <!-- - - - - - - - - - - - - Content - - - - - - - - - - - - - - - -->

    <div id="content">

        <!--/ .section-->

        <section class="section padding-top-off">

            <div class="container">

                <div class="row">

                    <div class="col-xs-12">
                        <div class="section-title opacity" >
                            <h3>CARTE DES FERMES DU QUÉBEC<br></h3>

<iframe src="https://www.google.com/maps/d/embed?mid=1NivAjtrxte6XXctfHH8o9ouArGI" width="1080" height="610"></iframe>
<br />

 
 <h4><br />VISITEZ NOTRE <a href="galerie.php" target="_blank">GALERIE DE PHOTOS ET VIDÉOS</a><BR /><BR /><BR />
 Contactez-nous !  <a href="mailto:info@fermes.quebec">info@fermes.quebec</a> &nbsp;&nbsp;&nbsp;&nbsp;514-953-2434</h4>
			
                      </div>
                    </div>
	                
                

        </section>
        <!--/ .section-->
 
    </div>
    <!--/ #content-->
  </div>


    <!-- - - - - - - - - - - - end Content - - - - - - - - - - - - - -->


    <!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - -->


    <footer id="footer">

        <div class="entry-footer parallax parallax-bg-3">

            <div class="full-bg-image"></div>
            <div class="overlay-paralax"></div>

            <div class="container">

                <div class="row">
	                	                
                    <div class="col-xs-12">

                        <div class="offers">
                            <h1>OFFREZ-VOUS DES IMAGES A&Eacute;RIENNES DE GRANDE QUALIT&Eacute;!</h1>
                        </div>
                        

                    </div>

                </div>
                <!--/ .row-->

            </div>
            <!--/ .container-->

        </div>
        
        <!--/ .entry-footer-->

		<?php include('pub_jaune.php');?>
        <!--/ .clients-container-->

		<?php include('footer.php');?>

    </footer>
    <!--/ #footer-->
    
<?php
mysql_close();
?>


</div>
<!--/ #wrapper-->

<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>

<!--[if lt IE 9]>
<script src="js/respond.min.js"></script>
<![endif]-->

<script src="js/plugins.js"></script>
<script src="js/twitterFetcher_min.js"></script>
<script src="js/jquery.smoothscroll.js"></script>
<script src="js/jquery.resizegrid.js"></script>
<script src="js/imagesloaded.js"></script>
<script src="js/config.js"></script>
<script src="js/custom.js"></script>
</body>
</html>


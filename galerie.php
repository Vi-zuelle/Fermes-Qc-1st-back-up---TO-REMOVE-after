
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
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <title>Galerie - FERMES QUÉBEC - photographie aérienne et vidéo aérienne </title><br />
     <meta name="description" content="Visitez les Fermes du Québec du haut des airs: Photos et vidéos aériennes de grande qualité (obliques, orghogonales, HD, 4K) de votre ferme ou propriété agricole par des photographes aériens maîtres du ciel" />
    <META NAME="keywords" CONTENT="fermes québec,photographe aérien,photo aérienne,ferme,Québec,galerie, photos aériennes,vidéos,propriété agricole,fermette,Claude Duchaine,pilote,patrimoine,histoire des fermes au Québec,agriculture,fermes du Québec,Ferme Québec,fermes.quebec,Canada,archives,archive" />
    <meta name="author" content="Claude Duchaîne, Nicole Deschamps Inter-actif Communications, Johanne Berry,Air Imex,Airimex" />

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

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
<body class="animated loaded">
<?php include_once("analyticstracking.php") ?>
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

                    <div class="col-xs-12">

                        <div class="header-in">

                            <h1 id="logo">
                                <a href="index.php"><img src="images/logo.png"></a>
                            </h1>

                            <a id="responsive-nav-button" class="responsive-nav-button" href="#"></a>

                            <div class="nav-wrapper">
                            <nav id="navigation" class="navigation">
                                <ul>
                                    <li><a href="index.php">ACCUEIL</a></li>
                                    <li class="current-menu-item"><a href="galerie.php">GALERIE PHOTOS ET VIDÉOS</a></li>
                                 <!--   <li><a href="fermes.php">FERME QU&Eacute;BEC</a></li>-->
                                    <li><a href="cartographie_aerienne_agriculture.php">CARTOGRAPHIE AGRICULTURE DE PRÉCISION</a></li>
                                    <li><a href="services.php">FORFAITS</a></li>
                                    <li><a href="equipe.php">QUI SOMMES-NOUS?</a></li>
                         <!--              <li><a href="carte_des_fermes.php">CARTE</a></li>-->
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


    <!-- - - - - - - - - - - - - Header - - - - - - - - - - - - - - -->


    <div id="content">

        <section id="folio" class="page full-width">

            <section class="padding-bottom-off">

                <div class="container">

                    <div class="row">

                        <div class="col-xs-12">
                            <ul id="portfolio-filter" class="portfolio-filter" style="padding-left: 20px;">
                                <li class="filter active" data-filter="all">Toutes les photos</li>
                                <li class="filter" data-filter="obliques">Photos obliques</li>
                                <li class="filter" data-filter="orthogonales">Photos orthogonales</li>
                                <li class="filter" data-filter="archives">Photos d'archives</li>
                                <li class="filter" data-filter="videos"><a href="video_demo.php">Vid&eacute;os</a></li>
                            </ul>
                            <!--/ #portfolio-filter -->
                        </div>

                    </div>
                    <!--/ .row-->

                </div>
                <!--/ .container-->
                
				<?php
					include('connexion.php');
				
				//	$retoure = mysql_query('SELECT * FROM fermes ORDER BY rand()');
					$retoure = mysql_query('SELECT * FROM fermes ORDER BY nom ASC');
				?>	

                <div class="container">

                    <div class="row">

                        <div class="col-xs-12">

                            <section id="portfolio-items" class="portfolio-items col-4">
	                            
				        <?php        
					
						while ($donnees = mysql_fetch_array($retoure))
								{
									
				            if($donnees['photo1']){
					
			
								if($donnees['photo1_code'] == 1){
			
				                    	echo '<article class="obliques mix mix_all">';
			                    	
								} elseif($donnees['photo1_code'] == 2) {
									
				                    	echo '<article class="orthogonales mix mix_all">';
			                    	
								} elseif($donnees['photo1_code'] == 3) {
									
				                    	echo '<article class="archives mix mix_all">';
			
								} elseif($donnees['photo1_code'] == 0) {
									
				                    	echo '<article class="mix mix_all">';
			                    
								} ?>	

                                    <div class="work-item lazy-image img">
                                        <div class="lazy">
                                            <i class="G G_1"></i>
                                            <i class="G G_2"></i>
                                            <i class="G G_3"></i>
                                            <i class="G G_4"></i>
                                            <i class="G G_5"></i>
                                            <i class="G G_6"></i>
                                            <i class="G G_7"></i>
                                            <i class="G G_8"></i>
                                        </div>
                                        <img  src="images/fermes_quebec/photos/<?php echo $donnees['photo1']; ?>" alt="<?php echo $donnees['nom']; ?>" />
										<a href="details_ferme.php?id=<?php echo $donnees['id'];?>">
											
		                                <div class="image-extra">
		                                    <div class="extra-content">
		                                        <h2 class="extra-title"><?php echo stripslashes($donnees['nom']);?></h2>
		                                        <h6 class="extra-descript">
			                                        
			                                        <?php if($donnees['photo1_code'] == 1) {
				                                        echo 'Photos obliques';
				                                     } elseif($donnees['photo1_code'] == 2){
				                                        echo 'Photos orthogonales';
				                                     } elseif($donnees['photo1_code'] == 3){
				                                        echo 'Photos archive';
			                                         }?>
			                                        
			                                    </h6>
		                                    </div>
		                                    <!--/ .extra-content-->
                                </div>
                                <!--/ .image-extra-->
                            </a>
                           </div>
                                    <!--/ .work-item-->

                                </article>
                                
					<?php }
						}
					?>                                
                                


                            </section>
                            <!--/ .portfolio-items-->

                        </div>

                    </div>
                    <!--/ .row-->

                </div>
                <!--/ .container-->

            </section>
            <!--/ .padding-bottom-off-->

        </section>
        <!--/ .#folio-->


    </div>
    <!--/ #content-->
<?php
mysql_close();
?>

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
                           <h1>ADMIREZ LES PHOTOS DE VOTRE FERME DE VOTRE SALON !</h1>
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

        <!--/ .widget-area-->
		<?php include('footer.php');?>
    </footer>
    <!--/ #footer-->


</div>
<!--/ #wrapper-->

<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>

<!--[if lt IE 9]>
<script src="js/respond.min.js"></script>
<![endif]-->

<script src="js/plugins.js"></script>
<script src="js/twitterFetcher_min.js"></script>
<script src="js/jquery.smoothscroll.js"></script>
<script src="js/jquery.mixitup.js"></script>
<script src="js/jquery.resizegrid.js"></script>
<script src="js/imagesloaded.js"></script>
<script src="js/config.js"></script>
<script src="js/custom.js"></script>
</body>
</html>

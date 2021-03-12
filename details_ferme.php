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
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <title>D&eacute;tail des fermes - Fermes Qu&eacute;bec - Photos et vid&eacute;os </title>
    <meta name="description" content="Consultez les photos et vidéos aériennes de nos clients Fermes du Québec, (obliques, orghogonales, HD, 4K) de votre ferme ou propriété agricole réalisées par des photographes aériens maîtres du ciel" />
    <META NAME="keywords" CONTENT="fermes québec,photographe aérien,photo aérienne,ferme,Québec,photos aériennes,vidéos,propriété agricole,fermette,Claude Duchaine,pilote,patrimoine,histoire des fermes au Québec,agriculture,fermes du Québec,Ferme Québec,fermes.quebec,Canada,archives,archive" />
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

    <link rel="stylesheet" href="js/owlcarousel/owl.carousel.css"/>
    <link rel="stylesheet" href="js/owlcarousel/owl.theme.css"/>
    <link rel="stylesheet" href="js/owlcarousel/owl.transitions.css"/>

    <link rel="stylesheet" href="js/magnific-popup/magnific-popup.css"/>

    <!-- HTML5 Shiv
    ================================================== -->
    <script src="js/jquery.modernizr.js"></script>
	<script type="text/javascript" src="html5lightbox/jquery.js"></script>
	<script type="text/javascript" src="html5lightbox/html5lightbox.js"></script>
    

</head>
<body class="animated loaded" oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
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

                    <div class="col-md-12 col-sm-10">

                        <div class="header-in">

                        <h1 id="logo">
                                <a href="index.php"><img src="images/logo.png"></a>
                        </h1>

                        <a id="responsive-nav-button" class="responsive-nav-button" href="index.php"></a>

                            <div class="nav-wrapper">
                            <nav id="navigation" class="navigation">
                                <ul>
                                    <li><a href="index.php">ACCUEIL</a></li>
                                      <li><a href="galerie.php">GALERIE PHOTOS ET VIDÉOS</a></li>
                                    <li><a href="cartographie_aerienne_agriculture.php">CARTOGRAPHIE AGRICULTURE DE PRÉCISION</a></li>
                                    <li><a href="services.php">FORFAITS</a></li>
                                     <li><a href="equipe.php">QUI SOMMES-NOUS?</a></li>
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


    <!-- - - - - - - - - - - - - Content - - - - - - - - - - - - - - -->


	<?php
		include('connexion.php');
		
		$item = $_GET['id'];
		
		$result = mysql_query('SELECT * FROM fermes where id = "'.$item.'"');
		$data = mysql_fetch_array($result)
		
	?>	
		


    <div id="content">

        <div class="container">

            <div class="row">

                <div class="col-md-8">

                    <div class="side-image-slider opacity">

                        <ul id="image-slider" class="popup-gallery">


						<?php if($data['photo1']){?>
                            <li class="item">
                                <div class="image-entry">
                                    <a href="images/fermes_quebec/photos/<?php echo $data['photo1']; ?>" class="single-image popup-link lazy-image img">
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
                                        <img src="images/fermes_quebec/photos/<?php echo $data['photo1']; ?>"  width="923" alt="">
                                    </a>
                                </div>
                            </li>
                        <?php } ?>
                        
						<?php if($data['photo2']){?>
                            <li class="item">
                                <div class="image-entry">
                                    <a href="images/fermes_quebec/photos/<?php echo $data['photo2']; ?>" class="single-image popup-link">
                                        <img src="images/fermes_quebec/photos/<?php echo $data['photo2']; ?>"  width="923" alt="">
                                    </a>
                                </div>
                            </li>
                        <?php } ?>
                            
						<?php if($data['photo3']){?>
                            <li class="item">
                                <div class="image-entry">
                                    <a href="images/fermes_quebec/photos/<?php echo $data['photo3']; ?>" class="single-image popup-link">
                                        <img src="images/fermes_quebec/photos/<?php echo $data['photo3']; ?>"  width="923" alt="">
                                    </a>
                                </div>
                            </li>
                        <?php } ?>

						<?php if($data['photo4']){?>
                            <li class="item">
                                <div class="image-entry">
                                    <a href="images/fermes_quebec/photos/<?php echo $data['photo4']; ?>" class="single-image popup-link">
                                        <img src="images/fermes_quebec/photos/<?php echo $data['photo4']; ?>"  width="923" alt="">
                                    </a>
                                </div>
                            </li>
                        <?php } ?>

						<?php if($data['photo5']){?>
                            <li class="item">
                                <div class="image-entry">
                                    <a href="images/fermes_quebec/photos/<?php echo $data['photo5']; ?>" class="single-image popup-link">
                                        <img src="images/fermes_quebec/photos/<?php echo $data['photo5']; ?>"  width="923" alt="">
                                    </a>
                                </div>
                            </li>
                        <?php } ?>

						<?php if($data['photo6']){?>
                            <li class="item">
                                <div class="image-entry">
                                    <a href="images/fermes_quebec/photos/<?php echo $data['photo6']; ?>" class="single-image popup-link">
                                     <img src="images/fermes_quebec/photos/<?php echo $data['photo6']; ?>"  width="923" alt="">
                                    </a>
                                </div>
                            </li>
                        <?php } ?>

						<?php if($data['photo7']){?>
                            <li class="item">
                                <div class="image-entry">
                                    <a href="images/fermes_quebec/photos/<?php echo $data['photo7']; ?>" class="single-image popup-link">
                                     <img src="images/fermes_quebec/photos/<?php echo $data['photo7']; ?>"  width="923" alt="">
                                    </a>
                                </div>
                            </li>
                        <?php } ?>

                        
                        </ul>
                        <!--/ #image-slider-->

                    </div>
                    <!--/ .side-image-slider-->

                </div>
                <!--/ .col-md-8-->

                <div class="col-md-4">

                    <aside class="side-gallery-panel opacity">

                        <h2 class="side-gallery-title"><?php echo stripslashes($data['nom']);?></h2>

                        <p>
                            <?php echo stripslashes($data['descriptif']);?>
                        </p>
                        
                        <table width="100%">
	                        <tr>
		                        <td class="side-meta-title" width="120" align="left">Client: </td>
		                        <td class="side-text" width="450"> <?php echo stripslashes($data['nom']);?></td>
	                        </tr>
	                        <tr>
		                        <td class="side-meta-title" align="left">Adresse: </td>
		                        <td class="side-text"> <?php echo stripslashes($data['adresse']);?></td>
	                        </tr>
	                        
                             <?php if($data['web']) {?>
		                        <tr>
			                        <td class="side-meta-title" align="left">Site Web: </td>
		                            <td class="side-text"><strong><a href="HTTP://<?php echo $data['web'];?>" target ="_blank" > <?php echo $data['web'];?></a></strong></td>
		                        </tr>
							<?php }?>
							
<!--
                             <?php if($data['video']) {?>
		                        <tr>
			                        <td class="side-meta-title" align="right">Video: </b></td>
									<td valign="middle"><a href="JavaScript:html5Lightbox.showLightbox(3, '<?php echo $data['video_script']; ?>','', 923, 615);"> <img src="images/owl-video-play.png" width="20" align="left" /></a></td>
		                        </tr>
							<?php }?>
-->
                        </table>            
<br />
                        </div>
                        <!--/ .side-share-->

                        <div class="side-nav">
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="central" href="javascript:history.back();" title="Voir autres fermes" alt="Voir autres fermes" ></a>&nbsp;Retour &agrave; la galerie
                        </div>
		  <div class="side-nav">
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <font size="-1"><i> Cliquez sur les photos pour visionnement en diaporama </i></font>
                        </div>
                    </aside>
                    <!--/ .side-gallery-panel-->

                </div>
                <!--/ .col-md-4-->

            </div>
            <!--/ .row-->

            <div class="row">

                <div class="col-xs-12">
                    <h2 class="row-title" style="margin-left: 10px"> Autres photos </h2>
                </div>

            </div>
            <!--/ .row-->

            <div class="row">

                <div class="col-xs-12">
                    <ul class="rel-works small-font col-4">
	                    
	                <?php
		                
					$result2 = mysql_query('SELECT * FROM fermes ORDER BY rand() LIMIT 4');
									
	                while ($data2 = mysql_fetch_array($result2)){
					
	                ?>

                        <li>
                            <div class="work-item scale">
	                            
	                          <?php if($data2['photo1']){?>  
                                <img src="images/fermes_quebec/photos/<?php echo $data2['photo1']; ?>" alt="" />
                              <?php } ?>
                              
                                <a href="details_ferme.php?id=<?php echo $data2['id'];?>">
                                
                                    <div class="image-extra">
                                        <div class="extra-content">
											<h2 class="extra-title"><?php echo stripslashes($data2['nom']);?></h2>
                                            <h6 class="extra-descript"><?php echo stripslashes($data2['descriptif']);?></h6>
                                        </div>
                                        <!--/ .extra-content-->
                                    </div>
                                    <!--/ .image-extra-->
                                </a>
                            </div>
                            <!--/ .work-item-->
                        </li>

                    <!--/ .rel-works-->
					<?php }?>
					
					
                    </ul>
                </div>
                <!--/ .col-xs-12-->

            </div>
            <!--/ .row-->

        </div>
        <!--/ .container-->

    </div>
    <!--/ #content-->


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
                       <h1> OFFREZ-VOUS VOTRE FERME OU VOTRE PROPRIÉTÉ VUE DU HAUT DES AIRS <br /> PAR DES PHOTOGRAPHES ET VIDÉASTES AÉRIENS PROFESSIONNELS!</h1>
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

<!-- <script src="//code.jquery.com/jquery-1.12.0.min.js"></script> -->

<!--[if lt IE 9]>
<script src="js/respond.min.js"></script>
<![endif]-->

<script src="js/plugins.js"></script>
<script src="js/owlcarousel/owl.carousel.js"></script>
<script src="js/twitterFetcher_min.js"></script>
<script src="js/jquery.smoothscroll.js"></script>
<script src="js/jquery.resizegrid.js"></script>
<script src="js/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="js/imagesloaded.js"></script>
<script src="js/config.js"></script>
<script src="js/custom.js"></script>
</body>
</html>

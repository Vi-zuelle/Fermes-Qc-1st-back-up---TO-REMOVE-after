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

    <title>FERMES QUÉBEC - photo vidéo aériennes et cartographie agriculture de précision pour fermes</title>
    <meta name="description" content="Fermes.Québec : Photos et vidéos aériennes de grande qualité (obliques, orghogonales, agriculture de précision pour la mise à jour par l'agriculteur de ses cultures, 3D, 2D, HD, 4K), par Claude Duchaine spécialiste aérien" />
    <META NAME="keywords" CONTENT="Fermes Québec, agriculture de précision, photographe aérien,photographie aérienne,ferme,Québec, agriculteurs, photos aériennes,vidéos aériennes,propriété agricole,fermettes,Claude Duchaine,pilote,patrimoine,histoire des fermes au Québec,fermes du Québec,fermes.quebec,Canada,archives" />
    <meta name="author" content="Claude Duchaîne,Air Imex,Airimex, Nicole Deschamps Inter-actif Communications,Johanne Berry" />


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

    <link rel="stylesheet" href="js/sequence/sequencejs-theme.css"/>

    <!-- HTML5 Shiv
    ================================================== -->
    <script src="js/jquery.modernizr.js"></script>

</head>

<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
<?php include_once("analyticstracking.php") ?>
<div id="wrapper">

    <div id="mobile-menu" class="mobile-menu">

        <a href="#" id="menu-hide"></a>

    </div>

          <!--/ .top-header-line-->
          
               <div class="container">

                <div class="row">

                    <div class="col-xs-12">
                        <div align="right" class="contact-icons clearfix">
                            <ul class="contact-details">
<!--
                                <li><i class=" icon-mail-5"></i> <a href="mailto:info@fermes.quebec">info@fermes.quebec</a></li>
                                <li><i class="icon-phone-2"></i>438-499-2434</li>
-->
                            </ul>
                        </div>
                    </div>

                </div>
                <!--/ .row-->

            </div>
            <!--/ .container-->

        </div>
        
        <!--/ .top-header-line-->
    <!-- - - - - - - - - - - - - Header - - - - - - - - - - - - - - -->

    <header id="header" class="type-fixed">

        <div class="middle-header-line transparent-bg"> 

            <div class="container">

                <div class="row">

                    <div class="header-in">

                          <h1 id="logo">
                          	     FERMES QUÉBEC
                          
<!--                                <img src="images/logo.png" alt="FERMES QUÉBEC"  title="FERMES QUÉBEC"> -->
                          </h1>
                        
                        <a id="responsive-nav-button" class="responsive-nav-button" href="index.php"></a>

                        <div class="nav-wrapper">
                            <nav id="navigation" class="navigation">
                                <ul>
                                    <li class="current-menu-item"><a href="index.php">FERMES.QUEBEC</a></li>
                                    <li><a href="galerie.php">GALERIE PHOTOS ET VIDÉOS</a></li>
                                   <li><a href="cartographie_aerienne_agriculture.php">CARTOGRAPHIE AGRICULTURE DE PRÉCISION</a></li>
                                    <li><a href="services.php">FORFAITS</a></li>
                                     <li><a href="equipe.php">QUI SOMMES-NOUS?</a></li>
                                    <!--<li><a href="carte_des_fermes.php">CARTE</a></li>-->
                                    <li><a href="contacts.php">CONTACT</a></li>
                                </ul>

                            </nav>
                            <!--/ .navigation-->

                        </div>
                        <!--/ .nav-wrapper-->

                    </div>
                    <!--/ .header-in-->

                </div>
                <!--/ .row-->

            </div>
            <!--/ .container-->

        </div>
        <!--/ middle-header-line-->

    </header>
    <!--/ #header-->


    <!-- - - - - - - - - - - - end Header - - - - - - - - - - - - - -->

    <!-- - - - - - - - - - - - - Content - - - - - - - - - - - - -  -->


    <div id="content-padding-off">

        <div class="sequence-parallax">

            <div id="sequence">

                <span class="sequence-prev">Prev</span>
                <span class="sequence-next">Next</span>
                
                    <?php 
	                include('connexion.php');           
	                   
					$requete = "SELECT * FROM photos_accueil ORDER BY code ASC";
					$resultats = mysql_query($requete);

					//$data = mysql_fetch_array($resultats);
       				?>

                <ul class="sequence-canvas">
	                
	                
	                <?php
		                
		                
		                
		                while($data = mysql_fetch_array($resultats)){
	                ?>

                    <li class="slide-3 bg-animation">
                        <div class="slide-bg content-animation" style="background-image: url(images/diaporama_accueil/<?php echo $data['nom_photo'];?>);"></div>                  
                        <div class="overlay-paralax content-animation"></div>

                        <div class="sequence-container content-animation">

                            <div class="sequence-entry">
                              <div class="slide-text">
                                    <p></p>
                                </div>
                                
                                <div class="slide-title">
	                                <?php if($data['code'] == 1){?>
                                    <p style="margin-top: 30px;"> <img src="images/logo/logo_fermes_quebecTrajan.png"></p>
	                                <?php } ?>
	                                <p><?php echo $data['titre'];?></p>
                                    
                                </div>
								
                               

							   	<?php if($data['text_lien']){?>
                                <div class="slide-button" >
                                    <a href="<?php echo $data['lien'];?>" class="btn-cta"><?php echo $data['text_lien'];?></a>
                                </div>
								<?php } ?>
                                
                             </div>   
                           
                            <!--/ .sequence-entry-->

                    </div>
                        <!--/ .sequence-container-->

                    </li>
                    <!--/ .slide-1-->
                    <?php } ?>

                </ul>
                <!--/ .sequence-canvas-->

            </div>
            <!--/ #sequence-->

        </div>
        <!--/ .sequence-parallax-->

    </div>
    <!--/ #content-->


    <!-- - - - - - - - - - - - end Content - - - - - - - - - - - - - -->


    <!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - -->


    <footer id="footer">

		<?php include('pub_jaune.php');?>
        <!--/ .clients-container-->

		<?php include('footer.php');?>
		
    </footer>
	

    <!-- - - - - - - - - - - end Bottom Footer - - - - - - - - - - - -->


</div>
<!--/ #wrapper-->

<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>

<!--[if lt IE 9]>
<script src="js/respond.min.js"></script>
<![endif]-->

<script src="js/plugins.js"></script>
<script src="js/sequence/jquery.sequence-min.js"></script>
<script src="js/twitterFetcher_min.js"></script>
<script src="js/jquery.smoothscroll.js"></script>
<script src="js/jquery.resizegrid.js"></script>
<script src="js/config.js"></script>
<script src="js/custom.js"></script>

</body>
</html>
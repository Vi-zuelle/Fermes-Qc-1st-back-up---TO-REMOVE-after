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
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

    <title>Liste des Fermes - Photos et vid&eacute;os a&eacute;riennes - FERMES.QU&Eacute;BEC </title>

    <meta name="description" content="">
    <meta name="author" content="">

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
<body class="animated loaded" oncontextmenu="return false" ondragstart="return false" onselectstart="return false">

<div id="wrapper">

    <div id="mobile-menu" class="mobile-menu">

        <a href="#" id="menu-hide"></a>

    </div>


    <!-- - - - - - - - - - - - - Header - - - - - - - - - - - - - - ------>


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
                                      <li><a href="galerie.php">GALERIE PHOTOS ET VIDÉOS</a></li>
                                    <li><a href="cartographie_aerienne_agriculture.php">CARTOGRAPHIE AGRICULTURE DE PRÉCISION</a></li>
                                    
                                    <li><a href="services.php">SERVICES</a></li>
                                    <li><a href="equipe.php">QUI SOMMES-NOUS?</a></li>
                                   <!-- <li><a href="concours_inscription.php">PROMOTION</a></li>-->
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
                        <div class="section-title opacity">
                            <h3>Liste des Fermes</h3>
                            <h4>Par ordre alphab&eacute;tique</h4>
                            <h4>RECHERCHE - TROUVER UNE FERME - par nom, ville ou mot clé</h4>
                        </div>
                    </div>
                    
	                <?php 
		             include('connexion.php');   
		                
		          	 $requete = "SELECT * FROM fermes ORDER BY nom ASC";
				  	 $resultats = mysql_query($requete);
					?>
	                
	                <table>
		                
			                <?php while($data = mysql_fetch_array($resultats)) {?>
								 
								  <tr>
									<td>
										
									<strong><?php echo stripslashes($data["nom"]);?></strong><br />
									<?php echo stripslashes($data["adresse"]);?><br />
									
									<?php if($data['web']){?>
									<a href="HTTP://<?php echo $data['web'];?>" target ="_blank" ><?php echo $data['web'];?></a><br />
									<?php }?>
									<br />
	
									<a href="details_ferme.php?id=<?php echo $data['id'];?>" class='dinfo'>	
									<img  src="images/fermes_quebec/photos/<?php echo $data['photo1'];?>" width = "120" hspace = "10" />
									<infos>
										<ul style="line-height:16px">
										<li>Prise de vue</li>	
										<li><?php if($data['photo1_code'] == 1){ echo 'Oblique'; } else { echo 'Orthogonale'; } ?></li>
										</ul>
									</infos>
									</a>

									
									<?php if($data['photo2']){?>
									<a href="details_ferme.php?id=<?php echo $data['id'];?>" class='dinfo'>	
										<img  src="images/fermes_quebec/photos/<?php echo $data['photo2'];?>" width = "120" hspace = "10" />
									<infos>
										<ul style="line-height:16px">
										<li>Prise de vue</li>	
										<li><?php if($data['photo2_code'] == 1){ echo 'Oblique'; } else { echo 'Orthogonale'; } ?></li>
										</ul>
									</infos>
									</a>
									<?php }?>
									
									<?php if($data['photo3']){?>
									<a href="details_ferme.php?id=<?php echo $data['id'];?>" class='dinfo'>	
										<img  src="images/fermes_quebec/photos/<?php echo $data['photo3'];?>" width = "120" hspace = "10" class='dinfo' />
									<infos>
										<ul style="line-height:16px">
										<li>Prise de vue</li>	
										<li><?php if($data['photo3_code'] == 1){ echo 'Oblique'; } else { echo 'Orthogonale'; } ?></li>
										</ul>
									</infos>
									</a>
									<?php }?>

									<?php if($data['photo4']){?>
									<a href="details_ferme.php?id=<?php echo $data['id'];?>" class='dinfo'>	
										<img  src="images/fermes_quebec/photos/<?php echo $data['photo4'];?>" width = "120" hspace = "10"  />
									<infos>
										<ul style="line-height:16px">
										<li>Prise de vue</li>	
										<li><?php if($data['photo4_code'] == 1){ echo 'Oblique'; } else { echo 'Orthogonale'; } ?></li>
										</ul>
									</infos>
									</a>
									<?php }?>
									
									<?php if($data['photo5']){?>
									<a href="details_ferme.php?id=<?php echo $data['id'];?>" class='dinfo'>	
										<img  src="images/fermes_quebec/photos/<?php echo $data['photo5'];?>" width = "120" hspace = "10"  />
									<infos>
										<ul style="line-height:16px">
										<li>Prise de vue</li>	
										<li><?php if($data['photo5_code'] == 1){ echo 'Oblique'; } else { echo 'Orthogonale'; } ?></li>
										</ul>
									</infos>
									</a>
									<?php }?>
									
<!--
									<?php if($data['video']){?>
										<a href="<?php echo $data['video_script'];?>" target="_blank" class="dinfo"><img  src="images/fermes_quebec/video/<?php echo $data['video'];?>" width = "120" hspace = "10" />
									<infos>
										<ul style="line-height:16px">
										<li>Prise de vue</li>	
										<li>Vidéo</li>
										<li>Cliquez pour démarrer la vidéo</li>
										</ul>
									</infos>
										</a>
									<?php }?>
-->

									<?php if($data['archive']){?>
									<a href="details_ferme.php?id=<?php echo $data['id'];?>" class='dinfo'>	
										<img  src="images/fermes_quebec/archives/<?php echo $data['archive'];?>" width = "120" hspace = "10" />
									<infos>
										<ul style="line-height:16px">
										<li>Archive 1</li>
										<li>de Prises de vue</li>	
										</ul>
									</infos>
										</a>
									<?php }?>

									<?php if($data['archive2']){?>
									<a href="details_ferme.php?id=<?php echo $data['id'];?>" class='dinfo'>	
										<img  src="images/fermes_quebec/archives/<?php echo $data['archive2'];?>" width = "120" hspace = "10" />
									<infos>
										<ul style="line-height:16px">
										<li>Archive 2</li>
										<li>de Prises de vue</li>	
										</ul>
									</infos>
										</a>
									<?php }?>
									
									<br />

									<hr width="500" align="center"><br />
									</td>									
								  </tr>
							 
				  		   <?php 
							
						   } //***************************************************************************************************************
						   ?>
	                
	                </table>    
	                
                    
                    
                    

                </div>
                <!--/ .row-->

            </div>
            <!--/ .container-->

        </section>
        <!--/ .section-->

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
                            <h1>precise project planning, modern design and satisfying results!</h1>
                        </div>

                    </div>

                </div>
                <!--/ .row-->

            </div>
            <!--/ .container-->

        </div>
        
        <!--/ .entry-footer-->

        <div class="clients-container">

            <section class="container">

                <div class="row">

                    <div class="col-xs-12">
                        <ul class="client-items">
                            <li><a href="http://www.airimex.ca" target="_blank"><img alt="" src="images/clients/client-1-airimex.png"></a></li>
                        </ul>
                    </div>

                </div>
                <!--/ .row-->

            </section>
            <!--/ .container-->

        </div>
        <!--/ .clients-container-->

		<?php include('footer.php');?>

    </footer>
    <!--/ #footer-->
<?php
mysql_close();
?>


    <!-- - - - - - - - - - - - - end Footer - - - - - - - - - - - - - -->


    <!-- - - - - - - - - - - - Bottom Footer - - - - - - - - - - - - -->



    <!-- - - - - - - - - - - end Bottom Footer - - - - - - - - - - - -->


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
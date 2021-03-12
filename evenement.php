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

<?php 
$x_action = $_GET['actionx'];

	if($x_action == 'ok'){
		include("connexion.php");
		
		$x_entreprise = $_GET['entreprise'];
		$x_civil      = $_GET['civil'];
		$x_nom        = $_GET['nom'];
		$x_prenom     = $_GET['prenom'];
		$x_fonction   = $_GET['fonction'];
		$x_tph        = $_GET['tph'];
		$x_mail       = $_GET['mail'];
		$x_adresse    = $_GET['adresse'];
		$x_ville      = $_GET['ville'];
		$x_cp         = $_GET['cp'];
		$x_secteur    = $_GET['secteur'];
		
		mysql_query("INSERT INTO concour(entreprise,raison,nom3,prenom3,fonction,tph,mail,adresse,ville,cp,secteur) VALUES('".$x_entreprise."','".$x_civil."','".$x_nom."','".$x_prenom."','".$x_fonction."','".$x_tph."','".$x_mail."','".$x_adresse."','".$x_ville."','".$x_cp."','".$x_secteur."')");

		mysql_close();
?>		 
		
    <script type="text/javascript">
		<!--
		setTimeout(alert('Votre inscription au concours a bien �t� enregistr�e'),5000);	 
		window.location.replace("index.php");
		
		//-->
	</script>		

<?php		
		//header("Location: index.php");
		exit;
	}	
?>    
    
<html class="not-ie no-js" lang="en">  <!--<![endif]-->
<head>
    <!-- Google Web Fonts
    ================================================== -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,300italic,400,400italic,500,700%7cCourgette%7cRaleway:400,700,500%7cCourgette%7cLato:700'
          rel='stylesheet' type='text/css'>

    <!-- Basic Page Needs
    ================================================== -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>&Eacute;V&Eacute;NEMENT -  Photos et vid&eacute;os a&eacute;riennes - FERMES.QU&Eacute;BEC</title>

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
                                    <li><a href="concours_inscription.php">PROMOTION</a></li>
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
                            <h3><font color="#ffd200">&Eacute;V&Eacute;NEMENT EXPO SAINT-HYACINTHE <BR />
27 juillet au 6 août 2016</font></h3><br />  
                           <h4>Venez nous retrouver chaque jour entre 11h et 22h30<br /> <strong><font color="#ffd200"><u>EMPLACEMENT C-350</u></font></strong> </h4>
                          <iframe width="853" height="480" src="https://www.youtube.com/embed/cl-07abagEQ?rel=0" frameborder="0" allowfullscreen></iframe><br />
                            <a href="http://www.expo-agricole.com"><h4><font color="#ffd200">www.expo-agricole.com</font></h4></a><br />
                           
                           <h4>Vous pourrez y d&eacute;couvrir des exemples de prises de vue sur &eacute;cran 4K de 55', admirer des affiches
imprim&eacute;es, vous donner une id&eacute;e du rendu final et surtout discuter avec nous de vos projets!
<br /><br />
TENTEZ VOTRE CHANCE &Agrave; NOTRE KIOSQUE : <br /> Le concours sur place permet de gagner deux forfaits obliques gr&acirc;ce &agrave; deux tirages au sort. 
Et toutes les commandes faites au stand permettent d'obtenir un rabais de 50$. 
Consultez <a href="services.php"><strong><font color="#ffd200">NOS TROIS FORFAITS</font></strong></a>.
</h4>
 <h4> 
<!-- <img src="images/evenements/evenement-st-hyacinthe_fermesqc.jpg"><br />-->
DE NOMBREUX KIOSQUES VOUS ATTENDENT : ANIMAUX DE FERMES, SPECTACLES, MAN&Egrave;GES..</h4><br />
 <a href="http://www.expo-agricole.com"><h4><font color="#ffd200">www.expo-agricole.com</font></h4></a>
 
 <h4> VENEZ NOUS RENCONTRER: <br /><br /><strong><font color="#ffd200"><u>EMPLACEMENT C-350</u></font></strong> </h4>
			
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
                            <h1>SOYEZ LES PREMIERS &Agrave; VOUS OFFRIR DES IMAGES A&Eacute;RIENNES DE GRANDE QUALIT&Eacute;!</h1>
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
                         <li><a href="evenement.php" target="_blank"><H4>EXPO ST-HYACINTHE 27 JUIL. AU 6 AOÛT&nbsp;&nbsp;- &nbsp;&nbsp;</H4></a></li>
                         <li><a href="http://www.airimex.ca" target="_blank"><img alt="" src="images/clients/client-1-airimex.png"></a></li>
                                   <li><a href="concours_inscription.php" target="_blank"><H4>&nbsp;&nbsp;- &nbsp;&nbsp;PROMOTION</H4></a></li>
                            
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


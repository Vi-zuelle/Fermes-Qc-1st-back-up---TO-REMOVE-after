
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
		$x_forfait    = $_GET['forfait'];
		$x_date_ins    = $_GET['date_ins'];
				
		mysql_query("INSERT INTO concour(entreprise,raison,nom3,prenom3,fonction,tph,mail,adresse,ville,cp,secteur,forfait,date_ins) VALUES('".$x_entreprise."','".$x_civil."','".$x_nom."','".$x_prenom."','".$x_fonction."','".$x_tph."','".$x_mail."','".$x_adresse."','".$x_ville."','".$x_cp."','".$x_secteur."','".$x_forfait."','".$x_date_ins."')");

		mysql_close();
		
		?>		 
		
	    <script type="text/javascript">
			<!--
			setTimeout(alert('Votre inscription pour la Promotion a bien été enregistrée'),3000);	 
			window.location.replace("index.php");
			
			//-->
		</script>
		
		
		<!--     Envoie avis courriel          -->
		
		<?php
		$mail = 'info@fermes.quebec'; // Déclaration de l'adresse de destination.
		if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
		{
			$passage_ligne = "\r\n";
		}
		else
		{
			$passage_ligne = "\n";
		}
		//=====Déclaration des messages au format texte et au format HTML.
		$message_txt = $x_nom." s'est inscrit pour la promotion d'un ".$x_forfait.".";
		$message_html = "<html><head></head><body><b>".$x_nom." ".$x_prenom."</b> s'est inscrit pour la promotion d'un <strong>".$x_forfait."</strong><br />
		<strong>adresse:</strong> ".$x_adresse." vile de ".$x_ville."<br />
		<strong>Téléphone: </strong>".$x_tph."<br />
		<strong>Courriel: </strong>".$x_mail.".</body></html>";
		//==========
		 
		//=====Création de la boundary
		$boundary = "-----=".md5(rand());
		//==========
		
		 
		//=====Définition du sujet.
		$sujet = "Inscription pour la promotion!";
		//=========
		 
		//=====Création du header de l'e-mail.
		$header = "de: ".$x_nom." ".$x_mail."".$passage_ligne;
		//$header.= "Reply-to: ".$x_mail." ".$passage_ligne;
		$header.= "MIME-Version: 1.0".$passage_ligne;
		$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
		//==========
		 
		//=====Création du message.
		$message = $passage_ligne."--".$boundary.$passage_ligne;
		//=====Ajout du message au format texte.
		$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne.$message_txt.$passage_ligne;
		//==========
		$message.= $passage_ligne."--".$boundary.$passage_ligne;
		//=====Ajout du message au format HTML
		$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne.$message_html.$passage_ligne;
		//==========
		$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
		$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
		//==========
		 
		//=====Envoi de l'e-mail.
		mail($mail,$sujet,$message,$header);
		
		//========== Fin envoie avis
		
		
		
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

    <title>PROMOTION - FERMES.QUEBEC - Photos et vid&eacute;os a&eacute;riennes</title>

    <meta name="description" content="Offrez-vous des photographies aériennes et courez la chance de gagner un de nos forfaits de photos obliques, orthogonales ou vidéos aériennes">
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
                                    <li class="current-menu-item"><a href="concours_inscription.php">PROMOTION</a></li>
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
                            <h3><font color="#ffd200">Un tirage au sort sera effectu&eacute;<br /> tous les 15 jours vous donnant <BR />un rabais 50$ sur nos tarifs en vigueur!</font></h3><br /><BR />
                           <h3>Inscription pour la Promotion</h3> 
			
                        </div>
                    </div>
	                
                    <div class="container">
                     <div class="col-xs-12">
                    Veuillez remplir tous les champs dot&eacute;s d'un * pour &ecirc;tre &eacute;ligible &agrave; cette promotion.<br /><br />
                 CHOISISSEZ LE FORFAIT QUI VOUS CONVIENT : 
	                <form action="concours_inscription.php" enctype="text/plain" name="zz">
	                		<input type="hidden" value="ok" name="actionx" id="actionx">
	                		
	                		<input type="hidden" value="<?php echo date('Y-m-d'); ?>" name="date_ins" id="date_ins">

                                    <p class="input-block">
										<strong></strong> 
                                        <input type="radio" id="forfait"  name="forfait" value="Forfait photos obliques" checked="" required=""/> Forfait photo oblique &nbsp;&nbsp;&nbsp; 
                                        <input type="radio" id="forfait"  name="forfait" value="Forfait photos orthogonales" required=""/> Forfait photo orthogonale &nbsp;&nbsp;&nbsp; 
                                        <input type="radio" id="forfait"  name="forfait" value="Forfait vidéos" required=""/> Forfait vid&eacute;o 
                                    </p>
                           
                                    <p class="input-block">
										<strong></strong> 
                                        <input type="radio" id="civil"  name="civil" value="M" checked="" required=""/> M ou 
                                        <input type="radio" id="civil"  name="civil" value="Mme" required=""/> Mme  </p>
                                    <p class="input-block">
										<input type="text" name="nom" id="nom" placeholder="Nom *" value="" required="" />
                                    </p>	
                                    <p class="input-block">
										<input type="text" name="prenom" id="prenom" placeholder="Pr&eacute;nom *" value="" required="" />
                                    </p>
                                     <p class="input-block">
										<input type="text" name="entreprise" id="entreprise" placeholder="Entreprise *" value="" required="" />
                                    </p>	
                               
                                    <p class="input-block">
										<input type="text" name="fonction" id="fonction" placeholder="Fonction *" value="" required="" />
                                    </p>	
                                 
                                    <p class="input-block">
										<input type="text" name="tph" id="tph" placeholder="T&eacute;l&eacute;phone *" value="" required="" />
                                    </p>	
                                
                                    <p class="input-block">
										<input type="text" name="mail" id="mail" placeholder="Courriel *" value="" required="" />
                                    </p>	
                                    <p class="input-block">
										<input type="text" name="adresse" id="adresse" placeholder="Adresse *" value="" required="" />
                                    </p>	
                                    <p class="input-block">
										<input type="text" name="ville" id="ville" placeholder="Ville *" value="" required="" />
                                    </p>	
                                    <p class="input-block">
										<input type="text" name="cp" id="cp" placeholder="Code postal *" value="" required="" />
                                    </p>	
                                    <p class="input-block">
										<input type="text" name="secteur" id="ville" placeholder="Secteur d'activit&eacute; *" value="" required="" />
                                    </p>
                                        <button id="submit" class="button default input-block-last" type="submit">
                                            Soumettre
                                        </button>

                    </form> 
                
                    </div>
                    </div>
                  

                </div>
                <!--/ .row-->

            </div>
            <!--/ .container-->

        </section>
        <!--/ .section-->
  <div class="col-xs-12" align="center"><H5> Note : Avec cette participation, vous autorisez FERMES QUEBEC <BR />&agrave; vous envoyer des courriels d'informations afin de vous proposer nos offres et services. </H5>
    </div>
    </div>
    <!--/ #content-->
  </div>
<!--<?php include ('compte_rebours.php');?>-->

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
                            <h1>SOYEZ LES PREMIERS &Agrave; VOUS OFFRIR DES PHOTOS ET VIDÉOS A&Eacute;RIENNES !</h1>
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
                        
                              <li><a href="galerie.php" target="_blank"><H4>FERMES QUÉBEC : VISITEZ NOTRE GALERIE</H4></a></li>
                              <li><a href="http://www.airimex.ca" target="_blank">&nbsp;&nbsp;<img alt="Air Imex Ltée, photographe aérien Claude Duchaine" title="Air Imex Ltée, photographe aérien Claude Duchaine" src="images/clients/client-1-airimex.png"></a></li>
                               <li><a href="concours_inscription.php" target="_blank"><H4>&nbsp;&nbsp;&nbsp;&nbsp;PROMOTION</H4></a></li>
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


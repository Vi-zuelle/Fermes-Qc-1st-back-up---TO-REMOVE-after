
<style type="text/css">

/*!!!!!!!!!!! QuickMenu Core CSS [Do Not Modify!] !!!!!!!!!!!!!*/
.qmmc .qmdivider
{
	display:block;
	font-size:1px;
	border-width:0px;
	border-style:solid;
	position:relative;
	z-index:1;
	}
	
.qmmc .qmdividery
{
	float:left;
	width:0px;
	}
	
.qmmc .qmtitle
{
	display:block;
	cursor:default;
	white-space:nowrap;
	position:relative;
	z-index:1;
	}
	
.qmclear 
{
	font-size:1px;
	height:0px;
	width:0px;
	clear:left;
	line-height:0px;
	display:block;
	float:none !important;
	}
	
.qmmc 
{
	position:relative;
	zoom:1;
	z-index:10;
	}
	
.qmmc a, .qmmc li 
{
	float:left;
	display:block;
	white-space:nowrap;
	position:relative;
	z-index:1;
	}
	
.qmmc div a, .qmmc ul a, .qmmc ul li 
{
	float:none;
	}
	
.qmsh div a 
{
	float:left;
	}
	
.qmmc div
{
	visibility:hidden;
	position:absolute;
	}
	
.qmmc .qmcbox
{
	cursor:default;
	display:block;
	position:relative;
	z-index:1;
	}
	
.qmmc .qmcbox a
{
	display:inline;
	}
	
.qmmc .qmcbox div
{
	float:none;
	position:static;
	visibility:inherit;
	left:auto;
	}
	
.qmmc li 
{
	z-index:auto;
	}
	
.qmmc ul 
{
	left:-10000px;
	position:absolute;
	z-index:10;
	}
	
.qmmc, .qmmc ul 
{
	list-style:none;
	padding:0px;
	margin:0px;
	}
	
.qmmc li a 
{
	float:none;
	}
	
.qmmc li:hover>ul
{
	left:auto;
	}
	
#qm0 ul 
{
	top:100%;
	}
	
#qm0 ul li:hover>ul
{
	top:0px;
	left:100%;
	}
	


/*!!!!!!!!!!! QuickMenu Styles [Please Modify!] !!!!!!!!!!!*/


	/* QuickMenu 0 */

	/*"""""""" (MAIN) Items""""""""*/	
	#qm0 a	
	{	
		padding:5px 4px 5px 5px;
		color:#555555;
		font-family:Arial;
		font-size:10px;
		text-decoration:none;
	}


	/*"""""""" (SUB) Container""""""""*/	
	#qm0 div, #qm0 ul	
	{	
		padding:10px;
		margin:-2px 0px 0px 0px;
		background-color:transparent;
		border-style:none;
	}


	/*"""""""" (SUB) Items""""""""*/	
	#qm0 div a, #qm0 ul a	
	{	
		padding:3px 10px 3px 5px;
		background-color:transparent;
		font-size:11px;
		border-width:0px;
		border-style:none;
	}


	/*"""""""" (SUB) Hover State"""""DADADA"""*/	
	#qm0 div a:hover	
	{	
		background-color:#fef4e3; 
		color:#CC0000;
	}


	/*"""""""" (SUB) Hover State - (duplicated for pure CSS)""""""""*/	
	#qm0 ul li:hover>a	
	{	
		background-color:#fef4e3;
		color:#CC0000;
	}


	/*"""""""" (SUB) Active State""""""""*/	
	body #qm0 div .qmactive, body #qm0 div .qmactive:hover	
	{	
		background-color:#fde8c3;
		color:#CC0000;
	}


	/*"""""""" Individual Titles""""""""*/	
	#qm0 .qmtitle	
	{	
		cursor:default;
		padding:3px 0px 3px 4px;
		color:#6c2032;
		font-family:verdana;
		font-size:11px;
		font-weight:bold;
	}


	/*"""""""" Individual Horizontal Dividers""""""""*/	
	#qm0 .qmdividerx	
	{	
		border-top-width:1px;
		margin:4px 0px 4px 0px;
		border-color:#BFBFBF;
	}


	/*"""""""" Individual Vertical Dividers""""""""*/	
	#qm0 .qmdividery	
	{	
		border-left-width:1px;
		height:15px;
		margin:4px 2px 0px 2px;
		border-color:#AAAAAA;
	}


	/*"""""""" (main) Rounded Items""""""""*/	
	#qm0 .qmritem span	
	{	
		border-color:#DADADA;
		background-color:#fde8c3;
	}


	/*"""""""" (main) Rounded Items Content""""""""*/	
	#qm0 .qmritemcontent	
	{	
		padding:0px 0px 0px 4px;
	}


	/*"""""""" Custom Rule""""""""*/	
	ul#qm0 ul	
	{	
		padding:10px;
		margin:-2px 0px 0px 0px;
		background-color:#FCD99D;
		border-width:1px;
		border-style:solid;
		border-color:#DADADA;
	}


	/*"""""""" Custom Rule""""""""*/	
	ul#qm0 li:hover > a	
	{	
		background-color:#fde8c3;
	}


</style>

<!-- Add-On Core Code (Remove when not using any add-on's) -->
<style type="text/css">
.qmfv
{
	visibility:visible !important;
	}
	
.qmfh
{
	visibility:hidden !important;
	}
    
</style>

<script type="text/javascript">
qmad=new Object();
qmad.bvis="";
qmad.bhide="";
</script>

	<!-- Add-On Settings -->
	<script type="text/JavaScript">

		/*******  Menu 0 Add-On Settings *******/
		var a = qmad.qm0 = new Object();

		// Rounded Corners Add On
		a.rcorner_size = 6;
		a.rcorner_border_color = "#dadada";
		a.rcorner_bg_color = "#fde8c3"; // F7F7F7
		a.rcorner_apply_corners = new Array(false,true,true,true);
		a.rcorner_top_line_auto_inset = true;

		// Rounded Items Add On
		a.ritem_size = 4;
		a.ritem_apply = "main";
		a.ritem_main_apply_corners = new Array(true,true,false,false);
		a.ritem_show_on_actives = true;

	</script>
<script type="text/javascript" language="JavaScript1.2" src="menu/menu2.js"></script>


<?php
function dateFR($date) {
$date = explode('-',$date);
return ($date[2].'-'.$date[1].'-'.$date[0]);
}
?>

<table cellpadding=0 cellspacing=0 width="600" align="right">
        <tr align="left">
        <td>
        
    <ul id="qm0" class="qmmc">
   
        <li><a class="qmparent" href="javascript:void(0)">FERMES ET PROMO</a>

		  <ul>
       	  	<li><a href="photos_accueil_liste.php">&nbsp;Photos accueil</a></li>

       	  	<li><a href="fermes_liste.php">&nbsp;Liste des fermes</a></li>
       	  	<li><a href="export_csv.php">&nbsp;Export pour Excel</a></li>
<!--
       	  	<li><a href="videos_liste.php">&nbsp;Liste des videos</a></li>
       	  	<li><a href="videos3d_liste.php">&nbsp;Liste des videos 3D</a></li>
-->
		</ul>
        </li>

        <li><span class="qmdivider qmdividery" ></span></li>
        <li><a class="qmparent" href="#">ADMINISTRATION</a>
      	<ul>
            <li><a href="admin_liste.php">&nbsp;Gestion des administrateurs</a></li>
<!--             <li><a href="stats2/" target="_blank">&nbsp;Statistiques</a></li> -->
            <li><a href="backup.php">&nbsp;Sauvegarde de la base de donn&eacute;es</a></li>
        </ul>
        </li>
        
         <li><span class="qmdivider qmdividery" ></span></li>
        <li><a class="qmparent" href="../../index.php" target="_blank">VOIR LE SITE</a></li>              
                
        <li><span class="qmdivider qmdividery" ></span></li>
            
            <li><a class="qmparent" href="logout.php">D&Eacute;CONNEXION</a></li>

            <li class="qmclear">&nbsp;</li>
         </ul>

        </td>
        </tr>
</table>
<br /><br />
<!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click ('all', 'main' or 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
<script type="text/javascript">qm_create(0,false,0,500,false,false,false,false,false);</script>

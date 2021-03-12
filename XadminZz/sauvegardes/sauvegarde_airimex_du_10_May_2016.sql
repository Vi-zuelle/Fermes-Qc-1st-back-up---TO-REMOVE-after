-- ----------------------
-- dump de la base  au 10-May-2016
-- ----------------------


-- -----------------------------
-- creation de la table administrateurs
-- -----------------------------
CREATE TABLE `administrateurs` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `passe` varchar(50) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table photo
-- -----------------------------
CREATE TABLE `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mignature` text NOT NULL,
  `grosse` text NOT NULL,
  `code` int(4) DEFAULT NULL,
  `description` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table photo2
-- -----------------------------
CREATE TABLE `photo2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grosse` text NOT NULL,
  `code` int(4) DEFAULT NULL,
  `description` mediumtext,
  `script` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table videos
-- -----------------------------
CREATE TABLE `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classement` int(5) DEFAULT NULL,
  `description` mediumtext,
  `script` mediumtext NOT NULL,
  `vignette` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table videos_3d
-- -----------------------------
CREATE TABLE `videos_3d` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classement` int(5) DEFAULT NULL,
  `description` mediumtext,
  `script` mediumtext NOT NULL,
  `vignette` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;



-- -----------------------------
-- insertions dans la table administrateurs
-- -----------------------------
INSERT INTO administrateurs VALUES(1, 'alain', 'alain', 1);
INSERT INTO administrateurs VALUES(2, 'nicole', 'nicole', 1);
INSERT INTO administrateurs VALUES(11, 'claude', 'claude', 1);

-- -----------------------------
-- insertions dans la table photo
-- -----------------------------
INSERT INTO photo VALUES(23, 'admin/Mignature/74M3932R0014Incendie.jpg', 'admin/Grosse/673932R0014Incendie.jpg', 2, 'Description');
INSERT INTO photo VALUES(24, 'admin/Mignature/58M4060-15BaleineContrecoeur.jpg', 'admin/Grosse/184060-15BaleineContrecoeur.jpg', 1, ' ');
INSERT INTO photo VALUES(26, 'admin/Mignature/90M4223-18BlocsApt.jpg', 'admin/Grosse/694223-18BlocsApt.jpg', 2, ' ');
INSERT INTO photo VALUES(27, 'admin/Mignature/47M4235-05St-VallierManoir.jpg', 'admin/Grosse/834235-05St-VallierManoir.jpg', , '');
INSERT INTO photo VALUES(28, 'admin/Mignature/99M4776-04UMcGill.jpg', 'admin/Grosse/374776-04UMcGill.jpg', , '');
INSERT INTO photo VALUES(30, 'admin/Mignature/81M4850C0013IndustrieChimique.jpg', 'admin/Grosse/704850C0013IndustrieChimique.jpg', , '');
INSERT INTO photo VALUES(31, 'admin/Mignature/14M4875B-11Montreeal.jpg', 'admin/Grosse/104875B-11Montreeal.jpg', , '');
INSERT INTO photo VALUES(32, 'admin/Mignature/75M4902-02AeeroportDorval.jpg', 'admin/Grosse/694902-02AeeroportDorval.jpg', , '');
INSERT INTO photo VALUES(33, 'admin/Mignature/62M4998-04Pl.jpg', 'admin/Grosse/704998-04Pl.jpg', , '');
INSERT INTO photo VALUES(34, 'admin/Mignature/21M5002B-06Jeesuites.jpg', 'admin/Grosse/285002B-06Jeesuites.jpg', , '');
INSERT INTO photo VALUES(35, 'admin/Mignature/65M5012-02St-Vallier.jpg', 'admin/Grosse/585012-02St-Vallier.jpg', , '');
INSERT INTO photo VALUES(36, 'admin/Mignature/1M40170002St-VallierHiver.jpg', 'admin/Grosse/5540170002St-VallierHiver.jpg', , '');
INSERT INTO photo VALUES(37, 'admin/Mignature/48M46280024MontRoyal.jpg', 'admin/Grosse/8246280024MontRoyal.jpg', , '');
INSERT INTO photo VALUES(38, 'admin/Mignature/92M46320014MtStGreegoire.jpg', 'admin/Grosse/5546320014MtStGreegoire.jpg', , '');
INSERT INTO photo VALUES(39, 'admin/Mignature/76M49300004PontA25.jpg', 'admin/Grosse/2749300004PontA25.jpg', , '');
INSERT INTO photo VALUES(41, 'admin/Mignature/45M49970012PreevostEscarpements.jpg', 'admin/Grosse/3449970012PreevostEscarpements.jpg', , '');

-- -----------------------------
-- insertions dans la table photo2
-- -----------------------------
INSERT INTO photo2 VALUES(72, '47760004LaboThomas.jpg', 1, 'Bravo pour tous ces chercheurs de haut niveau qui sauvent des vies jour après jour, particulièrement au Dr. Thomas Duchaîne du McGill Cancer Center dont le laboratoire est rattaché à gauche de la tour ronde. ', ' ');
INSERT INTO photo2 VALUES(79, '52190025FleurVerte.jpg', 1, '  Afin de prévenir l\\\'érosion et les glissements de terrain, les cultivateurs ont épargné les rives des cours d\\\'eau. Les racines profondes des arbres stabilisent les sols en pente et forment une plante verte géante à Yamachiche  ', '  ');
INSERT INTO photo2 VALUES(27, '834235-05St-VallierManoir.jpg', 1, 'Le domaine de Lanaudière à St-Vallier (1725), autrefois propriété de la famille Duchaîne, est maintenant protégé par Conservation de la Nature Canada. Pour en savoir plus, demandez l\\\'accès FTP sans frais.       ', ' ');
INSERT INTO photo2 VALUES(78, '52130002St-JudeGlissement.jpg', 1, 'Comment le glissement de terrain de Saint - Jude s\\\'est-il produit? Cette tragédie aurait - elle pu être évitée?

Nos photos et vidéos aériennes répondent à ces questions.
Dossier complet disponible.     ', '');
INSERT INTO photo2 VALUES(77, '51330011AvionDessus.jpg', 1, 'Très peu de gens ont le courage de risquer leur vie pour mesurer leurs compétences et leurs habiletés. Suivons l\\\'envolée d\\\'un constructeur - pilote pour comprendre sa motivation. ( vidéo ) ', '');
INSERT INTO photo2 VALUES(76, '49700053ileauxgrues.jpg', 1, 'Rien de mieux qu\\\'un tour de vélo sur les battures de l\\\'île - aux - Grues, d\\\'une promenade dans la réserve naturelle Jean - Paul Riopelle, d\\\'un festin au Bateau Îvre et de belles rencontres avec les insulaires ...  ', '');
INSERT INTO photo2 VALUES(75, '49400007GrambyPiscine.jpg', 1, 'Se rafraîchir dans une immense piscine à vagues après toutes ces aventures exotiques près des lions, tigres, girafes ...     du Zoo à Granby     ', '');
INSERT INTO photo2 VALUES(73, '48690011Petroliere.jpg', 1, 'Vous faites une étude de marché? Nos photos mettront en valeur votre emplacement dans son contexte actuel et aideront à situer la concurrence. ', '  ');
INSERT INTO photo2 VALUES(59, '4066BX-017Charlesbourg-Bourg.jpg', 2, 'L\\\'intendant Jean Talon, premier urbaniste de la colonie, a reproduit le modèle concentrique de France pour le tracé des bourgs de Charlesbourg. En cas d\\\'attaque des indiens, tous se réfugiaient à la place centrale fortifiée.     ', '');
INSERT INTO photo2 VALUES(60, '5223X-12-853X853Jcopyp.jpg', 2, 'St-Jude 12 Mai 2010. Une butte de glaise instable, cisaillée entre un ruisseau et la rivière Sauriol glisse 20 mètres plus bas, emportant dans un immense cratère, chemin, résidences et quatre vies humaines.     ', '');
INSERT INTO photo2 VALUES(61, '520110023MCathedraleGrue.jpg', 2, 'La grue termine les travaux de réfection de la toiture de la cathédrale de Saint - Jérôme  ', '');
INSERT INTO photo2 VALUES(62, '3917R0001JetEau.jpg', 1, 'Forant le sol pour y installer des piquets de clôture, un employé perce une conduite d\\\'eau majeure à Montréal. Le geyser haut de quatre étages projetait des morceaux d\\\'asphalte sur les voitures à proximité ', '');
INSERT INTO photo2 VALUES(63, '3932R0014IncendieDomChartrand.jpg', 1, 'Une imprudence, une négligence et tout vos efforts s\\\'envolent en fumée.    ', '');
INSERT INTO photo2 VALUES(64, '4875B0011Montreal.jpg', 1, 'Vous désirez personnaliser un document? Nous disposons de 12 Téraoctets de photos d\\\'archives.Nos droits de reproduction sont plus qu\\\'abordables.', ' ');
INSERT INTO photo2 VALUES(65, '5002B0006Jesuites.jpg', 1, 'Signe des temps d\\\'une population vieillissante, le Séminaire des Jésuites, juché au sommet d\\\'une montagne au nord de St-Jérôme est maintenant devenu une résidence pour personnes agées.   ', '');
INSERT INTO photo2 VALUES(66, '40170002St-VallierHiver.jpg', 1, 'La pointe de St-Vallier immobile, contre vents et marées, reprendra vie au printemps.', ' ');
INSERT INTO photo2 VALUES(67, '40600015BaleineContrecoeur.jpg', 1, 'Éperonnée de plein fouet par un porte - container, cette pauvre bête fut remorquée à Contrecoeur pour être enfouie à Trois - Rivières. Dans quelques années, nous pourrons admirer son squelette au musée.   ', '');
INSERT INTO photo2 VALUES(68, '46280024MontRoyal.jpg', 1, 'À Montréal, nous remercions nos ancêtres en leur confiant notre plus beau parc.  ', '');
INSERT INTO photo2 VALUES(88, '4628-61Mont Royal.jpg', 1, 'Utilisée au colloque des Montérégiennes à l\\\'Université de Montréal, cette vue du Mont - Royal sera embassadrice de Montréal en Belgique, France, Allemagne, Espagne, Italie et Hollande pour AIR TRANSAT en 2011.    ', '     ');
INSERT INTO photo2 VALUES(70, '46320014MtSt-Gregoire.jpg', 1, 'Le Mont St-Grégoire est sans contredit l\\\'une des plus belles des 10 Montérégiennes. Les sentiers de randonnées y sont irrésistibles, au temps des pommes comme au temps des sucres.  ', '  ');
INSERT INTO photo2 VALUES(71, '47830019PontJacques-Cartier.jpg', 1, 'Suivi de travaux majeurs sur le pont Jacques Cartier ou l\\\'on s\\\'affaire à remplacer les sections du tablier.      ', '');
INSERT INTO photo2 VALUES(100, '5322X-MIRABEL-800X459j.jpg', 2, 'AÉROPORT DE MIRABEL Mosaïque de 40 orthophotos de 100 MPixels. L\\\'original est géoréférencé ( .TFW) à 30 cm / Pixel.     ', '');
INSERT INTO photo2 VALUES(102, '5223-05-St-Judes-723-485J.jpg', 1, 'ST-JUDE   Reconnaissez - vous les traces des glissements antérieurs à la catastrophe? Serait - il possible que le prochain ait - lieu entre D et E ? ', '');
INSERT INTO photo2 VALUES(103, '3177X-LASALLE-800X548J.jpg', 2, 'VILLE DE LASALLE  Mosaïque de 15 photos de 100 MPixels.
Quest - il arrivé au pont Mercier? ', '');
INSERT INTO photo2 VALUES(104, '5515-15Toupie-Tadoussac1024JL.jpg', 1, ' Le phare, que les gens de Tadoussac appellent La Toupie, brise, immobile un banc de brume matinal.', '');
INSERT INTO photo2 VALUES(95, '5385-03LSt-PlacideFestiVent.jpg', 1, 'Que le bon vent vous amème! 
Saint - Placide nous invite à la plus grande fête de cerfs-volants sur glace. ', '');
INSERT INTO photo2 VALUES(96, '53240009Poly.jpg', 1, 'L\\\'École Polytechnique de Montréal arrive bonne première au Québec quant au nombre d\\\'étudiants et à l\\\'ampleur de ses activités de recherche en génie. Que de belles réalisations depuis sa création en 1873! ', '');
INSERT INTO photo2 VALUES(97, '53260002UdeM.jpg', 1, ' ', '');
INSERT INTO photo2 VALUES(98, '53270006HEC.jpg', 1, 'Saluons l\\\'élite de nos administrateurs, solidement formés aux HEC de Montréal, première école de gestion au Canada. Hommage particulier à Martin Duchaîne, fondateur de ANGES QUÉBEC et de CAPITAL INNOVATION.   ', '');
INSERT INTO photo2 VALUES(99, '5399-14Gentilly.jpg', 1, 'Quel sera le sort de la centrale nucléaire de Gentilly? ', '');
INSERT INTO photo2 VALUES(87, '5292-08SamuelCub.jpg', 1, '  Bravo pour l\\\'exploit aérien du jeune passionné Samuel Daigle qui a volé 60 heures de White Horse à Beloeil.', '  http://www.radio-canada.ca/audio-video/pop.shtml#idMedia=undefined&lang=fr&pl=0of1&posMedia=0&startPosition=0&urlMedia=http://www.radio-canada.ca/Medianet/2010/CBFT/TelejournalMontreal201008201800_6.asx
');
INSERT INTO photo2 VALUES(91, 'prevost90LJ.jpg', 2, 'VILLE DE PRÉVOST    Mosaïque de 28orthophotos de 100 MPixels. On peut agrandir sa version originale pour y voir de menus détails jusqu\\\'à 35 Cm/pixel        ', '');
INSERT INTO photo2 VALUES(90, 'LASALLEORTHOGONAL853.jpg', 2, 'Retrouvons l\\\'hôtel de ville de Lasalle (1), le pont Mercier (2) sur la photo oblique de la page d\\\'accueil.   ', '');
INSERT INTO photo2 VALUES(101, '5336X-MONTREAL-800X486J.jpg', 2, 'AÉROPORT DE MONTRÉAL    Mosaïque de 40 orthophotos de 100 MPixels. L\\\'original est géoréférencé (.TFW ) à 30 cm/pixel       ', '');
INSERT INTO photo2 VALUES(92, '4998X12lacedesArts.jpg', 2, 'Vous reconnaissez? Cet immeuble apparaît en oblique dans notre vidéo corporatif. C\\\'est notre Place des Arts bien sûr!   ', '    ');

-- -----------------------------
-- insertions dans la table videos
-- -----------------------------
INSERT INTO videos VALUES(1, 7, 'SERRES HORTICOLES À PIERREFONDS  Situées entre le Parc-nature du Cap-St-Jacques et le Parc-nature du bois de l\\\'Anse-à-l\\\'Orme, sur une des rares terres encore cultivées de l\\\'île de Montréal. Ces serres ont produit de magnifiques fleurs, soulignant la vie, l\\\'amour, la mort des montréalais depuis plusieurs générations.           ', 'http://www.youtube.com/v/Gn37ma8y80I?fs=1&hl=fr_FR&rel=0&color1=0x234900&color2=0x4e9e00        ', 'Serres2-horticoles950.jpg');
INSERT INTO videos VALUES(2, 9, 'Bref survol du chantier maritime DAVIE SHIP BUILDING ou l\\\'on a dû interrompre la construction des navires 717,718 et 719, le temps que la firme européenne retourne à ses planches à dessin...      ', 'http://www.youtube.com/v/PBkfc32w4NM?fs=1&hl=fr_FR&rel=0&color1=0x234900&color2=0x4e9e00       ', 'Davie_ship_building950.jpg');
INSERT INTO videos VALUES(7, 3, 'Accompagnons Luc Thibault aux commandes du Hummelbird qu\\\'il a construit lui - même, et survolons les grands travaux de l\\\'autoroute 50 qui reliera les villes de LaChute et Gatineau. (7/8/2009 )        ', 'http://www.youtube.com/v/inPDxZU3oL4?fs=1&hl=en_US&color1=0x234900&color2=0x4e9e00     ', 'Hummelbird-950.jpg');
INSERT INTO videos VALUES(16, 10, 'Tour de la centrale nucléaire Gentilly. Observez les réacteurs 1 et 2, l\\\'entrée et la sortie d\\\'eau de refroidissement, les quatre turbines à gaz qui, qui garantiraient la sécurité en cas de panne électrique.           ', 'http://www.youtube.com/embed/OYJjnsfmoz4\" frameborder=\"0\" allowfullscreen         ', '53990013Gentilly.jpg');
INSERT INTO videos VALUES(15, 8, 'Jean-Pierre Ciambella, président-fondateur d\\\'AÉROGRAM nous montre les avantages du média aérien.                          ', 'http://www.youtube.com/embed/uNfIU9VrD0o\" frameborder=\"0\" allowfullscreen                     ', '5390-01AEROGRAM-MEDIA.jpg');

-- -----------------------------
-- insertions dans la table videos_3d
-- -----------------------------
INSERT INTO videos_3d VALUES(1, 0, 'Ce Modèle 3D Interactif de la structure spectaculaire du groupe U2 en visite à Montréal utilise 66 photos de 12 MPixels.     ', ' http://photosynth.net/view.aspx?cid=4d41d4bb-af71-46dd-9276-6ec39035a04c&m=false&i=0:0:58&c=-0.194424:1.21115:-0.00429893&z=553.368507346536&d=0.662358157601067:-2.8925101337637:-1.56403469997805&p=0:0&t=False    ', 'photo3D-ClawdeU2-2011.jpg');
INSERT INTO videos_3d VALUES(6, 1, 'Examinez de près le Modèle 3D Interactif du Stade Olympique de Montréal, réalisé avec 65 photos obliques de 12 MPixels.     ', ' http://photosynth.net/view.aspx?cid=be21c93a-28e8-4345-b3cc-75c8025f8f77      ', 'photo3D-Stade-olympique.jpg');
INSERT INTO videos_3d VALUES(7, 3, 'Place Ville - Marie avec ses 44 étages, était  le plus haut édifice du Canada en 1962. ( M3DI 65 photos 12 MPixels )       ', ' http://photosynth.net/view.aspx?cid=d9bc37ee-ff8e-45a2-b561-fba74f5c24c7       ', 'Place-ville-Marie3D.jpg');
INSERT INTO videos_3d VALUES(8, 2, 'Choisissez l\\\'emplacement de votre nouvelle résidence avec ce Modèle 3D Interactif du développement LES CLOS PRÉVOSTOIS. ( M3DI réalisé à partir de 80 photos obliques de 12 MPixels       ', ' http://photosynth.net/view.aspx?cid=96882d9c-080b-4722-afe2-1317166c568b&m=false&i=0:0:1&c=-1.61974:0.876483:-0.0543102&z=1037.7386752908&d=1.54382281739634:-2.71692627082893:-2.07387637934105&p=0:0&t=False         ', 'photo3D-Clos-Prevostois.jpg');
INSERT INTO videos_3d VALUES(9, 2, 'Examinez en détail le CENTRE UNIVERSITAIRE DE SANTÉ MCGILL avec ce Modèle 3D Interactif du plus grand chantier de Montréal. ( M3DI 103 photos 12 MPixels )     ', ' http://photosynth.net/view.aspx?cid=b512ff7b-c1d0-49bf-bbbd-628f1232334a&m=false&i=0:0:12&c=-0.890113:1.42427:-0.174064&z=964.202554160008&d=0.726057195447869:-2.76680894208453:-1.89098253009452&p=0:0&t=False       ', '5502-57CUSM.jpg');


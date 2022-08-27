-- MySQL dump 10.13  Distrib 5.7.38, for Win64 (x86_64)
--
-- Host: localhost    Database: muo-db
-- ------------------------------------------------------
-- Server version	5.7.38-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `categoriaeng`
--

LOCK TABLES `categoriaeng` WRITE;
/*!40000 ALTER TABLE `categoriaeng` DISABLE KEYS */;
INSERT INTO `categoriaeng` VALUES (1,'Art',1),(2,'History',2),(3,'Sculpture',3);
/*!40000 ALTER TABLE `categoriaeng` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Arte'),(2,'Historia'),(3,'Escultura');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `comentarios`
--

LOCK TABLES `comentarios` WRITE;
/*!40000 ALTER TABLE `comentarios` DISABLE KEYS */;
INSERT INTO `comentarios` VALUES (1,'Interesante...',2,1),(2,'test\\r\\n\\r\\n\\r\\n',2,1),(3,'asdadw daw d a',2,1),(4,'awda awd awd wa dwa wad wa da d',2,1),(5,'Muy Interesante mural.',1,1);
/*!40000 ALTER TABLE `comentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `exposeng`
--

LOCK TABLES `exposeng` WRITE;
/*!40000 ALTER TABLE `exposeng` DISABLE KEYS */;
INSERT INTO `exposeng` VALUES (1,'The mural, a stone mosaic, represents freedom and is symbolized by a naked man looking up with his arms raised. This figure is known as El ChulÃ³n and is an urban landmark. The stones that make up the mosaic are of natural colors and were collected nationally. ','Revolution Monument',1),(2,'The volcaneÃ±a is inspired by the strong and feisty women who come down from the volcano to sell flowers to the city.','Sculpture by the artist (Titi Escalante).',2),(3,'The Little Prince (French: Le Petit Prince) is a short novel and the most famous work by French writer and aviator Antoine de Saint-ExupÃ©ry (1900-1944).\r\n\r\nThe work was published in April 1943 in both English and French by the American publisher Reynal & Hitchcock, while the French publisher Ã‰ditions Gallimard was unable to print the work until 1946, after the liberation of France. Included among the best books of the 20th century in France, The Little Prince has become the most widely read and most translated book in French. ','Bronze sculpture of the Little Prince',3),(4,'Man of Science and Letters to whom we owe multiple works that mark a mark in the national culture, especially in the Foundation (October 9, 1883) of this Museum that bears his name. In the immortal words of the \"Oracion a la bandera\" is engraved his patriotism.','Bust of Dr. David J. Guzman',4),(8,'Unpublished photographs of Monsignor Oscar Arnulfo Romero, objects and quotes taken from his thought make up the exhibition \"Romero, voice and look\" produced by the Museo de la Palabra y la Imagen, which can be visited at the Temporary Hall of the Museo Nacional de AntropologÃ­a, MUNA. The exhibition will be inaugurated at 6:00 p.m. on March 24 and will remain on display until May 29.','Romero, Voice and Look',8),(9,'It is an exhibition composed of shipwrecks and information on underwater exploration in the country, was inaugurated in the Temporary Hall of the National Museum of Anthropology, thanks to the joint work of the Ministry of Culture of the Presidency (SECULTURA) and the Calvo Group.<br/><br/>The exhibition seeks to raise awareness about the existence, destruction, looting and commercial exploitation, as well as the work that Calvo develops for culture in the country.<br/><br/>Another aspect that stands out in the exhibition are the reports on underwater archaeology projects that are also on display, because as expressed by the director of the underwater archaeological project of SECULTURA, Roberto Gallardo, \"Underwater cultural heritage should not be extracted from its context without the presence of professional archaeologists and divers. Otherwise we lose our history\".','Underwater Archaeology Exhibition',9),(10,'The Dance is seen at the same time that it is felt, our brain makes the analogy of what we see with what we would feel if what we see, we would also do it. The mental operation is instantaneous, achieved thanks to the artist polishing her technical mastery until she achieves, without forcing the composition, without making this or that point of tension grossly apparent, that one of the figures does not really touch the floor. There is no traction or rigidity. There is grace, that grace of air that invokes the whole group of dancers.','The Dance, 1993 (Homage to Matisse series)',10),(11,'One of Llort\\\'s two significant ways of expression is present in this painting, which comes from his imaginary and fantastic world. In the other, the artist manifests himself with great realism, tending to capture the detail present in the local flora, as can be seen in his series Himno a natura. In Instante volÃ¡til, a painting that has been identified within the Surrealism of his production, Llort presents a scene that, because of its elements, is related to the beach and marine world: the woman with an old bathing suit, the shells, the sun umbrella. However, all of them float weightless in a space without any reference to water and the female figure appears with arms that end in wings with which she seems to be suspended in that unreal atmosphere with enigmatic sparkles.','Volatile Instant',11),(12,'This work is titled \\\"The Mad White Nun\\\" and the book \\\"El Salvador, PanorÃ¡mica de la Pintura Siglo XX\\\" says that it was exhibited in 1947 in New York, but the book sponsored by the Banco AgrÃ­cola does not mention the criticism it received. The figure looks like an extraterrestrial of the kind seen in movies and TV of our days, with deformed hands, slanted and enigmatic look, fleshy and delineated lips. The dark, somber background blends in with the nun\\\'s clothing. Connoisseurs also classify this work as surrealist.','The Mad White Nun',12),(13,'Legend has it that he eats ashes, wears a long hat and lives in the ravines.<br/><br/>The work is made by a famous Salvadoran artist and writer Salvador Salazar ArruÃ© (SALARRUÃ‰) and is inspired by one of our most famous legends (El CipitÃ­o).','The cipitÃ­o',13);
/*!40000 ALTER TABLE `exposeng` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `exposiciones`
--

LOCK TABLES `exposiciones` WRITE;
/*!40000 ALTER TABLE `exposiciones` DISABLE KEYS */;
INSERT INTO `exposiciones` VALUES (1,'Monumento a la RevoluciÃ³n','El mural, un mosaico en piedra, representa la libertad y es simbolizada por un hombre desnudo mirando hacia arriba y con los brazos levantados. Esta figura es conocida como El ChulÃ³n y constituye un punto de referencia urbana. Las piedras que forman el mosaico son de colores naturales y fueron recolectadas a nivel nacional.',2,1),(2,'Escultura de la artista plÃ¡stica (Titi Escalante).','La volcaneÃ±a estÃ¡ inspirada en las mujeres fuertes y luchadoras que bajan del volcÃ¡n a vender flores a la ciudad.',2,3),(3,'Escultura en bronce del Principito','El principito (en francÃ©s: Le Petit Prince) es una novela corta y la obra mÃ¡s famosa del escritor y aviador francÃ©s Antoine de Saint-ExupÃ©ry (1900â€“1944).\r\n\r\nLa obra fue publicada en abril de 1943, tanto en inglÃ©s como en francÃ©s, por la editorial estadounidense Reynal & Hitchcock, mientras que la editorial francesa Ã‰ditions Gallimard no pudo imprimir la obra hasta 1946, tras la liberaciÃ³n de Francia. Incluido entre los mejores libros del siglo XX en Francia, El principito se ha convertido en el libro en francÃ©s mÃ¡s leÃ­do y mÃ¡s traducido. ',1,3),(4,'Busto del Dr. David J. Guzman','Hombre de Ciencia y de Letras, a quien se deben mÃºltiples obras que marcan huella en la cultura nacional, especialmente en la FundaciÃ³n (9 de octubre de 1883) de Este Museo que lleva su nombre. En las palabras inmortales de la \"Oracion a la bandera\" queda grabado su patriotismo. ',1,3),(8,'Romero, Voz y Mirada','FotografÃ­as inÃ©ditas de MonseÃ±or Oscar Arnulfo Romero, objetos y citas extraÃ­das de su pensamiento conforman la exposiciÃ³n \"Romero, voz y mirada\" producida por el Museo de la Palabra y la Imagen, y que podrÃ¡ visitarse en la Sala Temporal del Museo Nacional de AntropologÃ­a, MUNA. La muestra serÃ¡ inaugurada a las seis de la tarde del 24 de marzo y permanecerÃ¡ hasta el 29 de mayo.',1,2),(9,'ExposiciÃ³n de ArqueologÃ­a SubacuÃ¡tica','Es una muestra compuesta por restos de navÃ­os naufragados y con informaciÃ³n sobre la exploraciÃ³n subacuÃ¡tica en el paÃ­s, fue inaugurada en la Sala Temporal del Museo Nacional de AntropologÃ­a, gracias al trabajo conjunto de la SecretarÃ­a de Cultura de la Presidencia (SECULTURA) y el Grupo Calvo.<br/><br/>La exhibiciÃ³n busca crear conciencia sobre la existencia, destrucciÃ³n, saqueo y explotaciÃ³n comercial, asÃ­ como la labor que Calvo desarrolla por la cultura en el paÃ­s.<br/><br/>Otro aspecto que resalta en la muestra son los informes sobre proyectos de arqueologÃ­a subacuÃ¡tica que tambiÃ©n se exhiben, pues tal y como lo expresÃ³ el director del proyecto arqueolÃ³gico subacuÃ¡tico de SECULTURA, Roberto Gallardo, â€œEl patrimonio cultural SubacuÃ¡tico no debe ser extraÃ­do de su contexto sin la presencia de arqueÃ³logos y buzos profesionales. De lo contrario perdemos nuestra historia\"',1,2),(10,'La Danza, 1993 (serie Homenaje a Matisse)','La Danza se ve al mismo tiempo que se siente, nuestro cerebro hace la analogÃ­a de lo que vemos con lo que sentirÃ­amos si eso que vemos, tambiÃ©n lo hiciÃ©ramos. La operaciÃ³n mental es instantÃ¡nea, lograda gracias a que la artista pule su maestrÃ­a tÃ©cnica hasta lograr, sin forzar la composiciÃ³n, sin volver groseramente aparente tal o cual punto de tensiÃ³n, que una de las figuras realmente no toque el suelo. No hay tracciÃ³n o rigidez. Hay gracia, esa gracia de aire que invoca al conjunto todo de bailarinas.',2,1),(11,'Instante VolÃ¡til','Una de las dos significativas maneras de expresiÃ³n de Llort estÃ¡ presente en esta pintura, la cual proviene de su mundo imaginario y fantÃ¡stico. En la otra el artista se manifiesta con un gran realismo, tendiente a la captaciÃ³n del detalle presente en la flora local, como se puede observar en su serie Himno a natura. En Instante volÃ¡til, pintura que se ha identificado dentro del Surrealismo de su producciÃ³n, Llort presenta una escena que, por sus elementos, se relaciona con el mundo playero y marino: la mujer con un antiguo traje de baÃ±o, las conchas, la sombrilla para el sol. Sin embargo, todos ellos flotan ingrÃ¡vidos en un espacio sin ningÃºn referente al agua y la figura femenina aparece con brazos que terminan en alas con las que parece suspenderse en esa atmÃ³sfera irreal con destellos enigmÃ¡ticos.',2,1),(12,'La Monja Blanca','Esta obra se titula \\\"La Monja Blanca\\\" y el libro \\\"El Salvador, PanorÃ¡mica de la Pintura Siglo XX\\\" dice que fue expuesta en 1947, en Nueva York, pero el libro patrocinado por el Banco AgrÃ­cola no cuenta de la crÃ­tica que recibiÃ³. La figura parece un extraterrestre de los que se ven en pelÃ­culas y Tv de nuestros dÃ­as, con manos deformes, mirada achinada y enigmÃ¡tica, labios carnosos y delineados. El fondo oscuro, sombrÃ­o, se funde con la vestimenta de la monja. Los conocedores tambiÃ©n clasifican esta obra como surrealista.',2,2),(13,'El cipitÃ­o','Pues cuenta la leyenda que come ceniza, lleva un sombrero largo y vive en las quebradas.<br/><br/>La obra estÃ¡ realizada por un artista y escritor cÃ©lebre salvadoreÃ±o Salvador Salazar ArruÃ© (SALARRUÃ‰) y se inspira en una de nuestras leyendas mÃ¡s conocidas (El CipitÃ­o)',2,1);
/*!40000 ALTER TABLE `exposiciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `favoritosusuarios`
--

LOCK TABLES `favoritosusuarios` WRITE;
/*!40000 ALTER TABLE `favoritosusuarios` DISABLE KEYS */;
INSERT INTO `favoritosusuarios` VALUES (59,1,1),(62,1,2),(63,1,3),(64,1,4),(65,1,8);
/*!40000 ALTER TABLE `favoritosusuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `imagenesexpo`
--

LOCK TABLES `imagenesexpo` WRITE;
/*!40000 ALTER TABLE `imagenesexpo` DISABLE KEYS */;
INSERT INTO `imagenesexpo` VALUES (1,'/expoImg/6d16f87093428fa44fb5aad5a196e6fe.jpg',1),(2,'/expoImg/2230240451ef6377022bd32e542185a8.jpg',1),(3,'/expoImg/37233d9564fbef376b61cbc3c038de2f.jpg',1),(4,'/expoImg/206b3788b605025bb64298d82c1e31c6.jpg',2),(5,'/expoImg/71fc0f08f63bd079b0ad004ef2e0772b.jpg',2),(6,'/expoImg/40f07eb53d0f19f05fb37c5ac0ffda57.jpg',2),(7,'/expoImg/810c4adceaa4d289a1b1bafe0bd53c15.jpg',2),(8,'/expoImg/514086cbf1d147154dd0d75b21b1a525.jpg',3),(9,'/expoImg/18a97b73a29b5e34f86971b209d4bcaa.jpg',4),(10,'/expoImg/c08a46d9b23905647d629929e970ae52.jpg',4),(11,'/expoImg/619146861bbe0ec0b0d56e4501de8534.jpg',4),(12,'/expoImg/5768919d1f31530882dc1c3309da4091.jpg',4),(16,'/expoImg/7222beb1621e821a6bb1de458daf8809.jpg',8),(17,'/expoImg/2381cb201c019af6ad7cebb50b897f21.jpg',8),(18,'/expoImg/b776ba2cb862da5d0297883a504d4869.jpg',8),(19,'/expoImg/d4cdbec744ae56844ce7df16a88885f1.jpg',8),(20,'/expoImg/3dcd0dd47f5c4b37b0143785809a0693.jpg',8),(21,'/expoImg/97e22116509e87af7f09e146315ae19b.jpg',8),(22,'/expoImg/897323365829334bfce9fd84c6703da9.jpg',8),(23,'/expoImg/78dead1bb93dbf0cc0217bc478dfe792.jpg',8),(24,'/expoImg/bf87e4faf8c674089f9bd2d7e38c126b.jpg',9),(25,'/expoImg/ebbe6ad7cbc11891815a299cd953751b.jpg',9),(26,'/expoImg/6bf8f80a7438eabd50a85eb95f8f8435.jpg',9),(27,'/expoImg/b9baafe812dd2e869b6d5ac1712f1c1a.jpg',9),(28,'/expoImg/21558f15f634f5e990934aa5d1d13c21.jpg',9),(29,'/expoImg/32b4058edf643a9f5b2156627e555b54.jpg',9),(30,'/expoImg/d46f1004fe9884d4f477f035df05f671.jpg',9),(31,'/expoImg/5a78a7fa1f5c2169913fd5b97ab43f1b.jpg',10),(32,'/expoImg/a7a6c3ac7c71d7b560459d7587fbfbf0.jpg',10),(33,'/expoImg/d783b50651a0c6b0f3c6f82c294cfebb.jpg',10),(34,'/expoImg/43873a299a3e306dc005097eb5feb306.jpg',10),(35,'/expoImg/87750c7244e82e7183b620113a411b8d.jpg',10),(36,'/expoImg/807b47f2282df9c0ede999fe36dec056.jpg',10),(37,'/expoImg/eb1b0b372c7b1df8911425a3d795c98c.jpg',11),(38,'/expoImg/2d41395f4b2a0ef35387217117effafb.jpg',12),(39,'/expoImg/b2ae120f022be8a455a8513c7e413e1f.jpg',13);
/*!40000 ALTER TABLE `imagenesexpo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `museos`
--

LOCK TABLES `museos` WRITE;
/*!40000 ALTER TABLE `museos` DISABLE KEYS */;
INSERT INTO `museos` VALUES (1,'MUNA','El Museo Nacional de AntropologÃ­a tiene una larga tradiciÃ³n expositiva, conforme al carÃ¡cter patrimonial de sus colecciones; fue creado por Decreto Ejecutivo el 1 de febrero de 1883 y fundado el 9 de octubre del mismo aÃ±o. En un primer momento desarrollÃ³ una colecciÃ³n de diversidad biolÃ³gica y geolÃ³gica del paÃ­s, asÃ­ como productos manufacturados, bellas artes e historia. En 1945, fue designado con el nombre de David J. GuzmÃ¡n.','/museosImg/a9bc0dcf69dcd4d657578f68cfd63ac7.jpg'),(2,'MARTE','El Museo de Arte de El Salvador (MARTE) fue inaugurado el 22 de mayo de 2003. Es una instituciÃ³n privada, sin fines de lucro, cuyo funcionamiento es responsabilidad de la AsociaciÃ³n Museo de Arte de El Salvador, la cual se creÃ³ con ese propÃ³sito y cuya personerÃ­a jurÃ­dica se obtuvo mediante Acuerdo Ejecutivo No. 338 publicado en el Diario Oficial 89 Tomo 347 del 6 de mayo del aÃ±o 2000. ','/museosImg/45df10d059d0b543ab111a2bce0571e7.jpg'),(3,'Museo FORMA de El Salvador','Fundado en 1983, tras la iniciativa de la prestigiosa pintora Julia DÃ­az primera dama en la profesiÃ³n, el proyecto FORMA se planteo como el misionero para resguardar con celo y altruismo las creaciones salvadoreÃ±as con el fin de legarlas a las futuras generaciones. Por otra parte su fundadora tenÃ­a como precepto dedicar salas o galerÃ­as (no importa su tÃ©rmino o funciÃ³n arquitectÃ³nica) para la incorporaciÃ³n de exposiciones temporales de nuevos talentos.','/museosImg/850fb91143956640bc1896f2d719664e.jpg'),(4,'MUTE','El Museo TecleÃ±o, tambiÃ©n conocido como MUTE, es un sitio que atesora una particularidad histÃ³ricamente invaluable: Fue una penitenciarÃ­a construida en 1902 por el arquitecto JosÃ© JerÃ©z, quien diseÃ±Ã³ las mÃ¡s destacables infraestructuras del municipio de Santa Tecla. Durante la guerra civil salvadoreÃ±a, funcionÃ³ como cuartel del ejÃ©rcito y como centro de detenciÃ³n de presos polÃ­ticos, quienes sufrieron torturas o ejecuciones. ','/museosImg/70a92309610c906edc6301b93bfd4bf4.jpg'),(5,'MUA','El Museo Universitario de AntropologÃ­a de la Universidad TecnolÃ³gica de El Salvador, cumpliendo con el propÃ³sito de difusiÃ³n del patrimonio cultural que resguarda este recinto cultural universitario, pone a disposiciÃ³n para conocimiento pÃºblico, la semblanza sobre el inmueble y la colecciÃ³n que resguarda y exhibe actualmente dentro de sus instalaciones.','/museosImg/65c3654063a221d64e4eaab6032e1c1c.jpg');
/*!40000 ALTER TABLE `museos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `museoseng`
--

LOCK TABLES `museoseng` WRITE;
/*!40000 ALTER TABLE `museoseng` DISABLE KEYS */;
INSERT INTO `museoseng` VALUES (1,'The National Museum of Anthropology has a long exhibition tradition, in accordance with the patrimonial character of its collections; it was created by Executive Decree on February 1, 1883 and founded on October 9 of the same year. At first it developed a collection of biological and geological diversity of the country, as well as manufactured products, fine arts and history. In 1945, it was designated with the name of David J. GuzmÃ¡n.',1),(2,'The Museo de Arte de El Salvador (MARTE) was inaugurated on May 22, 2003. It is a private, non-profit institution, whose operation is the responsibility of the AsociaciÃ³n Museo de Arte de El Salvador, which was created for that purpose and whose legal status was obtained through Executive Agreement No. 338 published in the Official Gazette 89 Volume 347 of May 6, 2000. ',2),(3,'Founded in 1983, after the initiative of the prestigious painter Julia Diaz first lady in the profession, the FORMA project was raised as the missionary to safeguard with zeal and altruism the Salvadoran creations in order to bequeath them to future generations. On the other hand, its founder had as a precept to dedicate rooms or galleries (no matter its term or architectural function) for the incorporation of temporary exhibitions of new talents.',3),(4,'The Museo TecleÃ±o, also known as MUTE, is a site that treasures a historically invaluable particularity: It was a penitentiary built in 1902 by the architect JosÃ© JerÃ©z, who designed the most outstanding infrastructures of the municipality of Santa Tecla. During the Salvadoran civil war, it functioned as an army barracks and as a detention center for political prisoners, who were tortured or executed.',4),(5,'The University Museum of Anthropology of the Technological University of El Salvador, in compliance with the purpose of disseminating the cultural heritage that protects this university cultural precinct, makes available for public knowledge, the semblance of the building and the collection that currently protects and exhibits within its facilities.',5);
/*!40000 ALTER TABLE `museoseng` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `passwordcode`
--

LOCK TABLES `passwordcode` WRITE;
/*!40000 ALTER TABLE `passwordcode` DISABLE KEYS */;
/*!40000 ALTER TABLE `passwordcode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'gerardo.saz120@gmail.com','$2y$10$siTJJ.45/yxOUUPnPooiB.ek6S.28S6B1JhNoOGKuoDQO4DytID8m','Gerardo','Saz','50a9197119df081852e7df68a4fbece6','2022-08-25 14:38:42','171c73fb2270e081',0,1),(2,'admin@muo.com','$2y$10$ypBRjB75i4OMOQ1Xb5TP2e.A0s8j2akZjLBX6LcvUTn/lqwjW/gXm','Admin','MUO','2eb47789455e9c060117875d336e2309','2022-08-25 14:38:42','b08bd6de650c7d4b',1,1),(3,'pgap22@muo.com','$2y$10$RHo9EtZWthzv6EQ0uQAgfeZD7riwH/o3grXYaH4J6BndLVeior97G','JUan','Juan','b9773d2079593f0a596f9ffdf07811d1','2022-08-25 14:38:42','20fee78a01d4fc62',1,1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-27 17:49:48

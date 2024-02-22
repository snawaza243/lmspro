

DROP TABLE IF EXISTS `admin_table`;
CREATE TABLE `admin_table` (
  `id` int NOT NULL AUTO_INCREMENT,
  `admin_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_id` (`admin_id`)
)

LOCK TABLES `admin_table` WRITE;
INSERT INTO `admin_table` VALUES (1,'101','Sam','admin@gmail.com','Male','0192023a7bbd73250516f069df18b500');

UNLOCK TABLES;

DROP TABLE IF EXISTS `book_categories`;
CREATE TABLE `book_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  `category_code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_name` (`category_name`)
) 

LOCK TABLES `book_categories` WRITE;
INSERT INTO `book_categories` VALUES (1,'Fiction','FIC'),(2,'Non-Fiction','NON'),(3,'Mystery','MYS'),(4,'Science Fiction','SCI'),(5,'Fantasy','FAN'),(6,'Romance','ROM'),(7,'Horror','HOR'),(8,'Biography','BIO'),(9,'History','HIS'),(10,'Self-Help','SEL'),(11,'Thriller','THR'),(12,'Adventure','ADV'),(13,'Dystopian','DYS'),(14,'Children','CHI'),(15,'Young Adult','YAU'),(16,'Poetry','POE'),(17,'Classic','CLA'),(18,'Cooking','COO'),(19,'Travel','TRA'),(20,'Religion','REL'),(21,'Art','ART'),(22,'Music','MUS'),(23,'Drama','DRA'),(24,'Humor','HUM'),(25,'Graphic Novel','GRA'),(26,'Science','SCE'),(27,'Technology','TEC'),(28,'Psychology','PSY'),(29,'Business','BUS'),(30,'Environmental','ENV'),(31,'Urban Fantasy','URB'),(32,'Paranormal','PAR'),(33,'Supernatural','SUP'),(34,'Steampunk','STE'),(35,'Cyberpunk','CYB'),(36,'Space Opera','SPA'),(37,'Apocalyptic','APO'),(38,'Post-Apocalyptic','POS'),(39,'Time Travel','TIM'),(40,'Alternate History','ALT'),(41,'Magical Realism','MAG'),(42,'Surrealism','SUR'),(43,'Crime','CRI'),(44,'Legal Thriller','LEG'),(45,'Medical Thriller','MED'),(46,'Political Thriller','POL'),(47,'Spy Thriller','SPY'),(48,'Military History','MIL'),(49,'True Crime','TRU'),(50,'Philosophy','PHI'),(51,'Metaphysics','MET'),(52,'Ethics','ETH'),(53,'Folklore','FOL'),(54,'Mythology','MYT'),(55,'Occult','OCC'),(56,'Conspiracy','CON'),(57,'Espionage','ESP'),(58,'Survival','SUR'),(59,'Zen Buddhism','ZEN'),(60,'Gastronomy','GAS'),(61,'Cryptocurrency','CRY'),(62,'Astrophysics','AST'),(63,'Quantum Mechanics','QUA'),(64,'Ancient Civilizations','ANC'),(65,'Postmodernism','POS'),(66,'Culinary Memoir','CUL'),(67,'Experimental Literature','EXP'),(68,'Urban Planning','URP'),(69,'Existentialism','EXI'),(70,'Cognitive Science','COG'),(71,'Afrofuturism','AFR'),(72,'Ecofeminism','ECO'),(73,'Dadaism','DAD'),(74,'Sustainability','SUS'),(75,'Minimalism','MIN'),(76,'Futurism','FUT'),(77,'Deep Learning','DEE'),(78,'Space Exploration','SPE'),(79,'Cultural Anthropology','ANT'),(80,'Legal Philosophy','LEG'),(81,'Environmental Ethics','ENV'),(82,'Disability Studies','DIS'),(83,'Astrobiology','AST'),(84,'Historical Fiction','HIF'),(85,'Political Philosophy','POL'),(86,'Molecular Biology','MOL'),(87,'Cognitive Psychology','COG');

UNLOCK TABLES;


DROP TABLE IF EXISTS `books_table`;
CREATE TABLE `books_table` (
  `id` int NOT NULL AUTO_INCREMENT,
  `book_name` varchar(255) NOT NULL,
  `book_author` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `available_books` int NOT NULL,
  `book_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `book_code` (`book_code`)
) 

LOCK TABLES `books_table` WRITE;
/*!40000 ALTER TABLE `books_table` DISABLE KEYS */;
INSERT INTO `books_table` VALUES (1,'The Power of Now and now','Eckhart Tolle','Motivation',9,'MOT001'),(3,'udate name again','udate author','udate category',2,'udate code'),(4,'The 7 Habits of Highly Effective People','Stephen R. Covey','Motivation',12,'MOT004'),(5,'Think and Grow Rich','Napoleon Hill','Motivation',18,'MOT005'),(6,'The five Agreements','Don Miguel Ruiz','Spirituality',18,'SPI001'),(10,'Long Walk to Freedom','Nelson Mandela','Autobiography',8,'AUT002'),(11,'The Diary of a Young Girl','Anne Frank','Autobiography',12,'AUT003'),(12,'Steve Jobs','Walter Isaacson','Autobiography',18,'AUT004'),(14,'Persepolis','Marjane Satrapi','Comic',30,'COM002'),(15,'Watchmen','Alan Moore','Comic',10,'COM003'),(16,'Fun Home','Alison Bechdel','Comic',15,'COM004'),(17,'Blankets','Craig Thompson','Comic',8,'COM005'),(18,'The Power of Habit','Charles Duhigg','Motivation',12,'MOT006'),(19,'Sapiens','Yuval Noah Harari','History',20,'HIS001'),(20,'The Immortal Life of Henrietta Lacks','Rebecca Skloot','Science',18,'SCI001'),(21,'Educated','Tara Westover','Biography',14,'BIO001'),(22,'Becoming','Michelle Obama','Autobiography',10,'BIO002'),(23,'Born a Crime','Trevor Noah','Autobiography',25,'BIO003'),(24,'The Hitchhiker\'s Guide to the Galaxy','Douglas Adams','Science Fiction',8,'SF001'),(25,'Dune','Frank Herbert','Science Fiction',12,'SF002'),(26,'1984','George Orwell','Dystopian',20,'DYS001'),(27,'Brave New World','Aldous Huxley','Dystopian',15,'DYS002'),(28,'To Kill a Mockingbird','Harper Lee','Classic',25,'CLA001'),(29,'Pride and Prejudice','Jane Austen','Classic',10,'CLA002'),(30,'The Great Gatsby','F. Scott Fitzgerald','Classic',18,'CLA003'),(31,'One Hundred Years of Solitude','Gabriel Garcia Marquez','Magic Realism',12,'MAG001'),(32,'The Road','Cormac McCarthy','Post-Apocalyptic',8,'POS001'),(33,'The Hunger Games','Suzanne Collins','Dystopian',15,'DYS003'),(34,'Harry Potter and the Sorcerer\'s Stone','J.K. Rowling','Fantasy',25,'FAN001'),(35,'The Hobbit','J.R.R. Tolkien','Fantasy',10,'FAN002'),(36,'The Shining','Stephen King','Horror',18,'HOR001'),(37,'Dracula','Bram Stoker','Horror',12,'HOR002'),(38,'The Girl with the Dragon Tattoo','Stieg Larsson','Mystery',20,'MYS001'),(39,'Gone Girl','Gillian Flynn','Mystery',15,'MYS002'),(40,'The Da Vinci Code','Dan Brown','Thriller',8,'THR001'),(41,'The Girl on the Train','Paula Hawkins','Thriller',10,'THR002'),(42,'The Catcher in the Rye','J.D. Salinger','Coming of Age',18,'COA001'),(43,'Lord of the Flies','William Golding','Dystopian',25,'DYS004'),(44,'Fahrenheit 451','Ray Bradbury','Dystopian',12,'DYS005'),(45,'a','a','Biography',1,'A'),(48,'Let Us C','Yashavant Kanetkar','Science',49,'prg_c_1');

UNLOCK TABLES;


DROP TABLE IF EXISTS `issuance_table`;
CREATE TABLE `issuance_table` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_name` varchar(255) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `book_id` int NOT NULL,
  `issue_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `returned` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `book_id` (`book_id`),
  CONSTRAINT `issuance_table_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books_table` (`id`)
) 

LOCK TABLES `issuance_table` WRITE;

INSERT INTO `issuance_table` VALUES (7,'Alice','3',12,'2024-01-02 16:58:00',NULL),(8,'John Doe','1',5,'2024-01-29 17:44:45',NULL),(9,'Bob Johnson','4',21,'2024-01-29 18:00:07',NULL),(10,'Bob Johnson','4',48,'2024-01-29 18:35:24',NULL),(11,'Bob Johnson','4',1,'2024-01-29 18:39:50',NULL),(12,'John Doe','1',5,'2024-01-29 18:40:24',NULL),(15,'John Doe','2',12,'2024-01-29 18:41:30',NULL);

UNLOCK TABLES;


DROP TABLE IF EXISTS `user_table`;
CREATE TABLE `user_table` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `password` varchar(32) NOT NULL,
  `membership_months` int DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) 

LOCK TABLES `user_table` WRITE;

INSERT INTO `user_table` VALUES (1,'John Doe','john@example.com','Male','482c811da5d5b4bc6d497ffa98491e38',6),(2,'Jane Doe','jane@example.com','Female','96b33694c4bb7dbd07391e0be54745fb',2),(3,'Alice Smith','alice@example.com','Female','7c90f2dc82aa5dd4501132f6d074a53a',NULL),(4,'Bob Johnson','bob@example.com','Male','6a3c7c6166b4ffcf922329d0e821003b',NULL);

UNLOCK TABLES;

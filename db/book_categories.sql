/*
-- Query: SELECT * FROM lmspro.book_categories
LIMIT 0, 1000

-- Date: 2024-01-29 23:52
*/
INSERT INTO `` (`id`,`category_name`) VALUES (7,'Biography');
INSERT INTO `` (`id`,`category_name`) VALUES (5,'Fantasy');
INSERT INTO `` (`id`,`category_name`) VALUES (1,'Fiction');
INSERT INTO `` (`id`,`category_name`) VALUES (9,'History');
INSERT INTO `` (`id`,`category_name`) VALUES (3,'Mystery');
INSERT INTO `` (`id`,`category_name`) VALUES (2,'Non-Fiction');
INSERT INTO `` (`id`,`category_name`) VALUES (10,'Poetry');
INSERT INTO `` (`id`,`category_name`) VALUES (6,'Romance');
INSERT INTO `` (`id`,`category_name`) VALUES (4,'Science Fiction');
INSERT INTO `` (`id`,`category_name`) VALUES (8,'Self-Help');



-- Add a new column named category_code to the book_category table
ALTER TABLE book_categories
ADD COLUMN category_code VARCHAR(10);

-- Add a unique constraint to the category_name column
ALTER TABLE book_categories
ADD CONSTRAINT unique_category_name UNIQUE (category_name);



CREATE TABLE book_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(255) UNIQUE,
    category_code VARCHAR(50)
);


INSERT INTO book_categories (category_name, category_code) VALUES
('Fiction', 'FIC'),
('Non-Fiction', 'NON'),
('Mystery', 'MYS'),
('Science Fiction', 'SCI'),
('Fantasy', 'FAN'),
('Romance', 'ROM'),
('Horror', 'HOR'),
('Biography', 'BIO'),
('History', 'HIS'),
('Self-Help', 'SEL'),
('Thriller', 'THR'),
('Adventure', 'ADV'),
('Dystopian', 'DYS'),
('Children', 'CHI'),
('Young Adult', 'YAU'),
('Poetry', 'POE'),
('Classic', 'CLA'),
('Cooking', 'COO'),
('Travel', 'TRA'),
('Religion', 'REL'),
('Art', 'ART'),
('Music', 'MUS'),
('Drama', 'DRA'),
('Humor', 'HUM'),
('Graphic Novel', 'GRA'),
('Science', 'SCE'),
('Technology', 'TEC'),
('Psychology', 'PSY'),
('Business', 'BUS');




INSERT INTO book_categories (category_name, category_code) VALUES
('Environmental', 'ENV'),
('Urban Fantasy', 'URB'),
('Paranormal', 'PAR'),
('Supernatural', 'SUP'),
('Steampunk', 'STE'),
('Cyberpunk', 'CYB'),
('Space Opera', 'SPA'),
('Apocalyptic', 'APO'),
('Post-Apocalyptic', 'POS'),
('Time Travel', 'TIM'),
('Alternate History', 'ALT'),
('Magical Realism', 'MAG'),
('Surrealism', 'SUR'),
('Crime', 'CRI'),
('Legal Thriller', 'LEG'),
('Medical Thriller', 'MED'),
('Political Thriller', 'POL'),
('Spy Thriller', 'SPY'),
('Military History', 'MIL'),
('True Crime', 'TRU'),
('Philosophy', 'PHI'),
('Metaphysics', 'MET'),
('Ethics', 'ETH'),
('Folklore', 'FOL'),
('Mythology', 'MYT'),
('Occult', 'OCC'),
('Conspiracy', 'CON'),
('Espionage', 'ESP'),
('Survival', 'SUR'),
('Zen Buddhism', 'ZEN'),
('Gastronomy', 'GAS'),
('Cryptocurrency', 'CRY'),
('Astrophysics', 'AST'),
('Quantum Mechanics', 'QUA'),
('Ancient Civilizations', 'ANC'),
('Postmodernism', 'POS'),
('Culinary Memoir', 'CUL'),
('Experimental Literature', 'EXP'),
('Urban Planning', 'URP'),
('Existentialism', 'EXI'),
('Cognitive Science', 'COG'),
('Afrofuturism', 'AFR'),
('Ecofeminism', 'ECO'),
('Dadaism', 'DAD'),
('Sustainability', 'SUS'),
('Minimalism', 'MIN'),
('Futurism', 'FUT'),
('Deep Learning', 'DEE'),
('Space Exploration', 'SPE'),
('Cultural Anthropology', 'ANT'),
('Legal Philosophy', 'LEG'),
('Environmental Ethics', 'ENV'),
('Disability Studies', 'DIS'),
('Astrobiology', 'AST'),
('Historical Fiction', 'HIF'),
('Political Philosophy', 'POL'),
('Molecular Biology', 'MOL'),
('Cognitive Psychology', 'COG');


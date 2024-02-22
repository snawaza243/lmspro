-- Active: 1694423108902@@127.0.0.1@3306@lmspro
-- Create the database
CREATE DATABASE lmspro;

-- Create a user and set a password
CREATE USER 'lmspro_user'@'localhost' IDENTIFIED BY 'your_password';

-- Grant privileges to the user on the lmspro database
GRANT ALL PRIVILEGES ON lmspro.* TO 'lmspro_user'@'localhost';

-- Flush privileges to apply the changes
FLUSH PRIVILEGES;


use lmspro;

CREATE TABLE user_table (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    password VARCHAR(32) NOT NULL
);

-- Insert demo user data
INSERT INTO user_table (name, email, gendeissued_booksr, password) VALUES
    ('John Doe', 'john@example.com', 'Male', MD5('password123')),
    ('Jane Doe', 'jane@example.com', 'Female', MD5('password456'));

-- Create the issued_books table
CREATE TABLE issued_books (
    serial_number INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    book_id INT,
    book_name VARCHAR(50) NOT NULL,
    author VARCHAR(50) NOT NULL,
    category VARCHAR(50) NOT NULL,
    issued_date_from DATE NOT NULL,
    due_date_to DATE NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user_table(user_id)
);

-- Insert demo issued_books data
INSERT INTO issued_books (user_id, book_id, book_name, author, category, issued_date_from, due_date_to) VALUES
    (1, 101, 'The Catcher in the Rye', 'J.D. Salinger', 'Fiction', '2022-01-01', '2022-01-16'),
    (2, 102, 'To Kill a Mockingbird', 'Harper Lee', 'Classics', '2022-01-05', '2022-01-20'),
    (1, 103, '1984', 'George Orwell', 'Science Fiction', '2022-01-10', '2022-01-25');

-- Add demo data for additional users
INSERT INTO user_table (name, email, gender, password) VALUES
    ('Alice Smith', 'alice@example.com', 'Female', MD5('alicepass')),
    ('Bob Johnson', 'bob@example.com', 'Male', MD5('bobpass'));

-- Add demo data for additional issued_books
INSERT INTO issued_books (user_id, book_id, book_name, author, category, issued_date_from, due_date_to) VALUES
    (3, 104, 'The Great Gatsby', 'F. Scott Fitzgerald', 'Classics', '2022-01-15', '2022-01-30'),
    (4, 105, 'Brave New World', 'Aldous Huxley', 'Science Fiction', '2022-01-20', '2022-02-04');


ALTER TABLE user_table
ADD COLUMN membership_months INT;




-- Admin table
CREATE TABLE admin_table (
    id INT PRIMARY KEY AUTO_INCREMENT,
    admin_id VARCHAR(255) UNIQUE NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Books table
CREATE TABLE books_table (
    id INT PRIMARY KEY AUTO_INCREMENT,
    book_name VARCHAR(255) NOT NULL,
    book_author VARCHAR(255) NOT NULL,
    category VARCHAR(50) NOT NULL,
    available_books INT NOT NULL
);



INSERT INTO admin_table (admin_id, name, email, gender, password)
VALUES ('101', 'Sam', 'admin@gmail.com', 'Male', MD5('admin123'));

-- Alter the books_table to increase the length of book_code
ALTER TABLE books_table
ADD  COLUMN book_code VARCHAR(50) UNIQUE NOT NULL;



INSERT INTO books_table (book_code, book_name, book_author, category, available_books)
VALUES
('MOT001', 'The Power of Now', 'Eckhart Tolle', 'Motivation', 10),
('MOT002', 'Atomic Habits', 'James Clear', 'Motivation', 15),
('MOT003', 'Man\'s Search for Meaning', 'Viktor E. Frankl', 'Motivation', 8),
('MOT004', 'The 7 Habits of Highly Effective People', 'Stephen R. Covey', 'Motivation', 12),
('MOT005', 'Think and Grow Rich', 'Napoleon Hill', 'Motivation', 20),
('SPI001', 'The Four Agreements', 'Don Miguel Ruiz', 'Spirituality', 18),
('SPI002', 'The Alchemist', 'Paulo Coelho', 'Spirituality', 25),
('SPI003', 'A New Earth', 'Eckhart Tolle', 'Spirituality', 10),
('AUT001', 'Autobiography of a Yogi', 'Paramahansa Yogananda', 'Autobiography', 15),
('AUT002', 'Long Walk to Freedom', 'Nelson Mandela', 'Autobiography', 8),
('AUT003', 'The Diary of a Young Girl', 'Anne Frank', 'Autobiography', 12),
('AUT004', 'Steve Jobs', 'Walter Isaacson', 'Autobiography', 20),
('COM001', 'Maus', 'Art Spiegelman', 'Comic', 18),
('COM002', 'Persepolis', 'Marjane Satrapi', 'Comic', 25),
('COM003', 'Watchmen', 'Alan Moore', 'Comic', 10),
('COM004', 'Fun Home', 'Alison Bechdel', 'Comic', 15),
('COM005', 'Blankets', 'Craig Thompson', 'Comic', 8),
('MOT006', 'The Power of Habit', 'Charles Duhigg', 'Motivation', 12),
('HIS001', 'Sapiens', 'Yuval Noah Harari', 'History', 20),
('SCI001', 'The Immortal Life of Henrietta Lacks', 'Rebecca Skloot', 'Science', 18),
('BIO001', 'Educated', 'Tara Westover', 'Biography', 15),
('BIO002', 'Becoming', 'Michelle Obama', 'Autobiography', 10),
('BIO003', 'Born a Crime', 'Trevor Noah', 'Autobiography', 25),
('SF001', 'The Hitchhiker\'s Guide to the Galaxy', 'Douglas Adams', 'Science Fiction', 8),
('SF002', 'Dune', 'Frank Herbert', 'Science Fiction', 12),
('DYS001', '1984', 'George Orwell', 'Dystopian', 20),
('DYS002', 'Brave New World', 'Aldous Huxley', 'Dystopian', 15),
('CLA001', 'To Kill a Mockingbird', 'Harper Lee', 'Classic', 25),
('CLA002', 'Pride and Prejudice', 'Jane Austen', 'Classic', 10),
('CLA003', 'The Great Gatsby', 'F. Scott Fitzgerald', 'Classic', 18),
('MAG001', 'One Hundred Years of Solitude', 'Gabriel Garcia Marquez', 'Magic Realism', 12),
('POS001', 'The Road', 'Cormac McCarthy', 'Post-Apocalyptic', 8),
('DYS003', 'The Hunger Games', 'Suzanne Collins', 'Dystopian', 15),
('FAN001', 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', 'Fantasy', 25),
('FAN002', 'The Hobbit', 'J.R.R. Tolkien', 'Fantasy', 10),
('HOR001', 'The Shining', 'Stephen King', 'Horror', 18),
('HOR002', 'Dracula', 'Bram Stoker', 'Horror', 12),
('MYS001', 'The Girl with the Dragon Tattoo', 'Stieg Larsson', 'Mystery', 20),
('MYS002', 'Gone Girl', 'Gillian Flynn', 'Mystery', 15),
('THR001', 'The Da Vinci Code', 'Dan Brown', 'Thriller', 8),
('THR002', 'The Girl on the Train', 'Paula Hawkins', 'Thriller', 10),
('COA001', 'The Catcher in the Rye', 'J.D. Salinger', 'Coming of Age', 18),
('DYS004', 'Lord of the Flies', 'William Golding', 'Dystopian', 25),
('DYS005', 'Fahrenheit 451', 'Ray Bradbury', 'Dystopian', 12);



CREATE TABLE book_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(255) NOT NULL UNIQUE
);

INSERT INTO book_categories (category_name) VALUES
    ('Fiction'),
    ('Non-Fiction'),
    ('Mystery'),
    ('Science Fiction'),
    ('Fantasy'),
    ('Romance'),
    ('Biography'),
    ('Self-Help'),
    ('History'),
    ('Poetry');


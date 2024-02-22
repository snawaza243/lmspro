-- Active: 1694423108902@@127.0.0.1@3306@lmspro
ALTER TABLE issuance_table
DROP FOREIGN KEY issuance_table_ibfk_1,
ADD CONSTRAINT issuance_table_ibfk_1
FOREIGN KEY (id)
REFERENCES books_table (id)
ON DELETE CASCADE;

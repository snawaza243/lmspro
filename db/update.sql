DROP TABLE IF EXISTS `issuance_table`;

CREATE TABLE `issuance_table` (
    `id` int NOT NULL AUTO_INCREMENT, `user_id` int NOT NULL, -- Add the user_id column here
    `book_id` int NOT NULL, `issue_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP, `returned` int DEFAULT NULL, PRIMARY KEY (`id`), KEY `book_id` (`book_id`), CONSTRAINT `issuance_table_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books_table` (`id`), CONSTRAINT `issuance_table_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`user_id`) -- Add foreign key constraint
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

x
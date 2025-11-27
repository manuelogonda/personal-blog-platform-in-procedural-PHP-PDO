DROP DATABASE IF EXISTS Blogdb;
CREATE DATABASE Blogdb;
USE Blogdb;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    category_id INT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT,
    user_id INT,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE post_tags (
    post_id INT,
    tag_id INT,
    PRIMARY KEY(post_id, tag_id),
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);

--A join to display the whole post details
 SELECT 
    p.id AS post_id,
    p.title AS post_title,
    p.content AS post_content,
    p.created_at AS time_posted
    u.username,
    u.email AS user_email,
    c.name AS category_name,
    Co.content AS comments
FROM posts p
INNER JOIN categories c
ON c.id = p.category_id
INNER JOIN users u 
ON u.id = p.user_id
INNER JOIN comments Co 
ON Co.post_id = p.id;


/*
Explanation of Tables
users: Blog authors and commenters.

posts: Main blog content, with references to authors and categories.

categories: Group your posts (e.g., "Tech", "Travel").

comments: Readers can post comments; related to posts and users.

tags & post_tags: Add keyword tags to posts (many-to-many relationship).


------------------------------------
ON DELETE CASCADE automatically deletes all child rows 
referencing the parent row when the parent is deleted. 
This is useful for tightly connected data where removing a parent should also remove all dependents, 
ensuring no orphaned child rows remain.
---------------------------

ON DELETE RESTRICT prevents deletion of the parent row if any related child rows exist. 
This means you cannot delete the parent until you manually delete or update the child rows. 
It acts as a strong data integrity safeguard to avoid accidental loss of related data.

--------------------
ON DELETE SET NULL 
When a foreign key id=s deleted then replace its value with null
*/

---Altering posts table to set ON DELETE CASCADE to a foreign key
ALTER TABLE posts ADD Constraint user_id FOREIGN KEY (user_id) 
REFERENCES users(id) ON DELETE CASCADE;

ALTER TABLE posts ADD Constraint category_id FOREIGN KEY (category_id) 
REFERENCES categories(id) ON DELETE CASCADE;

---Altering coments table to set ON DELETE CASCADE to a foreign key
ALTER TABLE comments ADD Constraint post_id FOREIGN KEY (post_id) 
REFERENCES posts(id) ON DELETE CASCADE;

ALTER TABLE comments ADD Constraint user_id FOREIGN KEY (user_id) 
REFERENCES users(id) ON DELETE CASCADE;

--Altering posts_tags table to set ON DELETE CASCADE to a foreign key
ALTER TABLE comments ADD Constraint user_id FOREIGN KEY (user_id) 
REFERENCES users(id) ON DELETE CASCADE;

ALTER TABLE comments ADD Constraint user_id FOREIGN KEY (user_id) 
REFERENCES users(id) ON DELETE CASCADE;

--DATE functions MySQL: YEAR(), MONTH(), DAY(), HOUR(), MINUTE(), SECOND()->Gets specifird item from
--the timestamp paa in the column name
--1)DATEPART[sql server] function is used to extract specific date and time components, 
--such as the year, month, day, hour, minute, or second, from a datetime or timestamp value
SELECT DAY(created_at) AS day_created
FROM users;

SELECT YEAR(created_at) AS day_created
FROM users;

--CURRENT_TIMESTAMP() function returns the current date and time.



CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100),
    gender VARCHAR(10),
    birth_date DATE,
    phone VARCHAR(20),
    address TEXT,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    phone VARCHAR(11) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('client', 'driver') NOT NULL
);

CREATE TABLE drivers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    birthday DATE NOT NULL,
    rate DECIMAL(2, 1) DEFAULT 5.0,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    birthday DATE NOT NULL,
    rate DECIMAL(2, 1) DEFAULT 5.0,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    number VARCHAR(10) NOT NULL,
    release_year INT NOT NULL,
    baby_seat BOOLEAN NOT NULL
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    price DECIMAL(9, 2) NOT NULL,
    order_datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
    baby BOOLEAN NOT NULL,
    car_id INT,
    driver_id INT,
    client_id INT,
    FOREIGN KEY (car_id) REFERENCES cars(id) ON DELETE CASCADE,
    FOREIGN KEY (driver_id) REFERENCES drivers(id) ON DELETE CASCADE,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE
);

INSERT INTO users (phone, password_hash, role) VALUES
    ('89031234567', 'hashed_password_1', 'driver'),
    ('89037654321', 'hashed_password_2', 'client'),
    ('89039998877', 'hashed_password_3', 'driver'),
    ('89045553322', 'hashed_password_4', 'client');

INSERT INTO drivers (name, birthday, rate, user_id) VALUES
    ('Иван', '1985-03-25', 4.5, 1),
    ('Анна', '1990-07-15', 5.0, 3);

INSERT INTO clients (name, birthday, rate, user_id) VALUES
    ('Николай', '1988-11-12', 4.7, 2),
    ('Екатерина', '1992-06-30', 4.9, 4);

INSERT INTO cars (number, release_year, baby_seat) VALUES
    ('A123BC', 2015, TRUE),
    ('B234CE', 2018, FALSE),
    ('C345KE', 2020, TRUE);

INSERT INTO orders (price, baby, car_id, driver_id, client_id) VALUES
    (300.00, TRUE, 1, 1, 2),
    (450.00, FALSE, 2, 2, 4),
    (200.00, TRUE, 3, 1, 3),
    (350.00, FALSE, 2, 2, 1);

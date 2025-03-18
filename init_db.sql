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
    ('89031234567', 'hashed_password_1', 'client'),
    ('89039876543', 'hashed_password_2', 'driver'),
    ('89031239876', 'hashed_password_3', 'client'),
    ('89036547890', 'hashed_password_4', 'driver'),
    ('89031234500', 'hashed_password_5', 'client'),
    ('89032345678', 'hashed_password_6', 'driver'),
    ('89033456789', 'hashed_password_7', 'client'),
    ('89034567890', 'hashed_password_8', 'driver'),
    ('89035678901', 'hashed_password_9', 'client'),
    ('89036789012', 'hashed_password_10', 'driver');

INSERT INTO drivers (name, birthday, rate, user_id) VALUES
    ('Александр', '1987-04-14', 4.5, 2),
    ('Николай', '1992-03-05', 4.8, 4),
    ('Елизавета', '1989-06-30', 4.7, 6),
    ('Петр', '1983-09-22', 4.9, 8),
    ('Татьяна', '1991-12-17', 5.0, 10);

INSERT INTO clients (name, birthday, rate, user_id) VALUES
    ('Иван', '1990-05-10', 4.8, 1),
    ('Мария', '1985-08-15', 4.9, 3),
    ('Сергей', '2000-01-20', 5.0, 5),
    ('Елена', '1993-11-11', 4.7, 7),
    ('Алексей', '1988-07-23', 4.6, 9);

INSERT INTO cars (number, release_year, baby_seat) VALUES
    ('А123ВС', 2015, 1),
    ('B456HE', 2018, 0),
    ('C789PO', 2020, 1),
    ('M012HK', 2017, 0),
    ('E345PK', 2019, 1);

INSERT INTO orders (price, order_datetime, baby, car_id, driver_id, client_id) VALUES
    (1500.50, '2025-03-17 08:30:00', 1, 1, 1, 1),
    (2000.00, '2025-03-17 09:00:00', 0, 2, 2, 2),
    (1800.75, '2025-03-17 10:15:00', 1, 3, 3, 3),
    (2200.30, '2025-03-17 11:45:00', 0, 4, 4, 4),
    (1700.20, '2025-03-17 13:00:00', 1, 5, 5, 5);

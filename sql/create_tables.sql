CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    city VARCHAR(100),
    age INT,
    verified BOOLEAN DEFAULT 0,
    verification_token VARCHAR(32)
);

CREATE TABLE admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone_number VARCHAR(15) NOT NULL, -- Added phone number field
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Added timestamp for creation
);


CREATE TABLE buses (
    bus_id INT ,
    bus_name VARCHAR(100) NOT NULL,
    route VARCHAR(255) NOT NULL,
    schedule VARCHAR(100) NOT NULL,
    available_date DATE NOT NULL,
     fare FLOAT,
     capacity INT,
     id INT AUTO_INCREMENT PRIMARY KEY,
);

CREATE TABLE trip_history (
    trip_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    bus_name VARCHAR(100),
    route VARCHAR(255),
    trip_date DATE,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    bus_id INT NOT NULL,
    travel_date DATE NOT NULL,
    seat_count INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (bus_id) REFERENCES buses(id)
);

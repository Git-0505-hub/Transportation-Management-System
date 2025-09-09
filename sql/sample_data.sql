USE bus_reservation;
INSERT INTO admins (email, password) VALUES
('admin@example.com', '$2y$10$EXAMPLEHASHEDPASSWORD'); -- Replace with actual hash

INSERT INTO buses (bus_name, route, schedule, available_date) VALUES
('City Express', 'A-B-C', '09:00 AM - 05:00 PM', '2024-12-01'),
('Metro Deluxe', 'X-Y-Z', '08:00 AM - 04:00 PM', '2024-12-01');

INSERT INTO users (name, email, password, city, age, verified) VALUES
('John Doe', 'john@example.com', '$2y$10$EXAMPLEHASHEDPASSWORD', 'New York', 25, 1);

INSERT INTO trip_history (user_id, bus_name, route, trip_date) VALUES
(1, 'City Express', 'A-B-C', '2024-12-01'),
(1, 'Metro Deluxe', 'X-Y-Z', '2024-12-02');

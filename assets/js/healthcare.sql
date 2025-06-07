CREATE TABLE doctors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    specialty VARCHAR(100),
    department VARCHAR(100),
    contact VARCHAR(100)
);

-- Sample data
INSERT INTO doctors (name, specialty, department, contact) VALUES
('Dr. John Smith', 'Cardiology', 'Heart Center', 'john@hospital.com'),
('Dr. Emily Watson', 'Pediatrics', 'Children Care', 'emily@hospital.com'),
('Dr. Sarah Khan', 'Neurology', 'Brain Unit', 'sarah@hospital.com');

CREATE DATABASE IF NOT EXISTS quality_improvement;
USE quality_improvement;

-- Users Table (For Admin and Users)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- KPI Tracking Table (For Monitoring Performance Metrics)
CREATE TABLE IF NOT EXISTS kpi_tracking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    kpi_name VARCHAR(255) NOT NULL,
    kpi_value DECIMAL(10,2) NOT NULL,
    recorded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Feedback Table (For User and Customer Feedback)
CREATE TABLE IF NOT EXISTS feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    feedback_text TEXT NOT NULL,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Compliance Records Table (For Regulatory Compliance Management)
CREATE TABLE IF NOT EXISTS compliance_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    policy_name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    compliance_status ENUM('compliant', 'non-compliant', 'pending review') DEFAULT 'pending review',
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Audit Logs Table (For Tracking User Activities)
CREATE TABLE IF NOT EXISTS audit_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    action VARCHAR(255) NOT NULL,
    action_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Notifications Table (For Sending Alerts and Updates)
CREATE TABLE IF NOT EXISTS notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    message TEXT NOT NULL,
    status ENUM('unread', 'read') DEFAULT 'unread',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Issues Table (For Reporting System Issues)
CREATE TABLE IF NOT EXISTS issues (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    status ENUM('pending', 'in progress', 'resolved', 'closed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert Sample Admin and Users
INSERT INTO users (username, email, password, role) VALUES 
('Admin', 'admin@example.com', 'admin123', 'admin'),
('User1', 'user1@example.com', 'user123', 'user'),
('User2', 'user2@example.com', 'user123', 'user');

-- Insert Sample KPI Tracking Data
INSERT INTO kpi_tracking (user_id, kpi_name, kpi_value) VALUES 
(2, 'Sales Growth', 75.5),
(3, 'Customer Satisfaction', 90.2),
(2, 'Employee Efficiency', 88.7);

-- Insert Sample Feedback
INSERT INTO feedback (user_id, feedback_text, rating) VALUES 
(2, 'Great system, very useful!', 5),
(3, 'Needs improvements in reporting.', 3);

-- Insert Sample Compliance Records
INSERT INTO compliance_records (policy_name, description, compliance_status) VALUES
('GDPR Compliance', 'Ensure user data privacy and protection under GDPR.', 'compliant'),
('ISO 27001', 'Security management framework for IT systems.', 'non-compliant');

-- Insert Sample Audit Logs
INSERT INTO audit_logs (user_id, action) VALUES
(1, 'Admin logged in'),
(2, 'Updated compliance record: GDPR Compliance');

-- Insert Sample Notifications
INSERT INTO notifications (user_id, message, status) VALUES
(2, 'New KPI record submitted.', 'unread'),
(3, 'Your feedback has been reviewed.', 'unread');

-- Insert Sample Issues
INSERT INTO issues (user_id, title, description, status) VALUES 
(2, 'Login Issue', 'User cannot log in after password reset.', 'pending'),
(3, 'Data Sync Error', 'Real-time data sync is not working as expected.', 'in progress');

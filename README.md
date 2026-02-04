# Online Electricity Bill Payment System

## Overview

The **Online Electricity Bill Payment System** is a web-based application designed to streamline the process of managing electricity bills. It serves three main types of users: **Consumers (Users)**, **Employees**, and **Admins**. The system allows for new user registration, bill generation based on meter readings and consumer categories, and centralized record viewing for administrators.

## Features

### 1. User (Consumer) Module
- **Registration**: New users can register by providing their personal details (Name, Phone, Address, Pincode) and connection category (Household, Commercial, Industry).
- **Dashboard**: Upon registration or login via Meter Number, users can view their:
  - Bill Number
  - Meter Number
  - Current Bill Amount
  - Due Amount
  - Bill Date and Due Date
  - Payment Status

### 2. Employee Module
- **Bill Generation**: Employees can generate bills for consumers by entering the **Meter Number** and the **Present Reading**.
- **Automated Calculation**: The system automatically calculates the bill amount based on the units consumed (Present Reading - Past Reading) and the category rate:
  - **Household**: ₹7 per unit
  - **Commercial**: ₹10 per unit
  - **Industry**: ₹12 per unit
  - **Minimum Bill**: ₹50 (if usage is 0 units)
- **Database Update**: Updates the consumer's record with new readings, bill dates, and due amounts.

### 3. Admin Module
- **Dashboard**: Admins have a comprehensive view of all consumers, including their names, categories, and outstanding due amounts.

### 4. General
- **View Bill**: A public-facing page where anyone can check bill details by simply entering a Meter Number.
- **Validation**: Input validation for names (CamelCase), phone numbers (10 digits), and pincodes.

## Technology Stack

- **Frontend**: HTML, CSS
- **Backend**: PHP
- **Database**: MySQL

## File Structure

- `Electricity_bill/`
  - `main_dashboard.php`: The landing page with links to User, Employee, and Admin sections.
  - `register.php`: User registration form and processing logic.
  - `user_dashboard.php`: Displays consumer details and bill status.
  - `employee_dashboard.php`: Interface for employees to calculate and generate bills.
  - `admin_dashboard.php`: List of all consumers for the administrator.
  - `view.php`: Standalone page to search and view bills.
  - `style.css`: Stylesheet for the application.

## Installation and Setup

### Prerequisites
- A local web server with PHP support (e.g., XAMPP, WAMP, LAMP).
- MySQL Database.

### Steps

1. **Clone the Repository**
   ```bash
   git clone <repository-url>
   ```

2. **Database Setup**
   - Open your MySQL management tool (e.g., phpMyAdmin).
   - Create a new database named `electricity_db`.
   - Run the following SQL command to create the necessary table:

   ```sql
   CREATE TABLE consumers (
       id INT AUTO_INCREMENT PRIMARY KEY,
       meter_no VARCHAR(50) NOT NULL UNIQUE,
       name VARCHAR(100) NOT NULL,
       phone VARCHAR(15) NOT NULL,
       address TEXT NOT NULL,
       pincode VARCHAR(10) NOT NULL,
       category ENUM('household', 'commercial', 'industry') NOT NULL,
       bill_date DATE,
       due_date DATE,
       past_units INT DEFAULT 0,
       present_units INT DEFAULT 0,
       due_amount DECIMAL(10,2) DEFAULT 0.00,
       paid_amount DECIMAL(10,2) DEFAULT 0.00
   );
   ```

3. **Configure Connection**
   - The application expects a database connection with:
     - **Host**: `localhost`
     - **User**: `root`
     - **Password**: `""` (empty)
     - **Database**: `electricity_db`
   - If your credentials differ, update the `mysqli_connect` line in the `.php` files (e.g., `register.php`, `dashboard.php`, etc.).

4. **Run the Application**
   - Move the project folder to your server's root directory (e.g., `htdocs` in XAMPP).
   - Open your browser and navigate to:
     ```
     http://localhost/Electricity_bill/main_dashboard.php
     ```

## Usage Guide

1. **Start**: Go to `main_dashboard.php`.
2. **Register**: Click on **User** to register a new connection. Note down the generated **Meter Number**.
3. **Generate Bill**: Click on **Employee**, enter the Meter Number and the current reading (must be higher than 0).
4. **View Bill**: Click on **View Bill (Any Meter)** or go to the **User** dashboard with your meter number to see the generated bill.
5. **Admin**: Click on **Admin** to see a list of all users.

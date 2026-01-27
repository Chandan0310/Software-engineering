# ELECTRICITY BILL MANAGEMENT SYSTEM - MODULE DOCUMENTATION

**Project:** Electricity Bill Management System  
**Version:** 2.0.0  
**Date:** January 27, 2026  
**Author:** Chandan
**Tech Stack:** PHP, MySQL, HTML, CSS  

---

## TABLE OF CONTENTS

1. [Module Specifications](#module-specifications)
   - [Validation Module](#1-validation-module)
   - [Computation Module](#2-computation-module)
   - [Database Module](#3-database-module)
   - [Registration Module](#4-registration-module)

---

## MODULE SPECIFICATIONS

### 1. VALIDATION MODULE

**File:** `includes/functions.php`

#### 1.1 validateName()

| **Module Name**    | validateName |
| **Input**          | name (string) - Consumer name to validate |
| **Pre-conditions** | name must not be empty |
| **Output**         | Boolean - true if valid (alphabets only), false otherwise |

**Algorithm:**
```
1. Define regex pattern: /^[A-Za-z\s]+$/
   (Allocates uppercase, lowercase, and spaces)
2. Match input name against pattern.
3. Return Result.
```

**Pseudo Code:**
```php
FUNCTION validateName($name)
    SET pattern = "/^[A-Za-z\s]+$/"
    IF preg_match(pattern, $name) THEN
        RETURN true
    ELSE
        RETURN false
    END IF
END FUNCTION
```

---

#### 1.2 validatePhone()

| **Module Name**    | validatePhone |
| **Input**          | phone (string) - Phone number to validate |
| **Pre-conditions** | phone must not be empty |
| **Output**         | Boolean - true if exactly 10 digits |

**Algorithm:**
```
1. Define regex pattern: /^[0-9]{10}$/
2. Match input phone against pattern.
3. Return Result.
```

**Pseudo Code:**
```php
FUNCTION validatePhone($phone)
    SET pattern = "/^[0-9]{10}$/"
    IF preg_match(pattern, $phone) THEN
        RETURN true
    ELSE
        RETURN false
    END IF
END FUNCTION
```

---

### 2. COMPUTATION MODULE

**File:** `includes/functions.php`

#### 2.1 calculateBill()

| **Module Name**    | calculateBill |
| **Input**          | units (integer) - Units consumed (Present - Past) |
| **Pre-conditions** | units >= 0 |
| **Output**         | Float - Total Bill Amount |

**Tiered Pricing Structure:**
| Units Range | Rate (Rs/unit) |
|-------------|----------------|
| 0 (No usage)| Min Charge ₹25 |
| 1-50        | 1.5            |
| 51-100      | 2.5            |
| 101-150     | 3.5            |
| 151+        | 4.5            |

**Algorithm:**
```
1. IF units <= 0: Return 25 (Minimum Charge).
2. Initialize amount = 0.
3. Apply Tier 1 (1-50):
   - IF units > 50: Add 50 * 1.5 to amount, Subtract 50 from units.
   - ELSE: Add units * 1.5 to amount, Set units = 0.
4. Apply Tier 2 (51-100):
   - IF units > 0 AND units > 50: Add 50 * 2.5, Subtract 50.
   - ELSE IF units > 0: Add units * 2.5, Set units = 0.
5. Apply Tier 3 (101-150):
   - IF units > 0 AND units > 50: Add 50 * 3.5, Subtract 50.
   - ELSE IF units > 0: Add units * 3.5, Set units = 0.
6. Apply Tier 4 (>150):
   - IF units > 0: Add units * 4.5.
7. Return Total Amount.
```

**Pseudo Code:**
```php
FUNCTION calculateBill($units)
    IF $units <= 0 THEN RETURN 25
    
    $amount = 0
    
    IF $units > 50 THEN
        $amount += 50 * 1.5
        $units -= 50
    ELSE
        $amount += $units * 1.5
        $units = 0
    END IF
    
    IF $units > 0 THEN
        IF $units > 50 THEN
            $amount += 50 * 2.5
            $units -= 50
        ELSE
            $amount += $units * 2.5
            $units = 0
        END IF
    END IF
    
    RETURN $amount
END FUNCTION
```

---

#### 2.2 Fine Calculation logic

**Implemented in:** `view.php` / `user_dashboard.php`

| **Logic** | Details |
|-----------|---------|
| **Condition** | Displayed generally as "Amount after Due Date" |
| **Value**     | Flat ₹150 |
| **Formula**   | `Total_With_Fine = Due_Amount + 150` |

---

### 3. DATABASE MODULE

**File:** `includes/db.php`

#### 3.1 db_connect

| **Module Name**    | Database Connection |
| **Input**          | Config constants (Host, User, Pass, DB) |
| **Output**         | MySQLi Connection Object |

**Algorithm:**
```
1. Attempt creation of mysqli connection object.
2. Check for connection errors.
3. IF error: Kill script and display error.
4. ELSE: Script continues with $conn object available.
```

**Configuration:**
```php
Host: "localhost"
User: "root"
Pass: ""
DB:   "electricity_db"
```

---

### 4. REGISTRATION MODULE

**File:** `register.php`

#### 4.1 Register User

| **Process**        | User Registration |
| **Input**          | POST Data (name, phone, address, pincode, category) |
| **Output**         | New Record in DB, Success Message with Service Number |

**Algorithm:**
```
1. Receive POST data.
2. CALL validateName($name). IF False -> Add Error.
3. CALL validatePhone($phone). IF False -> Add Error.
4. IF No Errors:
   a. Generate Random Service Number (6 digits).
   b. Check Uniqueness in DB.
   c. Insert into `consumers` table.
   d. Display Success Message.
5. ELSE:
   a. Display Validation Errors.
```

**Pseudo Code:**
```php
IF POST['register'] THEN
    IF NOT validateName($name) THEN error[] = "Invalid Name"
    IF NOT validatePhone($phone) THEN error[] = "Invalid Phone"
    
    IF empty(error) THEN
        $serviceNo = rand(100000, 999999)
        INSERT INTO consumers VALUES ($serviceNo, ...)
        PRINT "Your Service Number is $serviceNo"
    END IF
END IF
```

---

## 5. DATABASE SCHEMA

To set up the application, create a database named `electricity_db` and run:

```sql
CREATE TABLE consumers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    meter_no VARCHAR(50) NOT NULL UNIQUE,  -- Acts as Service Number
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

**END OF DOCUMENTATION**

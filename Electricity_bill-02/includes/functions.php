<?php

/**
 * Validate Consumer Name
 * Requirement: Alphabets only, no special characters or numbers.
 */
function validateName($name) {
    // Regex: ^[A-Za-z\s]+$ allows letters and spaces. 
    // If strict "alphabets only" implies no spaces, remove \s.
    // Usually names have spaces, so allowing spaces.
    return preg_match('/^[A-Za-z\s]+$/', $name);
}

/**
 * Validate Phone Number
 * Requirement: Exactly 10 digits.
 */
function validatePhone($phone) {
    return preg_match('/^[0-9]{10}$/', $phone);
}

/**
 * Calculate Electricity Bill
 * Requirement:
 * First 50 units – 1.5
 * Second 50 units – 2.5
 * Third 50 units – 3.5
 * Later onwards – 4.5
 * Min charge: 25 (if 0 units)
 */
function calculateBill($units) {
    if ($units <= 0) {
        return 25; // Minimum charge
    }

    $amount = 0;
    
    // First 50 units
    if ($units > 50) {
        $amount += 50 * 1.5;
        $units -= 50;
    } else {
        $amount += $units * 1.5;
        $units = 0;
    }

    // Second 50 units (51-100)
    if ($units > 0) {
        if ($units > 50) {
            $amount += 50 * 2.5;
            $units -= 50;
        } else {
            $amount += $units * 2.5;
            $units = 0;
        }
    }

    // Third 50 units (101-150)
    if ($units > 0) {
        if ($units > 50) {
            $amount += 50 * 3.5;
            $units -= 50;
        } else {
            $amount += $units * 3.5;
            $units = 0;
        }
    }

    // Remaining units (>150)
    if ($units > 0) {
        $amount += $units * 4.5;
    }

    return $amount;
}

/**
 * Format Date
 */
function formatDate($date) {
    return date("d-m-Y", strtotime($date));
}
?>

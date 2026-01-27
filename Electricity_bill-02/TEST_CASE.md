Electricity Billing System - Essential Test Cases
Test Environment
URL: http://localhost/Electricity_bill-02/main_dashboard.php
Database: electricity_db (MySQL)
Test User Name: Chand
TEST CASES
Test 1: Navigation Check
Steps:

Navigate to http://localhost/Electricity_bill-02/main_dashboard.php
Verify all links (User, Employee, Admin, View Bill) are visible.
Expected: All dashboard options are displayed correctly.

Test 2: Register New Consumer
Pre-requisite: Database connection active.

Steps:

Navigate to Registration Page (
register.php
).
Fill form:
Name: Chand
Phone: 9876543210
Address: 123 Main St
Pincode: 500001
Category: household
Click "Register".
Expected:

Success message appears.
Service Number is generated (e.g., 473829).
Service Number is unique.
User "Chand" is added to consumers table.
Test 3: Input Validation (Negative Test)
Steps:

Enter Invalid Name: "Chand123" (contains numbers).
Enter Invalid Phone: "123" (less than 10 digits).
Try to submit.
Expected:

Browser/System alerts: "Name must contain alphabets only".
Browser/System alerts: "Phone number must be exactly 10 digits".
Form does not submit.
Test 4: Bill Generation (Employee)
Pre-requisite: Consumer "Chand" exists. Note Service Number.

Steps:

Navigate to Employee Dashboard (
employee_dashboard.php
).
Enter Service Number: [Chand's Service No].
Enter Present Reading: 150.
Click "Generate Bill".
Expected:

"Bill Generated Successfully" message.
"Bill Date" shows current date.
Tiered Calculation Verified:
First 50 @ 1.5 = 75
Next 50 @ 2.5 = 125
Remaining 50 @ 3.5 = 175
Total should optionally match manual calculation (approx 375 + dues).
Test 5: Bill Calculation - Tier Pricing
Test Data & Expected Bills:

0 units: Minimum Charge = ₹25.
25 units: 25 * 1.5 = ₹37.5.
75 units: (50 * 1.5) + (25 * 2.5) = 75 + 62.5 = ₹137.5.
Verify: Generated bills match these logic rules.

Test 6: View Bill (Public/User)
Pre-requisite: Bill generated for Chand.

Steps:

Navigate to View Bill (
view.php
).
Enter Service Number: [Chand's Service No].
Click "View Bill".
Expected:

Shows consumer details: Name "Chand", Service No.
Shows amounts: Paid, Due.
Shows "Amount after Due Date (with Fine)" (Due + 150).
Test 7: Admin Dashboard View
Steps:

Navigate to Admin Dashboard (
admin_dashboard.php
).
Look for user "Chand" in the list.
Expected:

Card for "Chand" is visible.
Displays: Service No, Name, Category, Due Amount, Bill Date.
Test 8: Service Number UI Consistency
Verify:

Registration Page says "Your Service Number is...".
Input fields say "Enter Meter Number" (as per specialized request).
Output displays say "Service Number" or "Service No".
Expected: Terminology consistency across all pages.

Success Criteria
✅ All tests pass without logic errors. ✅ Validation prevents invalid data entry. ✅ "Chand" user can complete full flow (Register -> Bill -> View). ✅ Tiered pricing is accurate.
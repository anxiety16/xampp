# Student Registration System

A simple web-based student registration system that allows you to add and manage student records with their personal and contact information.

## Features

- Add new student records with:
  - Student Number
  - Personal Information (First Name, Middle Name, Last Name)
  - Gender
  - Birthday
  - Contact Details
  - Complete Address (Street, Town, Province, Zip Code)
- Update student IDs
- Secure database transactions
- Responsive form design with glassmorphism effect

## Technologies Used

- PHP
- MySQL
- HTML
- CSS

## Database Structure

The system uses two main tables:

### students
- student_number
- first_name
- middle_name
- last_name
- gender
- birthday

### student_details
- student_id (foreign key)
- contact_number
- street
- town_city
- province
- zip_code

## Setup Instructions

1. Configure your local server environment (e.g., XAMPP, WAMP)
2. Create a MySQL database named "students"
3. Update database credentials in `db_conn.php`:
   ```php
   $servername = "localhost";
   $username = "root";
   $password = "root";
   $dbase = "students";
   ```
4. Place all files in your web server's directory
5. Access the system through your web browser

## Usage

### Adding a New Student
1. Fill out all required fields in the form
2. For gender, use:
   - 0 for Male
   - 1 for Female
3. Click "Submit" to save the record

### Updating Student ID
1. Enter the old student ID
2. Enter the new student ID
3. Click "Update" to change the ID

## File Structure

- `index.php` - Main application file with form interface
- `db_conn.php` - Database connection configuration
- `styles.css` - CSS styling for the interface

## Contributing

Feel free to fork this project and submit pull requests for any improvements.

## License

This project is open source and available under the [MIT License](LICENSE).


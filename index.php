<?php
include "db_conn.php";

if (isset($_POST['submit'])) {
    $s_num = $_POST['s_number'];
    $s_fn = $_POST['s_fn'];
    $s_mn = $_POST['s_mn'];
    $s_ln = $_POST['s_ln'];
    $s_gender = $_POST['s_gender'];
    $s_bday = $_POST['s_birthday'];

    $s_contact = $_POST['s_contact'];
    $s_street = $_POST['s_street'];
    $s_town = $_POST['s_town'];
    $s_province = $_POST['s_province'];
    $s_zip = $_POST['s_zipcode'];

    $conn->begin_transaction();
    try {
        // first
        $sql1 = $conn->prepare("INSERT INTO students(student_number, first_name, middle_name, last_name, gender, birthday) 
                                VALUES(?, ?, ?, ?, ?, ?)");
        $sql1->bind_param("ssssis", $s_num, $s_fn, $s_mn, $s_ln, $s_gender, $s_bday);
        $sql1->execute();

        $student_id = $conn->insert_id;

        //second
        $sql2 = $conn->prepare("INSERT INTO student_details(student_id, contact_number, street, town_city, province, zip_code)
                                VALUES(?, ?, ?, ?, ?,?)");
        $sql2->bind_param("issiis", $student_id,$s_contact, $s_street, $s_town, $s_province, $s_zip);
        $sql2->execute();

        $conn->commit();
        echo "New transaction added.";
    } catch (Exception $e) {
        $conn->rollback();
        echo $e->getMessage();
    }
    

}
if (isset($_POST['update'])) {
    $s_old_id = $_POST['old'];
    $s_new_id = $_POST['New'];

    $conn->begin_transaction();
    try{
        $sql1 = $conn->prepare('UPDATE students Set id = ? WHERE id = ?');
        $sql1->bind_param("ii", $s_new_id, $s_old_id);
        $sql1->execute();

        $sql2 = $conn->prepare('UPDATE student_details set student_id = ? where student_id = ?');
        $sql1->bind_param("ii", $s_new_id, $s_old_id);
        $sql1->execute();

        $conn->commit();
        echo "Student ID Updated.";
    } catch (Exception $e) {
        $conn->rollback();
        echo $e->getMessage();

    }

}
$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <form action="" method="post">
    <h1 >Add Student Record</h1>
        <div class="form-row">
            <div class="input-group">
                <label>Student Number:</label> 
                <input type="text" name="s_number" placeholder="Example:2022-800XX">
            </div>
            <div class="input-group">
                <label>Contact Number:</label>
                <input type="text" name="s_contact" placeholder="Example:09XXXXXX">
            </div>
        </div>

        <div class="form-row">
            <div class="input-group">
                <label>First Name:</label>
                <input type="text" name="s_fn" placeholder="Enter first Name">
            </div>
            <div class="input-group">
                <label>Street Name:</label>
                <input type="text" name="s_street" placeholder="Enter Street Name">
            </div>
        </div>

        <div class="form-row">
            <div class="input-group">
                <label>Middle Name:</label>
                <input type="text" name="s_mn" placeholder="Enter Middle Name">
            </div>
            <div class="input-group">
                <label>Town Name (Int):</label>
                <input type="text" name="s_town" placeholder="Town in integer">
            </div>
        </div>
        
        <div class="form-row">
            <div class="input-group">
                <label>Last Name:</label>
                <input type="text" name="s_ln" placeholder="Enter Last Name">
            </div>
            <div class="input-group">
                <label>Province Name (Int):</label>
                <input type="text" name="s_province" placeholder="Provice in integer"> 
            </div>
        </div>
        <div class="form-row">
            <div class="input-group">
                <label>Gender (int):</label>
                <input type="text" name="s_gender" placeholder="Male[0] Female[1]">
            </div>
            <div class="input-group">
                <label>Zip Code:</label>
                <input type="text" name="s_zipcode" placeholder="Enter Zip Code">
            </div>
        </div>
        <div>
            <label class="center">Birthday:</label>
            <input type="date" name="s_birthday">

            <button type="submit" name="submit"> Submit </button>
        </div>
    <!-- changing ID  -->
    <form action="" method="post">
        <div>
            <label>Old Student ID </label><input type="text" name="old"><br><br>
            <label>New Student ID </label><input type="text" name="New"><br><br>
            <button type="submit" name="update">Update</button>
        </div>
</body> </html>
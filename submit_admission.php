<?php
include 'db_connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect and sanitize input data
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $education_level = $conn->real_escape_string($_POST['Education_Level']);
    $index_number = $conn->real_escape_string($_POST['index_Number']);

    // Handle multiple course selections (join them into one string)
    if (isset($_POST['course']) && is_array($_POST['course'])) {
        $courses = implode(", ", array_map([$conn, 'real_escape_string'], $_POST['course']));
    } else {
        $courses = '';
    }

    // Insert data into admissions table
    $sql = "INSERT INTO admissions (fullname, email, phone, course, Education_Level, Index_Number)
            VALUES ('$fullname', '$email', '$phone', '$courses', '$education_level', '$index_number')";

    if ($conn->query($sql) === TRUE) {
        echo "
        <script>
            alert('🎉 Admission Form Submitted Successfully!');
            window.location.href = 'admission.html';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('❌ Error submitting form: " . addslashes($conn->error) . "');
            window.history.back();
        </script>
        ";
    }
}

$conn->close();
?>

<?php
include 'config/db.php';

echo '
<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <style>body { font-family: "Inter", sans-serif; }</style>
</head>
<body>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name  = mysqli_real_escape_string($conn, $_POST['full_name']);
    $dob        = $_POST['dob'];
    $nrc        = mysqli_real_escape_string($conn, $_POST['nrc']);
    $address    = mysqli_real_escape_string($conn, $_POST['address']);
    $gender     = $_POST['gender'] ?? '';
    $religion   = mysqli_real_escape_string($conn, $_POST['religion']);
    $race       = mysqli_real_escape_string($conn, $_POST['race']);
    $phone      = mysqli_real_escape_string($conn, $_POST['phone']);
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $position   = mysqli_real_escape_string($conn, $_POST['position']);
    $salary     = mysqli_real_escape_string($conn, $_POST['expected_salary']);
    $education  = mysqli_real_escape_string($conn, $_POST['education_background']);
    $experience = mysqli_real_escape_string($conn, $_POST['work_experience']);
    $languages  = mysqli_real_escape_string($conn, $_POST['foreign_languages']);
    $skills     = mysqli_real_escape_string($conn, $_POST['technical_skills']);

    $current_year = date('Y');
    $check_query = "SELECT id FROM applicants WHERE (email = '$email' OR phone = '$phone') AND YEAR(applied_at) = '$current_year' LIMIT 1";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Duplicate Application',
                text: 'သင်သည် ယခုနှစ် (2026) အတွက် လျှောက်ထားပြီးဖြစ်ပါသည်။ တစ်နှစ်လျှင် တစ်ကြိမ်သာ လက်ခံပါသည်။',
                confirmButtonColor: '#4f46e5'
            }).then(() => { window.history.back(); });
        </script>";
        exit();
    }

    $targetDir = "uploads/";
    if (!is_dir($targetDir)) { mkdir($targetDir, 0777, true); }

    $fileExt = strtolower(pathinfo($_FILES["resume"]["name"], PATHINFO_EXTENSION));
    $fileName = "CV_" . time() . "_" . preg_replace('/[^A-Za-z0-9]/', '_', $full_name) . "." . $fileExt;
    $targetPath = $targetDir . $fileName;

    if ($fileExt == "pdf") {
        if (move_uploaded_file($_FILES["resume"]["tmp_name"], $targetPath)) {

            $sql = "INSERT INTO applicants (full_name, dob, nrc, address, gender, religion, race, phone, email, position, expected_salary, education_background, work_experience, foreign_languages, technical_skills, resume_path) 
                    VALUES ('$full_name', '$dob', '$nrc', '$address', '$gender', '$religion', '$race', '$phone', '$email', '$position', '$salary', '$education', '$experience', '$languages', '$skills', '$fileName')";
            
            if(mysqli_query($conn, $sql)) {
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'လျှောက်လွှာတင်ခြင်း အောင်မြင်ပါသည်။',
                        confirmButtonColor: '#4f46e5'
                    }).then(() => { window.location='index.php'; });
                </script>";
            } else {
                echo "<script>Swal.fire('Error', 'DB Error: " . mysqli_error($conn) . "', 'error');</script>";
            }
        } else {
            echo "<script>Swal.fire('Error', 'File upload failed!', 'error');</script>";
        }
    } else {
        echo "<script>Swal.fire('Error', 'PDF ဖိုင်များသာ လက်ခံပါသည်။', 'error');</script>";
    }
}
echo '</body></html>';
?>
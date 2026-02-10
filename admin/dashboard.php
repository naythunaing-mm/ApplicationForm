<?php 
include '../config/db.php'; 

$selected_year = isset($_GET['year']) ? mysqli_real_escape_string($conn, $_GET['year']) : '';

$sql = "SELECT * FROM applicants";
if ($selected_year != '') {
    $sql .= " WHERE YEAR(applied_at) = '$selected_year'";
}
$sql .= " ORDER BY id DESC";

$result = mysqli_query($conn, $sql);
$total_rows = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Being Myanmar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8fafc; font-family: 'Segoe UI', sans-serif; }
        .main-card { background: white; border-radius: 12px; border: 1px solid #e2e8f0; }
        .table thead { background-color: #f1f5f9; border-bottom: 2px solid #e2e8f0; }
        .table thead th { font-size: 0.75rem; text-transform: uppercase; color: #64748b; padding: 15px; }
        .pdf-link { color: #ef4444; font-weight: 600; text-decoration: none; border: 1px solid #fee2e2; padding: 5px 12px; border-radius: 6px; background: #fef2f2; font-size: 0.8rem; }
        .view-btn { color: #4f46e5; background: #eef2ff; border: 1px solid #e0e7ff; padding: 5px 12px; border-radius: 6px; text-decoration: none; font-size: 0.8rem; font-weight: 600; }
        .filter-section { background: #fff; padding: 15px; border-radius: 10px; border: 1px solid #e2e8f0; margin-bottom: 20px; }
    </style>
</head>
<body>

<nav class="navbar navbar-light bg-white border-bottom py-3 mb-4">
    <div class="container">
        <span class="navbar-brand mb-0 h1 fw-bold"><i class="fas fa-briefcase text-primary me-2"></i> Being Myanmar Admin</span>
    </div>
</nav>

<div class="container-fluid px-4">
    <div class="filter-section shadow-sm d-flex justify-content-between align-items-center">
        <form action="" method="GET" class="d-flex align-items-center gap-2">
            <label class="fw-bold text-muted small text-uppercase">Year:</label>
            <select name="year" class="form-select form-select-sm" style="width: 120px;" onchange="this.form.submit()">
                <option value="">All Years</option>
                <?php
                $year_query = mysqli_query($conn, "SELECT DISTINCT YEAR(applied_at) as year FROM applicants ORDER BY year DESC");
                while($y = mysqli_fetch_assoc($year_query)) {
                    $year_val = $y['year'];
                    echo "<option value='$year_val' ".($selected_year == $year_val ? 'selected' : '').">$year_val</option>";
                }
                ?>
            </select>
        </form>
        <h6 class="fw-bold mb-0 text-primary small">Total: <?php echo $total_rows; ?> Applicants</h6>
    </div>

    <div class="main-card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Applied Position</th>
                        <th>Contact</th>
                        <th>Applied Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td>
                            <div class="fw-bold text-dark"><?php echo htmlspecialchars($row['full_name']); ?></div>
                            <div class="text-muted" style="font-size: 0.75rem;"><?php echo htmlspecialchars($row['nrc']); ?></div>
                        </td>
                        <td>
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2">
                                <?php echo htmlspecialchars($row['position']); ?>
                            </span>
                        </td>
                        <td class="small">
                            <div><i class="fas fa-phone me-1 text-muted"></i> <?php echo htmlspecialchars($row['phone']); ?></div>
                            <div><i class="fas fa-envelope me-1 text-muted"></i> <?php echo htmlspecialchars($row['email']); ?></div>
                        </td>
                        <td class="text-muted small"><?php echo date('d M Y', strtotime($row['applied_at'])); ?></td>
                        <td class="text-end">
                            <button class="view-btn me-2 border-0" data-bs-toggle="modal" data-bs-target="#modal<?php echo $row['id']; ?>">
                                <i class="fas fa-eye me-1"></i> DETAILS
                            </button>
                            <a href="../uploads/<?php echo $row['resume_path']; ?>" target="_blank" class="pdf-link">
                                <i class="fas fa-file-pdf me-1"></i> CV
                            </a>
                        </td>
                    </tr>

                    <div class="modal fade" id="modal<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
                                <div class="modal-header border-0 bg-light rounded-top">
                                    <h5 class="modal-title fw-bold">Applicant Full Profile</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <p class="mb-1 text-muted small">Full Name</p>
                                            <h6 class="fw-bold"><?php echo htmlspecialchars($row['full_name']); ?></h6>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1 text-muted small">Applied Position</p>
                                            <h6 class="fw-bold text-primary"><?php echo htmlspecialchars($row['position']); ?></h6>
                                        </div>
                                        <div class="col-md-6 border-top pt-3">
                                            <p class="mb-1 text-muted small text-uppercase">Personal Info</p>
                                            <div class="small"><b>DOB:</b> <?php echo $row['dob']; ?></div>
                                            <div class="small"><b>NRC:</b> <?php echo $row['nrc']; ?></div>
                                            <div class="small"><b>Gender:</b> <?php echo $row['gender']; ?></div>
                                            <div class="small"><b>Religion/Race:</b> <?php echo $row['religion']." / ".$row['race']; ?></div>
                                        </div>
                                        <div class="col-md-6 border-top pt-3">
                                            <p class="mb-1 text-muted small text-uppercase">Contact Info</p>
                                            <div class="small"><b>Email:</b> <?php echo $row['email']; ?></div>
                                            <div class="small"><b>Phone:</b> <?php echo $row['phone']; ?></div>
                                            <div class="small"><b>Address:</b> <?php echo $row['address']; ?></div>
                                        </div>
                                        <div class="col-12 border-top pt-3">
                                            <p class="mb-1 text-muted small text-uppercase">Professional Experience</p>
                                            <div class="small mb-2"><b>Education:</b><br><?php echo nl2br(htmlspecialchars($row['education_background'])); ?></div>
                                            <div class="small mb-2"><b>Experience:</b><br><?php echo nl2br(htmlspecialchars($row['work_experience'])); ?></div>
                                            <div class="small"><b>Expected Salary:</b> <?php echo $row['expected_salary']; ?> MMK</div>
                                            <div class="small"><b>Skills:</b> <?php echo $row['technical_skills']; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-secondary btn-sm rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                                    <a href="../uploads/<?php echo $row['resume_path']; ?>" target="_blank" class="btn btn-danger btn-sm rounded-pill px-4">Open PDF Resume</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
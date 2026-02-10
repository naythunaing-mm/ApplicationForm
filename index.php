<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application | Being Myanmar</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.css" rel="stylesheet">
    
    <style>
        body { background-color: #f1f5f9; font-family: 'Inter', sans-serif; color: #334155; }
        .form-container { max-width: 900px; margin: 40px auto; background: #ffffff; padding: 40px; border-radius: 16px; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05); }
        .section-title { font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #6366f1; margin: 30px 0 20px 0; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px; }
        .form-label { font-weight: 500; font-size: 0.875rem; margin-bottom: 8px; color: #475569; }
        .form-control { border: 1px solid #e2e8f0; padding: 10px 14px; border-radius: 8px; font-size: 0.95rem; }
        .form-control:focus { border-color: #6366f1; box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); }
        .btn-submit { background-color: #4f46e5; color: white; border: none; padding: 14px 40px; border-radius: 8px; font-weight: 600; width: 100%; transition: 0.3s; }
        .btn-submit:hover { background-color: #4338ca; transform: translateY(-2px); }
        .required { color: #ef4444; }
        .upload-box { background-color: #f8fafc; border: 2px dashed #e2e8f0; border-radius: 12px; padding: 25px; text-align: center; }
        .notice-box { background-color: #eef2ff; border: none; border-radius: 12px; }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <div class="text-center mb-5">
            <h3 class="fw-bold mb-1" style="color: #1e293b;">BEING <span style="color: #6366f1;">MYANMAR</span></h3>
            <p class="text-muted">Professional Career Application</p>
        </div>

        <div class="alert notice-box shadow-sm mb-4">
            <div class="d-flex align-items-center p-2">
                <i class="fas fa-info-circle text-primary me-3" style="font-size: 1.5rem;"></i>
                <div>
                    <h6 class="mb-1 fw-bold text-primary">Annual Recruitment Notice</h6>
                    <p class="mb-0 small text-muted">ကျွန်ုပ်တို့ကုမ္ပဏီသည် တစ်နှစ်လျှင် တစ်ကြိမ်သာ အလုပ်ခေါ်ယူလေ့ရှိပါသည်။ သင်၏ အချက်အလက်များကို သေချာစွာ စစ်ဆေးပြီးမှ လျှောက်ထားပေးပါရန် အကြံပြုအပ်ပါသည်။</p>
                </div>
            </div>
        </div>

        <form id="applicationForm" action="submit-application.php" method="POST" enctype="multipart/form-data">
            
            <div class="section-title"><i class="fas fa-user me-2"></i> Personal Information</div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Full Name <span class="required">*</span></label>
                    <input type="text" name="full_name" class="form-control" placeholder="Enter your full name" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date of Birth <span class="required">*</span></label>
                    <input type="date" name="dob" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">NRC Number <span class="required">*</span></label>
                    <input type="text" name="nrc" class="form-control" placeholder="12/MAMANA(N)000000" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Gender <span class="required">*</span></label>
                    <div class="pt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="Male" id="male" required>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="Female" id="female">
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Religion</label>
                    <input type="text" name="religion" class="form-control" placeholder="e.g. Buddhist">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Race</label>
                    <input type="text" name="race" class="form-control" placeholder="e.g. Burmese">
                </div>
            </div>

            <div class="section-title"><i class="fas fa-address-book me-2"></i> Contact Details</div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Phone Number <span class="required">*</span></label>
                    <input type="tel" name="phone" class="form-control" placeholder="09xxxxxxxxx" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email Address <span class="required">*</span></label>
                    <input type="email" name="email" class="form-control" placeholder="yourname@email.com" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Current Address <span class="required">*</span></label>
                    <textarea name="address" class="form-control" rows="2" placeholder="House No, Street, Township, City" required></textarea>
                </div>
            </div>

            <div class="section-title"><i class="fas fa-briefcase me-2"></i> Professional Details</div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Position to be Applied <span class="required">*</span></label>
                    <input type="text" name="position" class="form-control" placeholder="e.g. Web Developer" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Expected Salary (MMK)</label>
                    <input type="text" name="expected_salary" class="form-control" placeholder="e.g. 800,000">
                </div>
                <div class="col-12">
                    <label class="form-label">Education Background <span class="required">*</span></label>
                    <textarea name="education_background" class="form-control" rows="3" placeholder="Major, University, Year" required></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Work Experience</label>
                    <textarea name="work_experience" class="form-control" rows="3" placeholder="Previous companies and roles"></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Foreign Languages</label>
                    <input type="text" name="foreign_languages" class="form-control" placeholder="e.g. English, Japanese">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Technical Skills</label>
                    <input type="text" name="technical_skills" class="form-control" placeholder="e.g. PHP, MySQL, Excel">
                </div>
            </div>

            <div class="section-title"><i class="fas fa-file-upload me-2"></i> Documents</div>
            <div class="upload-box mb-5">
                <i class="fas fa-file-pdf text-danger mb-2" style="font-size: 2.5rem;"></i>
                <label class="form-label d-block fw-bold">Attach CV / Resume (PDF Only)</label>
                <input type="file" name="resume" class="form-control mt-3" accept=".pdf" required>
            </div>

            <button type="submit" class="btn-submit shadow">
                Submit Application <i class="fas fa-paper-plane ms-2"></i>
            </button>
        </form>
    </div>
</div>

<footer class="text-center pb-5 text-muted small">
    © Being Myanmar Co., Ltd. All Rights Reserved.
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    $('#applicationForm').on('submit', function(e) {
        if (this.checkValidity()) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Are you sure?',
                text: "သင့်အချက်အလက်များကို သေချာစွာ စစ်ဆေးပြီးပြီလား?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4f46e5',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Submit it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Submitting...',
                        text: 'ကျေးဇူးပြု၍ ခေတ္တစောင့်ဆိုင်းပေးပါ...',
                        allowOutsideClick: false,
                        didOpen: () => { Swal.showLoading(); }
                    });
                    this.submit();
                }
            });
        }
    });
});
</script>

</body>
</html>
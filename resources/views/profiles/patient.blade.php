<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .profile-header {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid white;
        }
        .nav-tabs .nav-link {
            color: #6a11cb;
        }
        .nav-tabs .nav-link.active {
            background-color: #6a11cb;
            color: white;
        }
        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .summary-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        .summary-card h6 {
            color: #6a11cb;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <!-- Profile Header -->
    <div class="profile-header text-center">
        <img src="https://via.placeholder.com/100" alt="Profile Picture" class="profile-pic">
        <h2 class="mt-3">John Doe</h2>
        <p class="mb-0">Patient ID: #123456</p>
        <p>Date of Birth: 01/01/1990</p>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs nav-justified mb-4" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="bio-tab" data-bs-toggle="tab" data-bs-target="#bio" type="button" role="tab" aria-controls="bio" aria-selected="true">Bio</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="appointments-tab" data-bs-toggle="tab" data-bs-target="#appointments" type="button" role="tab" aria-controls="appointments" aria-selected="false">Appointments</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="treatments-tab" data-bs-toggle="tab" data-bs-target="#treatments" type="button" role="tab" aria-controls="treatments" aria-selected="false">Treatments</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab" aria-controls="orders" aria-selected="false">Purchase Orders</button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="myTabContent">
        <!-- Bio Tab -->
        <div class="tab-pane fade show active" id="bio" role="tabpanel" aria-labelledby="bio-tab">
            <div class="row">
                <!-- Left Side: Summary Cards -->
                <div class="col-md-4">
                    <div class="summary-card">
                        <h6>Total Orders</h6>
                        <p class="fs-4">12</p>
                    </div>
                    <div class="summary-card">
                        <h6>Total Treatments</h6>
                        <p class="fs-4">8</p>
                    </div>
                </div>
                <!-- Right Side: Bio Details -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Bio Details</h5>
                            <p><strong>Name:</strong> John Doe</p>
                            <p><strong>Gender:</strong> Male</p>
                            <p><strong>Age:</strong> 33</p>
                            <p><strong>Blood Group:</strong> O+</p>
                            <p><strong>Contact:</strong> +1 234 567 890</p>
                            <p><strong>Email:</strong> john.doe@example.com</p>
                            <p><strong>Address:</strong> 123 Main St, Springfield, IL, USA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointments Tab -->
        <div class="tab-pane fade" id="appointments" role="tabpanel" aria-labelledby="appointments-tab">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Upcoming Appointments</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Date:</strong> 10/10/2023<br>
                            <strong>Doctor:</strong> Dr. Smith<br>
                            <strong>Reason:</strong> Routine Checkup
                        </li>
                        <li class="list-group-item">
                            <strong>Date:</strong> 15/10/2023<br>
                            <strong>Doctor:</strong> Dr. Johnson<br>
                            <strong>Reason:</strong> Follow-up
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Treatments Tab -->
        <div class="tab-pane fade" id="treatments" role="tabpanel" aria-labelledby="treatments-tab">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Last Taken Treatments</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Treatment:</strong> Physical Therapy<br>
                            <strong>Date:</strong> 01/10/2023<br>
                            <strong>Doctor:</strong> Dr. Smith
                        </li>
                        <li class="list-group-item">
                            <strong>Treatment:</strong> Medication<br>
                            <strong>Date:</strong> 25/09/2023<br>
                            <strong>Doctor:</strong> Dr. Johnson
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Purchase Orders Tab -->
        <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Purchase Orders</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Order ID:</strong> #789012<br>
                            <strong>Date:</strong> 05/10/2023<br>
                            <strong>Items:</strong> Prescription Drugs<br>
                            <strong>Total:</strong> $120.00
                        </li>
                        <li class="list-group-item">
                            <strong>Order ID:</strong> #789013<br>
                            <strong>Date:</strong> 10/10/2023<br>
                            <strong>Items:</strong> Medical Supplies<br>
                            <strong>Total:</strong> $80.00
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

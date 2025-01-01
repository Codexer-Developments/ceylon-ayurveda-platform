<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Patient Add</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Search Patient</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Create Patient</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" style="margin-top: 20px">
                                    <input type="text" id="searchInput" class="form-control" placeholder="Search Patient">
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <ol id="patientList" class="list-group list-group">
                                    <div style="text-align:center;color: gray; padding-top: 60px;padding-bottom: 60px;">
                                        <h3>Search Patients</h3>
                                    </div>
                                    <!-- Patient results will appear here -->
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form id="patientForm">
                            <div style="border-style: solid;border-width: 1px;border-radius: 10px;padding: 10px;margin-top: 20px;border-color: gainsboro;">
                                <div class="row" style="margin-top: 30px">
                                    <div class="col-md-4">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" id="patient_first_name" name="first_name">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Middle Name</label>
                                        <input type="text" class="form-control" id="patient_middle_name" name="middle_name">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" id="patient_last_name" name="last_name">
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 30px">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <input type="text" class="form-control" id="patient_email" name="email">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" id="patient_phone_number" name="phone_number">
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 30px">
                                    <div class="col-md-12">
                                        <label>Address</label>
                                        <textarea class="form-control" id="patient_address" name="address"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div style="border-style: solid;border-width: 1px;border-radius: 10px;padding: 10px;margin-top: 20px;border-color: gainsboro;">
                                <div class="row" style="margin-top: 30px">
                                    <div class="col-md-4">
                                        <label>Tax ID</label>
                                        <input type="text" class="form-control" id="patient_tax_id" name="tex_id">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Blood Group</label>
                                        <select type="text" class="form-select" id="patient_blood_group" name="patient_blood_group">
                                            <option value="A Positive">A Positive</option>
                                            <option value="B Positive">B Positive</option>
                                            <option value="AB Positive">AB Positive</option>
                                            <option value="AB Negative">AB Negative</option>
                                            <option value="A Negative">A Negative</option>
                                            <option value="B Negative">B Negative</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Date of birth</label>
                                        <input type="date" class="form-control" id="patient_dob" name="patient_dob">
                                    </div>
                                </div>
                            </div>

                            <div style="border-style: solid;border-width: 1px;border-radius: 10px;padding: 10px;margin-top: 20px;border-color: gainsboro;">
                                <div class="row" style="margin-top: 30px">
                                    <div class="col-md-3">
                                        <label>Insurance ID</label>
                                        <input type="text" class="form-control" id="patient_insurance_id" name="patient_insurance_id">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Insurance Name</label>
                                        <input type="text" class="form-select" id="patient_insurance_name" name="patient_insurance_name">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Insurance Type</label>
                                        <select type="text" class="form-select" id="patient_insurance_type" name="patient_insurance_type">
                                            <option value="Health Insurance">Health Insurance</option>
                                            <option value="Life Insurance">Life Insurance</option>
                                            <option value="Home Insurance">Home Insurance</option>
                                            <option value="Travel Insurance">Travel Insurance</option>
                                            <option value="Business Insurance">Business Insurance</option>
                                            <option value="Critical Illness Insurance">Critical Illness Insurance</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Insurance Group</label>
                                        <select type="text" class="form-select" id="patient_insurance_group" name="insurance_group">
                                            <option value="Aviva Group">Aviva Group</option>
                                            <option value="AXA Group">AXA Group</option>
                                            <option value="Admiral Group">Admiral Group</option>
                                            <option value="Direct Line Group">Direct Line Group</option>
                                            <option value="Legal & General Group">Legal & General Group</option>
                                            <option value="Bupa Group">Bupa Group</option>
                                            <option value="Zurich Group">Zurich Group</option>
                                            <option value="Liverpool Victoria (LV=) Group">Liverpool Victoria (LV=) Group</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="responseMessage" class="mt-3"></div>


                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                            <button type="button" class="btn btn-secondary mt-4" data-bs-dismiss="modal">Close</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#patientForm').on('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            let formData = $(this).serialize(); // Serialize form data

            $.ajax({
                url: '{{url('api/patients')}}', // Replace with your server endpoint
                method: 'POST',
                data: formData,
                success: function (response) {
                    // Handle success
                    $('#responseMessage').html(
                        `<div class="alert alert-success">${response.message}</div>`
                    );

                    patientSelect(response.data.id, response.data.first_name + ' ' + response.data.middle_name + ' ' + response.data.last_name,
                        response.data.address, response.data.email, response.data.phone_number);
                    $('#exampleModal').modal('toggle');
                },
                error: function (xhr) {
                    // Handle error
                    let errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred';
                    $('#responseMessage').html(
                        `<div class="alert alert-danger">${errorMessage}</div>`
                    );
                }
            });
        });
    });
</script>


<script>
    function patientSelect(patientId, patientName, patientAddress, patientEmail, patientPhoneNumber) {
        const audio = new Audio('{{url('sound/blip.mp3')}}'); // Replace with the actual path to your MP3 file
        audio.play();

        $('#patient_id').val(patientId);
        $('#patient_name').val(patientName);
        $('#patient_address').val(patientAddress);
        $('#patient_email').val(patientEmail);
        $('#patient_phone_number').val(patientPhoneNumber);

        $('#exampleModal').modal('hide');
    }

    $(document).ready(function () {
        $('#searchInput').on('input', function () {
            const query = $(this).val();

            // Perform AJAX request if query has at least 3 characters
            if (query.length >= 3) {
                $.ajax({
                    url: '{{ url("api/patients") }}',
                    type: 'GET',
                    data: { query },
                    success: function (data) {
                        let patientList = '';

                        if (data.length > 0) {
                            data.forEach(function (patient) {
                                patientList += `<a href="#" onclick="patientSelect('${patient.id}','${patient.first_name} ${patient.middle_name} ${patient.last_name}','${patient.id}', '${patient.email}','${patient.phone_number}')" class="list-group-item d-flex justify-content-between align-items-start list-group-item-action">
                                                    <div class="ms-2 me-auto">
                                                      <div class="fw-bold">${patient.first_name} ${patient.middle_name} ${patient.last_name}</div>
                                                        ${patient.address}
                                                    </div>
                                                    <span class="badge bg-primary rounded-pill">${patient.email}</span>
                                                  </a>`;
                            });
                        } else {
                            patientList = '<li class="list-group-item">No results found</li>';
                        }

                        $('#patientList').html(patientList);
                    },
                    error: function () {
                        console.error('Error fetching patients.');
                    }
                });
            } else {
                $('#patientList').html('');
            }
        });
    });
</script>

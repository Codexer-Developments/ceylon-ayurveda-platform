<div class="modal fade" id="{{$dialogId}}" tabindex="-1" aria-labelledby="{{$dialogId}}Label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{$dialogId}}Label">{{$dialogTitle}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home{{$dialogId}}" type="button" role="tab" aria-controls="home" aria-selected="true">Search Patient</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile{{$dialogId}}" type="button" role="tab" aria-controls="profile" aria-selected="false">Create Patient</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home{{$dialogId}}" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" style="margin-top: 20px">
                                    <input type="text" id="searchInput{{$dialogId}}" class="form-control" placeholder="Search Patient">
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-12">
                                <ol id="patientList{{$dialogId}}" class="list-group list-group">
                                    <div style="text-align:center;color: gray; padding-top: 60px;padding-bottom: 60px;">
                                        <h3>Search Patients</h3>
                                    </div>
                                    <!-- Patient results will appear here -->
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile{{$dialogId}}" role="tabpanel" aria-labelledby="profile-tab">
                        <form id="patientForm{{$dialogId}}">
                            <div style="border-style: solid;border-width: 1px;border-radius: 10px;padding: 10px;margin-top: 20px;border-color: gainsboro;">
                                <div class="row" style="margin-top: 30px">
                                    <div class="col-md-4">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" id="patient_first_name{{$dialogId}}" name="first_name">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Middle Name</label>
                                        <input type="text" class="form-control" id="patient_middle_name{{$dialogId}}" name="middle_name">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" id="patient_last_name{{$dialogId}}" name="last_name">
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 30px">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <input type="text" class="form-control" id="patient_email{{$dialogId}}" name="email">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" id="patient_phone_number{{$dialogId}}" name="phone_number">
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 30px">
                                    <div class="col-md-12">
                                        <label>Address</label>
                                        <textarea class="form-control" id="patient_address{{$dialogId}}" name="address"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div style="border-style: solid;border-width: 1px;border-radius: 10px;padding: 10px;margin-top: 20px;border-color: gainsboro;">
                                <div class="row" style="margin-top: 30px">
                                    <div class="col-md-4">
                                        <label>Tax ID</label>
                                        <input type="text" class="form-control" id="patient_tax_id{{$dialogId}}" name="tex_id">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Blood Group</label>
                                        <select type="text" class="form-select" id="patient_blood_group{{$dialogId}}" name="patient_blood_group">
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
                                        <input type="date" class="form-control" id="patient_dob{{$dialogId}}" name="patient_dob">
                                    </div>
                                </div>
                            </div>

                            <div style="border-style: solid;border-width: 1px;border-radius: 10px;padding: 10px;margin-top: 20px;border-color: gainsboro;">
                                <div class="row" style="margin-top: 30px">
                                    <div class="col-md-3">
                                        <label>Insurance ID</label>
                                        <input type="text" class="form-control" id="patient_insurance_id{{$dialogId}}" name="patient_insurance_id">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Insurance Name</label>
                                        <input type="text" class="form-select" id="patient_insurance_name{{$dialogId}}" name="patient_insurance_name">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Insurance Type</label>
                                        <select type="text" class="form-select" id="patient_insurance_type{{$dialogId}}" name="patient_insurance_type">
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
                                        <select type="text" class="form-select" id="patient_insurance_group{{$dialogId}}" name="insurance_group">
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
                            <div id="responseMessage{{$dialogId}}" class="mt-3"></div>


                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                            <button type="button" class="btn btn-secondary mt-4" data-bs-dismiss="modal">Close</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#patientForm{{$dialogId}}').on('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            let formData{{$dialogId}} = $(this).serialize(); // Serialize form data

            $.ajax({
                url: '{{url('api/patients')}}', // Replace with your server endpoint
                method: 'POST',
                data: formData{{$dialogId}},
                success: function (response) {
                    // Handle success
                    $('#responseMessage{{$dialogId}}').html(
                        `<div class="alert alert-success">${response.message}</div>`
                    );

                    patientSelect{{$dialogId}}(response.data.id, response.data.first_name + ' ' + response.data.middle_name + ' ' + response.data.last_name,
                        response.data.address, response.data.email, response.data.phone_number);
                    $('#{{$dialogId}}').modal('toggle');
                },
                error: function (xhr) {
                    // Handle error
                    let errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred';
                    $('#responseMessage{{$dialogId}}').html(
                        `<div class="alert alert-danger">${errorMessage}</div>`
                    );
                }
            });
        });
    });
</script>


<script>
    function patientSelect{{$dialogId}}(patientId, patientName, patientAddress, patientEmail, patientPhoneNumber) {
        const audio = new Audio('{{url('sound/blip.mp3')}}'); // Replace with the actual path to your MP3 file
        audio.play();

        $('#{{$updateParameter['inputId']}}').val(patientId);
        $('#{{$updateParameter['inputName']}}').val(patientName);
        $('#{{$updateParameter['inputAddress']}}').val(patientAddress);
        $('#{{$updateParameter['inputEmail']}}').val(patientEmail);
        $('#{{$updateParameter['inputPhone']}}').val(patientPhoneNumber);

        $('#{{$dialogId}}').modal('hide');
    }

    $(document).ready(function () {
        $('#searchInput{{$dialogId}}').on('input', function () {
            const query = $(this).val();

            // Perform AJAX request if query has at least 3 characters
            if (query.length >= 3) {
                $.ajax({
                    url: '{{ url("api/patients") }}',
                    type: 'GET',
                    data: { query },
                    success: function (data) {
                        let patientList{{$dialogId}} = '';

                        if (data.length > 0) {
                            data.forEach(function (patient) {
                                patientList{{$dialogId}} += `<a href="#" onclick="patientSelect{{$dialogId}}('${patient.id}','${patient.first_name} ${patient.middle_name} ${patient.last_name}','${patient.id}', '${patient.email}','${patient.phone_number}')" class="list-group-item d-flex justify-content-between align-items-start list-group-item-action">
                                                    <div class="ms-2 me-auto">
                                                      <div class="fw-bold">${patient.first_name} ${patient.middle_name} ${patient.last_name}</div>
                                                        ${patient.address}
                                                    </div>
                                                    <span class="badge bg-primary rounded-pill">${patient.email}</span>
                                                  </a>`;
                            });
                        } else {
                            patientList{{$dialogId}} = '<li class="list-group-item">No results found</li>';
                        }

                        $('#patientList{{$dialogId}}').html(patientList{{$dialogId}});
                    },
                    error: function () {
                        console.error('Error fetching patients.');
                    }
                });
            } else {
                $('#patientList{{$dialogId}}').html('');
            }
        });
    });
</script>

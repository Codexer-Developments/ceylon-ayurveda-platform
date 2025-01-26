    <style>
        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
        }
        .day {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
        }
        .day:hover {
            background-color: #f0f8ff;
        }
        .day.inactive {
            background-color: #f8f9fa;
            color: #ced4da;
            cursor: not-allowed;
        }
        .day.active {
            background-color: #e3f2fd;
            border-color: #90caf9;
        }
    </style>
</head>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class=" ">
                        <div class="card">
                            <div class="card-header" style="background: #0d6efd;color: white;">
                                Add Appointment
                            </div>
                            <div class="card-body">
                                <div style="margin-bottom: 10px">
                                    <form action="" method="post">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <input type="hidden" id="patient_id_doc_appointment" class="form-control" name="patient_id_doc_appointment">
                                        </div>

                                        <label for="patient_name_doc_appointment">Patient:</label>
                                        <div style="display: flex">
                                            <input type="text" id="patient_name_doc_appointment" name="patient_name_doc_appointment" class="form-control">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#addcustomerdialogposdoc_appoitment" class="btn btn-primary small" style="height: 40px;margin-left: 10px;">+</a>
                                        </div>

                                        <div class="form-group">
                                            <label>Doctor Name</label>
                                            <select name="doctor_id" class="form-select">
                                                @foreach($doctors as $docItem)
                                                    <option value="{{$docItem->id}}">{{$docItem->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" name="center_id" value="{{$center->id}}">

                                        <div class="form-group">
                                            <label for="date">Date:</label>
                                            <input type="date" id="date" name="date" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="time">Time:</label>
                                            <input type="time" id="time" name="time" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Description:</label>
                                            <textarea name="description" rows="5" class="form-control"></textarea>
                                        </div> <br>
                                        <button type="submit" class="btn btn-primary"> Add Appointment</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class=" ">
                <div class="card">
                    <div class="card-header" style="background: #0d6efd;color: white;">
                        Appointments
                    </div>
                    <div class="card-body">

                        <div class="alert alert-info alert-dismissible fade show" role="alert" style="background: gainsboro">
                            You can view appointments by clicking on the dates in the calendar.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class=" ">
                                    <div class="card">
                                        <div class="card-header" style="background: #0d6efd;color: white;">
                                            Appointments
                                        </div>

                                        <ul id="appointmentList" class="list-group">
                                            <div style="text-align: center;font-size: 15px">

                                                <div style="text-align: center;padding-top: 20px;padding-bottom: 30px;font-size: 20px;color: #504f4f;">
                                                    <div style="background: url('{{url('img/calander.png')}}');background-size: cover;width: 100px;height: 100px;margin: auto;background-position: center;margin-bottom: 20px;">

                                                    </div>
                                                    Appointments not found
                                                </div>
                                            </div>
                                            <!-- Appointment details will appear here -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" ">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <button class="btn btn-primary" id="prevMonth">&lt; Previous</button>
                                        <h2 id="currentMonth"></h2>
                                        <button class="btn btn-primary" id="nextMonth">Next &gt;</button>
                                    </div>

                                    <div class="calendar" id="calendar">
                                        <!-- Days of the week -->
                                        <div class="fw-bold">Sun</div>
                                        <div class="fw-bold">Mon</div>
                                        <div class="fw-bold">Tue</div>
                                        <div class="fw-bold">Wed</div>
                                        <div class="fw-bold">Thu</div>
                                        <div class="fw-bold">Fri</div>
                                        <div class="fw-bold">Sat</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>





    </div>
</div>

<script>
    const calendar = document.getElementById('calendar');
    const currentMonthEl = document.getElementById('currentMonth');
    const appointmentList = document.getElementById('appointmentList');

    let currentDate = new Date();

    // Sample appointment data
    const appointments = {
        '2025-01-14': [
            '9:00 AM - Patient A',
            '10:30 AM - Patient B',
            '2:00 PM - Patient C',
            '4:00 PM - Patient D'
        ],
        '2025-01-15': [
            '11:00 AM - Patient E',
            '1:30 PM - Patient F'
        ]
    };

    function renderCalendar() {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();

        currentMonthEl.textContent = `${currentDate.toLocaleString('default', { month: 'long' })} ${year}`;

        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        calendar.innerHTML = `
                <div class="fw-bold">Sun</div>
                <div class="fw-bold">Mon</div>
                <div class="fw-bold">Tue</div>
                <div class="fw-bold">Wed</div>
                <div class="fw-bold">Thu</div>
                <div class="fw-bold">Fri</div>
                <div class="fw-bold">Sat</div>
            `;

        for (let i = 0; i < firstDay; i++) {
            calendar.innerHTML += '<div class="day inactive"></div>';
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const dateKey = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const dayElement = document.createElement('div');
            dayElement.className = 'day';
            dayElement.textContent = day;

            if (appointments[dateKey]) {
                dayElement.classList.add('active');
            }

            dayElement.addEventListener('click', () => {
                displayAppointments(dateKey);
            });

            calendar.appendChild(dayElement);
        }
    }

    function displayAppointments(dateKey) {
        appointmentList.innerHTML = '';
        const dayAppointments = appointments[dateKey] || [`No appointments for this day.`];
        dayAppointments.forEach(appointment => {
            const li = document.createElement('li');
            li.className = 'list-group-item';
            li.textContent = appointment;
            appointmentList.appendChild(li);
        });
    }

    document.getElementById('prevMonth').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    document.getElementById('nextMonth').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    renderCalendar();
</script>

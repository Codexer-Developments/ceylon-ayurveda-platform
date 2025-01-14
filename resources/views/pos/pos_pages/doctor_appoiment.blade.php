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
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="mt-4">
               <div class="card">
                   <div class="card-header" style="background: #0d6efd;color: white;">
                          Appointments
                   </div>
                   <div class="card-body">
                       <ul id="appointmentList" class="list-group">
                           <!-- Appointment details will appear here -->
                       </ul>
                   </div>
               </div>

            </div>
        </div>
        <div class="col-md-8">
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
        const dayAppointments = appointments[dateKey] || ['No appointments for this day.'];
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

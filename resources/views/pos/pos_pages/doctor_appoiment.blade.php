<style>
    .calendar {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 10px;
    }
    .day {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
        cursor: pointer;
        background-color: #f9f9f9;
    }
    .day:hover {
        background-color: #007bff;
        color: white;
    }
    .day.disabled {
        pointer-events: none;
        background-color: #e9ecef;
    }
</style>
</head>
<body>
<div class="container my-5">
    <h1 class="text-center mb-4">Appointment Calendar</h1>

    <!-- Month Navigation -->
    <div class="d-flex justify-content-between mb-4">
        <button class="btn btn-outline-primary" id="prev-month">&lt; Previous</button>
        <h3 id="current-month-year" class="text-center"></h3>
        <button class="btn btn-outline-primary" id="next-month">Next &gt;</button>
    </div>

    <!-- Calendar -->
    <div class="calendar" id="calendar"></div>

    <!-- Selected Date and Time -->
    <div class="mt-4">
        <h4 id="selected-date">Selected Date: None</h4>
        <div class="time-slots d-flex flex-wrap mt-3" id="time-slots"></div>
    </div>

    <!-- Appointment Details -->
    <div class="mt-4">
        <form id="appointment-form">
            <div class="mb-3">
                <label for="customer-name" class="form-label">Customer Name</label>
                <input type="text" id="customer-name" class="form-control" placeholder="Enter your name" required>
            </div>
            <div class="mb-3">
                <label for="appointment-time" class="form-label">Selected Time</label>
                <input type="text" id="appointment-time" class="form-control" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Book Appointment</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const calendarElement = document.getElementById('calendar');
    const timeSlotsElement = document.getElementById('time-slots');
    const selectedDateElement = document.getElementById('selected-date');
    const appointmentTimeInput = document.getElementById('appointment-time');
    const currentMonthYearElement = document.getElementById('current-month-year');
    const prevMonthButton = document.getElementById('prev-month');
    const nextMonthButton = document.getElementById('next-month');

    const timeSlots = ["9:00 AM", "10:00 AM", "11:00 AM", "1:00 PM", "2:00 PM", "3:00 PM"];
    let currentDate = new Date();
    let selectedDate = null;

    // Render calendar for the current month
    function renderCalendar() {
        const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1).getDay();
        const daysInMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();
        const monthName = currentDate.toLocaleString('default', { month: 'long' });
        const year = currentDate.getFullYear();

        calendarElement.innerHTML = "";
        currentMonthYearElement.textContent = `${monthName} ${year}`;

        for (let i = 0; i < firstDay; i++) {
            const blankDay = document.createElement('div');
            blankDay.classList.add('day', 'disabled');
            calendarElement.appendChild(blankDay);
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const dayElement = document.createElement('div');
            dayElement.classList.add('day');
            dayElement.textContent = day;
            dayElement.addEventListener('click', () => selectDate(day));
            calendarElement.appendChild(dayElement);
        }

        fetchAppointmentsForMonth();
    }

    // Select date and fetch appointments
    function selectDate(day) {
        selectedDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), day).toISOString().split('T')[0];
        selectedDateElement.textContent = `Selected Date: ${selectedDate}`;
        fetchAppointmentsForDate();
    }

    // Fetch appointments for the entire month
    function fetchAppointmentsForMonth() {
        const month = currentDate.getMonth() + 1;
        const year = currentDate.getFullYear();

        fetch(`/appointments/month?year=${year}&month=${month}`)
            .then(response => response.json())
            .then(data => {
                highlightBookedDays(data);
            })
            .catch(error => console.error('Error fetching appointments:', error));
    }

    // Highlight booked days in the calendar
    function highlightBookedDays(bookedDays) {
        const days = calendarElement.querySelectorAll('.day');
        days.forEach((dayElement, index) => {
            if (!dayElement.classList.contains('disabled')) {
                const day = index - new Date(currentDate.getFullYear(), currentDate.getMonth(), 1).getDay() + 1;
                if (bookedDays.includes(day)) {
                    dayElement.classList.add('disabled', 'bg-secondary', 'text-white');
                }
            }
        });
    }

    // Fetch appointments for a specific date
    function fetchAppointmentsForDate() {
        fetch(`/appointments?date=${selectedDate}`)
            .then(response => response.json())
            .then(data => {
                renderTimeSlots(data);
            })
            .catch(error => console.error('Error fetching appointments:', error));
    }

    // Render time slots and highlight booked slots
    function renderTimeSlots(bookedSlots) {
        timeSlotsElement.innerHTML = "";

        timeSlots.forEach(slot => {
            const isBooked = bookedSlots.includes(slot);
            const slotElement = document.createElement('button');
            slotElement.classList.add('btn', 'm-2', isBooked ? 'btn-secondary' : 'btn-outline-primary');
            slotElement.textContent = slot;
            slotElement.disabled = isBooked;
            if (!isBooked) {
                slotElement.addEventListener('click', () => selectTime(slot));
            }
            timeSlotsElement.appendChild(slotElement);
        });
    }

    // Select time slot
    function selectTime(slot) {
        appointmentTimeInput.value = slot;
    }

    // Add a new appointment using AJAX
    document.getElementById('appointment-form').addEventListener('submit', (e) => {
        e.preventDefault();
        const customerName = document.getElementById('customer-name').value;
        const selectedTime = appointmentTimeInput.value;

        if (selectedTime) {
            const appointmentData = {
                name: customerName,
                date: selectedDate,
                time: selectedTime
            };

            fetch('/appointments', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(appointmentData)
            })
                .then(response => {
                    if (response.ok) {
                        alert('Appointment booked successfully!');
                        fetchAppointmentsForDate();
                    } else {
                        alert('Failed to book appointment.');
                    }
                })
                .catch(error => console.error('Error booking appointment:', error));
        } else {
            alert('Please select a time slot.');
        }
    });

    // Change month
    prevMonthButton.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    nextMonthButton.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    renderCalendar();
</script>

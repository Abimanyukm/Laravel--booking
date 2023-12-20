<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            margin-top: 15px;
            padding: 15px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(219, 1, 1, 0.1);
        }

        .booking-container {
            text-align: center;
            padding: 103px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        }

        .form-container {
            display: none;
        }
    </style>
</head>

    
<body>

    <div class="booking-container">
        <h2>Booking Page</h2>
        <button onclick="openBookingForm()">Make Slot</button>

        <div class="form-container" id="bookingForm">
            <h3>Booking Form</h3>
            <form id="slotForm" action="{{route('create')}}" method="POST">
                @csrf
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br>

                <label for="date">Date:</label>
                <input type="text" id="date" name="date" required><br>

                <label for="slot">Slot:</label>
                <input type="text" id="slot" name="slot" required><br>
                <!-- You can add more slot-related fields here -->

                <button type="submit">Create Slot</button>
            </form>
        </div>
        <button onclick="fetchAndDisplaySlots()">View Slots</button>
    </div>
    

    <div class="slots-container" id="slotsContainer"></div>
    <!-- Display slots here dynamically -->
    <script>
        function openBookingForm() {
            var formContainer = document.getElementById('bookingForm');
            formContainer.style.display = 'block';
        }

        async function fetchAndDisplaySlots() {
            var slotsContainer = document.getElementById('slotsContainer');
            slotsContainer.innerHTML = ''; // Clear previous content

            try {
                const response = await fetch('/api/slots');

                if (!response.ok) {
                    throw new Error(`Error fetching slots. Status: ${response.status}`);
                }

                const slots = await response.json();

                slots.forEach(slot => {
                    var card = document.createElement('div');
                    card.classList.add('card');

                    card.innerHTML = `
                        <p>Name: ${slot.name}</p>
                        <p>Date: ${slot.date}</p>
                        <p>Slot: ${slot.slot}</p>
                        <p>Status: ${slot.status}</p>
                        ${slot.status === 'available' ? `<button onclick="bookSlot(${slot.id})">BOOK</button>` : ''}
                    `;

                    slotsContainer.appendChild(card);
                });
            } catch (error) {
                console.error('Error fetching slots:', error);
            }
        }


        async function bookSlot(id) {
            try {
                const response = await fetch(`/api/slots/${id}/book`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        status: 'already booked',
                    }),
                });

                if (!response.ok) {
                    throw new Error(`Error booking slot. Status: ${response.status}`);
                }

                const result = await response.json();
                console.log(result.message);
                window.alert('Booking success!');
            } catch (error) {
                console.error('Error booking slot:', error);
            }

            // Refresh the slots after booking
            fetchAndDisplaySlots();
        }
    </script>
    

</body>

</html>

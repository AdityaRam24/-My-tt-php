<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Slot Booking</title>
  <link rel="stylesheet" href="slot.css">
</head>
<body>
    <h1>Book you slots: </h1>
    <br><br>
    <hr>
  <div class="slots-container">
    <!-- Slot 1 -->
    <div class="slot" data-slot-id="1" data-teacher="John Doe" data-subject="Math" data-time="9:00 AM">
      <div class="slot-info">
        <span>Slot 1 - John Doe - Math - 9:00 AM</span>
        <div class="btn-container">
          <button class="enroll-btn">Enroll</button>
          <button class="unenroll-btn">Unenroll</button>
        </div>
      </div>
    </div>
    <!-- Slot 2 -->
    <div class="slot" data-slot-id="2" data-teacher="Jane Smith" data-subject="Science" data-time="10:00 AM">
      <div class="slot-info">
        <span>Slot 2 - Jane Smith - Science - 10:00 AM</span>
        <div class="btn-container">
          <button class="enroll-btn">Enroll</button>
          <button class="unenroll-btn">Unenroll</button>
        </div>
      </div>
    </div>
    <!-- Slot 3 -->
    <div class="slot" data-slot-id="3" data-teacher="Michael Brown" data-subject="English" data-time="11:00 AM">
      <div class="slot-info">
        <span>Slot 3 - Michael Brown - English - 11:00 AM</span>
        <div class="btn-container">
          <button class="enroll-btn">Enroll</button>
          <button class="unenroll-btn">Unenroll</button>
        </div>
      </div>
    </div>
    <!-- Add more slots from Slot 4 to Slot 100 -->
    <!-- Repeat the above slot structure for 97 more slots, incrementing the slot IDs and other data attributes accordingly -->
  </div>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const slots = document.querySelectorAll('.slot');
  
    const bookedSlots = {};
  
    slots.forEach(slot => {
      const slotId = slot.dataset.slotId;
      const time = slot.dataset.time;
      const subject = slot.dataset.subject;
  
      const enrollBtn = slot.querySelector('.enroll-btn');
      const unenrollBtn = slot.querySelector('.unenroll-btn');
  
      enrollBtn.addEventListener('click', function() {
        if (!isSlotBooked(time, subject)) {
          bookSlot(slotId, slot);
        } else {
          showMessage('Slot already booked for this subject or time.');
        }
      });
  
      unenrollBtn.addEventListener('click', function() {
        unbookSlot(slotId, slot);
      });
    });
  
    function isSlotBooked(time, subject) {
      return Object.values(bookedSlots).some(slot => slot.time === time || slot.subject === subject);
    }
  
    function bookSlot(slotId, slot) {
      const teacher = slot.dataset.teacher;
      const subject = slot.dataset.subject;
      const time = slot.dataset.time;
  
      bookedSlots[slotId] = { teacher, subject, time };
      updateSlotStatus(slotId, true);
      showMessage('Slot booked successfully.');
    }
  
    function unbookSlot(slotId, slot) {
      if (slotId && bookedSlots[slotId]) {
        delete bookedSlots[slotId];
        updateSlotStatus(slotId, false);
        showMessage('Slot unbooked successfully.');
      }
    }
  
    function updateSlotStatus(slotId, isBooked) {
      const slot = document.querySelector(`.slot[data-slot-id="${slotId}"]`);
      if (isBooked) {
        slot.classList.add('booked');
      } else {
        slot.classList.remove('booked');
      }
    }
  
    function showMessage(message) {
      alert(message);
    }
  });
  </script>
</body>
</html>

// js/main.js
document.addEventListener('DOMContentLoaded', () => {
  // small enhancements can go here
  // e.g., simple client-side booking date validation
  const bookingForm = document.querySelector('#booking-form');
  if (bookingForm) {
    bookingForm.addEventListener('submit', (e) => {
      const date = bookingForm.querySelector('input[name="appointment_date"]').value;
      if (new Date(date) < new Date().setHours(0,0,0,0)) {
        e.preventDefault();
        alert('Please choose a future appointment date.');
      }
    });
  }
});

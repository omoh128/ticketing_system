// Example JavaScript code
document.addEventListener("DOMContentLoaded", function() {
    // Add event listener to the ticket status update form
    const statusForm = document.getElementById("update_status_form");
    if (statusForm) {
      statusForm.addEventListener("submit", function(event) {
        event.preventDefault();
  
        const ticketId = statusForm.ticket_id.value;
        const newStatus = statusForm.new_status.value;
  
        // You can perform AJAX request here to update the ticket status on the server
        // For the example, we'll just display an alert
        alert(`Ticket ID ${ticketId} status updated to: ${newStatus}`);
      });
    }
  });
  
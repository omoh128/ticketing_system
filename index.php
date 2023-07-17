<?php
require_once 'templates/header.php';

// Load required classes
require_once 'classes/User.php';
require_once 'classes/Ticket.php';
require_once 'classes/TicketingSystem.php';

// Start session (if needed)
session_start();

// Initialize the ticketing system
$ticketingSystem = new TicketingSystem();

// Load ticket data from tickets.json
$ticketsData = file_get_contents('data/tickets.json');
$tickets = json_decode($ticketsData, true);
// Load user data from users.json
$usersData = file_get_contents('data/users.json');
$users = json_decode($usersData, true);


// Check for form submissions and handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add ticket
    if (isset($_POST['submit_ticket'])) {
        $subject = $_POST['subject'];
        $description = $_POST['description'];
        $userEmail = $_POST['user_email'];

        // Find the user in the $users array by email
        $user = null;
        foreach ($users as $userData) {
            if ($userData['email'] === $userEmail) {
                $user = new User($userData['name'], $userData['email']);
                break;
            }
        }

        if ($user === null) {
            // User not found, handle accordingly (e.g., display an error message)
            echo '<script>alert("User not found. Please provide a valid email address.");</script>';
        } else {
            $newTicket = $ticketingSystem->createTicket(time(), $subject, $description, $user);
            // You may save the ticket data to the database here (if implemented)
            // Redirect to ticket list page or display a success message
            echo '<script>alert("Ticket created successfully.");</script>';
        }
    }

    // Update ticket status (for demonstration purposes)
    if (isset($_POST['update_status'])) {
        // Handle ticket status update (similar to previous examples)
    }
}
?>

<!-- Create Ticket Form -->
<h2>Create a New Ticket</h2>
<form action="index.php" method="post">
    <label for="user_name">Your Name:</label>
    <input type="text" id="user_name" name="user_name" required>
    <br>
    <label for="user_email">Your Email:</label>
    <input type="email" id="user_email" name="user_email" required>
    <br>
    <label for="subject">Subject:</label>
    <input type="text" id="subject" name="subject" required>
    <br>
    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea>
    <br>
    <input type="submit" name="submit_ticket" value="Submit Ticket">

</form>

<!-- Display the newly created ticket -->
<?php if (isset($newTicket)): ?>
    <h2>Newly Created Ticket</h2>
    <ul>
        <li>
            <strong>Subject:</strong> <?php echo $newTicket->getSubject(); ?><br>
            <strong>User:</strong> <?php echo $newTicket->getUser()->getName() . ' (' . $newTicket->getUser()->getEmail() . ')'; ?><br>
            <strong>Status:</strong> <?php echo $newTicket->getStatus(); ?><br>
        </li>
    </ul>
<?php endif; ?>

<?php
// Include the footer.php file
require 'templates/footer.php';
?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('inc/db.php');
include('vendor/autoload.php'); // SendGrid için gerekli
include('inc/text.php');
include('inc/whatsapp.php');



function dailyDriverReminder() {
    global $baglanti;
    global $twilio;

    // Set timezone to New York
    date_default_timezone_set('America/New_York');

    // Get the next day's date
    $nextDay = (new DateTime('tomorrow'))->format('Y-m-d');

    // Check if there are any entries for the next day in schedule_requests
    $sql = "SELECT * FROM schedule_requests WHERE date = :nextDay";
    $stmt = $baglanti->prepare($sql);
    $stmt->execute([':nextDay' => $nextDay]);
    $nextDayRequests = $stmt->fetchAll();

    if ($nextDayRequests) {
        // Get all drivers' phone numbers from the users table
        $driverSQL = "SELECT number, username FROM users WHERE perm = 'driver'";
        $driverStmt = $baglanti->prepare($driverSQL);
        $driverStmt->execute();
        $drivers = $driverStmt->fetchAll();

        foreach ($drivers as $driver) {
            $phone_number = "+1" . $driver['number'];
			$name = $driver['username'];

            try {
                // Message content
                $message = "Reminder: Hi " . $name . ". There are scheduled tours for tomorrow. Please check the system for details.";
                
                // Send SMS
                sendTextMessage($twilio, $phone_number, "+16468527935", $message);

                // Send WhatsApp message
                sendWhatsAppMessage($twilio, "whatsapp:" . $phone_number, $message);

                echo "SMS and WhatsApp message sent to driver: $phone_number\n";
            } catch (Exception $e) {
                echo "Error sending message to $phone_number: " . $e->getMessage() . "\n";
            }
        }
    } else {
        echo "No tours scheduled for tomorrow.\n";
    }
}

// To run this function daily at the scheduled time (e.g., 11:55 PM New York time)
// dailyDriverReminder();


?>
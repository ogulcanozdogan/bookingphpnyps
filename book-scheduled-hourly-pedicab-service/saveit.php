<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$dsn = "mysql:host=localhost;dbname=PedicabsScheduled;charset=utf8mb4";
$username = "dashboard";
$password = "Ogulcan07!?!";

try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

function generateUniqueId() {
    return bin2hex(random_bytes(16)); // Unique ID 16 characters long
}

function saveBooking($data, $pdo) {
    try {
        $uniqueId = generateUniqueId();
        $sql = "INSERT INTO temporaryBookings (unique_id, num_passengers, pick_up_address, destination_address, payment_method, pick_up_date, first_name, last_name, email, phone_number, booking_fee, driver_fare, total_fare, ride_duration, return_duration, pick_up_duration, base_fare, service_details, service_duration, hours, minutes, ampm, country_code) 
                VALUES (:unique_id, :num_passengers, :pick_up_address, :destination_address, :payment_method, :pick_up_date, :first_name, :last_name, :email, :phone_number, :booking_fee, :driver_fare, :total_fare, :ride_duration, :return_duration, :pick_up_duration, :base_fare, :service_details, :service_duration, :hours, :minutes, :ampm, :country_code)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':unique_id' => $uniqueId,
            ':num_passengers' => $data['numPassengers'],
            ':pick_up_address' => $data['pickUpAddress'],
            ':destination_address' => $data['destinationAddress'],
            ':payment_method' => $data['paymentMethod'],
            ':pick_up_date' => $data['pickUpDate'],
            ':first_name' => $data['firstName'],
            ':last_name' => $data['lastName'],
            ':email' => $data['email'],
            ':phone_number' => $data['phoneNumber'],
            ':booking_fee' => $data['bookingFee'],
            ':driver_fare' => $data['driverFare'],
            ':total_fare' => $data['totalFare'],
            ':ride_duration' => $data['rideDuration'],
            ':return_duration' => $data['returnDuration'],
            ':pick_up_duration' => $data['pickUpDuration'],
            ':base_fare' => $data['baseFare'],
            ':service_details' => $data['serviceDetails'],
            ':service_duration' => $data['serviceDuration'],
            ':hours' => $data['hours'],
            ':minutes' => $data['minutes'],
            ':ampm' => $data['ampm'],
			':country_code' => $data['countryCode']
        ]);
        return $uniqueId;
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'numPassengers' => $_POST['numPassengers'] ?? 1,
        'pickUpAddress' => $_POST['pickUpAddress'],
        'destinationAddress' => $_POST['destinationAddress'],
        'paymentMethod' => $_POST['paymentMethod'],
        'pickUpDate' => $_POST['pickUpDate'],
        'firstName' => $_POST['firstName'] ?? "",
        'lastName' => $_POST['lastName'] ?? "",
        'email' => $_POST['email'] ?? "",
        'phoneNumber' => $_POST['phoneNumber'] ?? "",
        'bookingFee' => $_POST['bookingFee'] ?? "",
        'driverFare' => $_POST['driverFare'] ?? "",
        'totalFare' => $_POST['totalFare'] ?? "",
        'rideDuration' => $_POST['rideDuration'] ?? "",
        'returnDuration' => $_POST['returnDuration'] ?? "",
        'pickUpDuration' => $_POST['pickUpDuration'] ?? "",
        'baseFare' => $_POST['baseFare'] ?? "",
        'serviceDetails' => $_POST['serviceDetails'] ?? "",
        'serviceDuration' => $_POST['serviceDuration'] ?? "",
        'hours' => $_POST['hours'] ?? "",
        'minutes' => $_POST['minutes'] ?? "",
        'ampm' => $_POST['ampm'] ?? "",
		'countryCode' => $_POST['countryCode'] ?? ""
    ];

    $uniqueId = saveBooking($data, $pdo);
    echo $uniqueId; // Return the unique ID
    exit();
}
?>

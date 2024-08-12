<?php
$dsn = "mysql:host=localhost;dbname=PedicabsOnDemand;charset=utf8mb4";
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
        $sql = "INSERT INTO temporaryBookings (unique_id, num_passengers, pick_up_address, destination_address, payment_method, first_name, last_name, email, phone_number, booking_fee, driver_fare, total_fare, ride_duration, return_duration, operation_fare, pick_up_duration, service_duration, hub, hourly_operation_fare, country_code) 
                VALUES (:unique_id, :num_passengers, :pick_up_address, :destination_address, :payment_method, :first_name, :last_name, :email, :phone_number, :booking_fee, :driver_fare, :total_fare, :ride_duration, :return_duration, :operation_fare, :pick_up_duration, :service_duration, :hub, :hourly_operation_fare, :country_code)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':unique_id' => $uniqueId,
            ':num_passengers' => $data['numPassengers'],
            ':pick_up_address' => $data['pickUpAddress'],
            ':destination_address' => $data['destinationAddress'],
            ':payment_method' => $data['paymentMethod'],
            ':first_name' => $data['firstName'],
            ':last_name' => $data['lastName'],
            ':email' => $data['email'],
            ':phone_number' => $data['phoneNumber'],
            ':booking_fee' => $data['bookingFee'],
            ':driver_fare' => $data['driverFare'],
            ':total_fare' => $data['totalFare'],
            ':ride_duration' => $data['rideDuration'],
            ':return_duration' => $data['returnDuration'],
            ':operation_fare' => $data['operationFare'],
            ':pick_up_duration' => $data['pickUpDuration'],
			':service_duration' => $data['serviceDuration'],
            ':hub' => $data['hub'],
            ':hourly_operation_fare' => $data['hourlyOperationFare'],
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
        'firstName' => $_POST['firstName'] ?? "",
        'lastName' => $_POST['lastName'] ?? "",
        'email' => $_POST['email'] ?? "",
        'phoneNumber' => $_POST['phoneNumber'] ?? "",
        'bookingFee' => $_POST['bookingFee'] ?? "",
        'driverFare' => $_POST['driverFare'] ?? "",
        'totalFare' => $_POST['totalFare'] ?? "",
        'rideDuration' => $_POST['rideDuration'] ?? "",
        'returnDuration' => $_POST['returnDuration'] ?? "",
        'operationFare' => $_POST['operationFare'] ?? "",
        'pickUpDuration' => $_POST['pickUpDuration'] ?? "",
		'serviceDuration' => $_POST['serviceDuration'] ?? "",
        'hub' => $_POST['hub'] ?? "",
        'hourlyOperationFare' => $_POST['hourlyOperationFare'] ?? "",
        'countryCode' => $_POST['countryCode'] ?? ""
    ];

    $uniqueId = saveBooking($data, $pdo);
    echo $uniqueId; // Return the unique ID
    exit();
}
?>

<?php
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
        $sql = "INSERT INTO temporaryBookings (unique_id, num_passengers, pick_up_address, destination_address, payment_method, pick_up_date, first_name, last_name, email, phone_number, booking_fee, driver_fare, total_fare, ride_duration, return_duration, operation_fare, pickup1, pickup2, return1, return2, toursuresi, tour_duration, hours, minutes, ampm, base_fare, country_code) 
                VALUES (:unique_id, :num_passengers, :pick_up_address, :destination_address, :payment_method, :pick_up_date, :first_name, :last_name, :email, :phone_number, :booking_fee, :driver_fare, :total_fare, :ride_duration, :return_duration, :operation_fare, :pickup1, :pickup2, :return1, :return2, :toursuresi, :tour_duration, :hours, :minutes, :ampm, :base_fare, :country_code)";
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
            ':operation_fare' => $data['operationFare'],
            ':pickup1' => $data['pickup1'],
            ':pickup2' => $data['pickup2'],
            ':return1' => $data['return1'],
            ':return2' => $data['return2'],
            ':toursuresi' => $data['toursuresi'],
            ':tour_duration' => $data['tourDuration'],
            ':hours' => $data['hours'],
            ':minutes' => $data['minutes'],
            ':ampm' => $data['ampm'],
            ':base_fare' => $data['baseFare'],
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
        'operationFare' => $_POST['operationFare'] ?? "",
        'pickup1' => $_POST['pickup1'] ?? "",
        'pickup2' => $_POST['pickup2'] ?? "",
        'return1' => $_POST['return1'] ?? "",
        'return2' => $_POST['return2'] ?? "",
        'toursuresi' => $_POST['toursuresi'] ?? "",
        'tourDuration' => $_POST['tourDuration'] ?? "",
        'hours' => $_POST['hours'] ?? "",
        'minutes' => $_POST['minutes'] ?? "",
        'ampm' => $_POST['ampm'] ?? "",
        'baseFare' => $_POST['baseFare'] ?? "",
		'countryCode' => $_POST['countryCode'] ?? ""
    ];

    $uniqueId = saveBooking($data, $pdo);
    echo $uniqueId; // Return unique id
    exit();
}
?>

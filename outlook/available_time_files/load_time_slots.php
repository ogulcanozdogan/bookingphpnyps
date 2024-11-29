<?php
include('../inc/db2.php');

$date = $_POST['date'];
$timeSlots = [
    '10:00 AM' => ['10:15 AM', '10:30 AM', '10:45 AM', '11:00 AM', '11:15 AM'],
    '11:30 AM' => ['11:45 AM', '12:00 PM', '12:15 PM', '12:30 PM', '12:45 PM'],
    '1:00 PM' => ['1:15 PM', '1:30 PM', '1:45 PM', '2:00 PM', '2:15 PM'],
    '2:30 PM' => ['2:45 PM', '3:00 PM', '3:15 PM', '3:30 PM', '3:45 PM'],
    '4:00 PM' => ['4:15 PM', '4:30 PM', '4:45 PM', '5:00 PM', '5:15 PM']
];

$output = '<div class="row">';
foreach ($timeSlots as $timeSlot => $subTimes) {
    $query = $baglanti->prepare('SELECT status FROM unavailable_times WHERE date = ? AND time_slot = ?');
    $query->execute([$date, $timeSlot]);
    $status = $query->fetchColumn();
    $isAvailable = $status !== 'unavailable';

    $btnClass = $isAvailable ? 'btn-success' : 'btn-danger';
    $btnText = $isAvailable ? 'Available' : 'Unavailable';
    $badgeClass = $isAvailable ? 'badge-success' : 'badge-danger';

    // Modern ve mobil uyumlu tasarım
    $output .= '<div class="col-12 col-sm-6 col-md-4 mb-3">';
    $output .= '<div class="card text-center shadow-sm">';
    $output .= '<div class="card-body">';
	$output .= "<h5 class='card-title'><span id='badge-" . str_replace([':', ' '], '', $timeSlot) . "' style='color:black;font-size:130%;' class='badge $badgeClass'><b>{$timeSlot}</b></span></h5>";
	   // Alt saatler için liste ekliyoruz
    $output .= '<ul class="list-unstyled mt-3">';
    foreach ($subTimes as $subTime) {
        $output .= "<li>Include {$subTime}</li>";
    }
    $output .= '</ul>';

    $output .= "<button id='btn-" . str_replace([':', ' '], '', $timeSlot) . "' class='btn $btnClass w-100 mt-2' onclick=\"toggleAvailability('{$date}', '{$timeSlot}')\" 
                data-toggle='tooltip' title='{$timeSlot} - Click to change status' style='font-size: 16px;'>
              $btnText
                </button>";
    
 
    $output .= '</div>'; // card-body
    $output .= '</div>'; // card
    $output .= '</div>'; // col
}
$output .= '</div>';

echo $output;

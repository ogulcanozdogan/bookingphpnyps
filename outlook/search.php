<?php
include('inc/db.php'); // Veritabanı bağlantısını dahil ediyoruz

try {
    $baglanti = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo 'Bağlantı hatası: ' . $e->getMessage();
    exit;
}

$query = isset($_POST['query']) ? $_POST['query'] : '';

if (!empty($query)) {
    // Arama sorgusu varsa, arama sonuçlarını getirin
    $stmt = $baglanti->prepare("SELECT * FROM schedule_requests WHERE source LIKE :query OR name LIKE :query OR phone_number LIKE :query ORDER BY date");
    $stmt->bindValue(':query', '%' . $query . '%');
    $stmt->execute();
    $records = $stmt->fetchAll();
} else {
    // Sorgu boşsa tüm kayıtları getirin
    $stmt = $baglanti->prepare("SELECT * FROM schedule_requests WHERE status = 'pending' AND sms_issue = 0 ORDER BY date");
    $stmt->execute();
    $records = $stmt->fetchAll();
}

// Kayıtları tablo olarak döndür
foreach ($records as $row) {
    echo "<tr>";
    echo "<td>{$row['source']}</td>";
    echo "<td>{$row['date']}</td>";
    echo "<td>{$row['hours']}:{$row['minutes']} {$row['ampm']}</td>";
    echo "<td>" . ($row['duration'] == 90 ? "90 Minutes" : "1 Hour") . "</td>";
    echo "<td>{$row['num_passengers']}</td>";
    echo "<td>{$row['name']}</td>";
    echo "<td>" . ($row['countryName'] == '' ? "UNITED STATES" : $row['countryName']) . "</td>";
    echo "<td>+{$row['countryCode']}{$row['phone_number']}</td>";
    echo "<td>$" . $row['pay'] . "</td>";
    echo "<td>" . ($row['email_sent'] == 1 ? "Yes" : "Not yet") . "</td>";
    echo "<td>" . ($row['thanks_sent'] == 1 ? "Yes" : "Not yet") . "</td>";
    echo "<td>" . ($row['thankswp_sent'] == 1 ? "Yes" : "Not yet") . "</td>";
    echo "<td>" . ($row['reminder_sent'] == 1 ? "Yes" : "Not yet") . "</td>";
    echo "<td>" . ($row['review_sent'] == 1 ? "Yes" : "Not yet") . "</td>";
    echo "<td>
            <a href='edit.php?id={$row['id']}' class='btn btn-edit btn-sm'>Edit</a>
            <a href='?delete_id={$row['id']}' class='btn btn-delete btn-sm' onclick='return confirm(\"Are you sure?\");'>Delete</a>
          </td>";
    echo "</tr>";
}
?>

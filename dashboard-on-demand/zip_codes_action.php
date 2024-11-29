<?php
include('inc/vt.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $app_id = isset($_POST['app_id']) ? intval($_POST['app_id']) : 1; // Tarayıcıdan gelen app_id

    if ($action == 'load') {
        // Zip kodlarını getir
        $sorgu = $baglanti->prepare("SELECT * FROM zip_codes WHERE app_id = :app_id");
        $sorgu->execute(['app_id' => $app_id]);
        echo '<div class="zip-code-list">';
        while ($row = $sorgu->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="zip-item">';
            echo '<input type="text" class="zip-input" data-id="' . $row['id'] . '" value="' . htmlspecialchars($row['zip_code']) . '">';
            echo '<button class="deleteZip btn btn-sm btn-danger" data-id="' . $row['id'] . '">X</button>';
            echo '</div>';
        }
        echo '</div>';
    }

    if ($action == 'add') {
        // Zip kodu ekle
        $zip_code = $_POST['zip_code'];
        $sorgu = $baglanti->prepare("INSERT INTO zip_codes (zip_code, app_id) VALUES (:zip_code, :app_id)");
        $sorgu->execute(['zip_code' => $zip_code, 'app_id' => $app_id]);
    }

    if ($action == 'update') {
        // Zip kodu güncelle
        $id = intval($_POST['id']);
        $new_zip = $_POST['new_zip'];
        $sorgu = $baglanti->prepare("UPDATE zip_codes SET zip_code = :new_zip WHERE id = :id");
        $sorgu->execute(['new_zip' => $new_zip, 'id' => $id]);
    }

    if ($action == 'delete') {
        // Zip kodu sil
        $id = intval($_POST['id']);
        $sorgu = $baglanti->prepare("DELETE FROM zip_codes WHERE id = :id");
        $sorgu->execute(['id' => $id]);
    }
}

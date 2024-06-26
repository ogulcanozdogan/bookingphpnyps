<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

try {
    // Dosyanın varlığını kontrol edelim
    $serviceAccountFile = __DIR__ . '/config/serviceAccountKey.json';
    if (!file_exists($serviceAccountFile)) {
        throw new Exception('Service account key file not found: ' . $serviceAccountFile);
    }

    // Firebase yapılandırması
    $factory = (new Factory)
        ->withServiceAccount($serviceAccountFile)
        ->withDatabaseUri('https://pedalcappp-default-rtdb.firebaseio.com');

    $database = $factory->createDatabase();

    echo "Firebase'e bağlantı kuruluyor...\n";

    // Örnek veri yazma
    $reference = $database->getReference('connectionTest')->set([
        'd' => '4441231231231231231235',
		        'd1' => 'f',
				        'd2' => 'asd',
						        'd3' => 'd',
								        'd4' => '4441231231231231231235',
										        'd5' => '4441231231231231231235',
												        'd6' => '4441231231231231231235',
														        'd7' => '4441231231231231231235',
																        'd8' => '4441231231231231231235',
																		        'd9' => '4441231231231231231235',
																				        'd11' => '4441231231231231231235',
																						        'd12' => '4441231231231231231235',
																								        'd13' => '4441231231231231231235',
																										        'd14' => '4441231231231231231235',
																												        'd15' => '4441231231231231231235',
																														        'd16' => '4441231231231231231235',
																																
    ]);

    echo "Veri yazıldı.\n";

    // Örnek veri okuma
    $snapshot = $database->getReference('connectionTest')->getSnapshot();
    $value = $snapshot->getValue();

    echo "Bağlantı başarılı: ";
    print_r($value);
} catch (Exception $e) {
    echo 'Hata: ',  $e->getMessage();
}

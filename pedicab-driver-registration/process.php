<?php
require 'vendor/autoload.php';
require 'addons/vt.php';

use setasign\Fpdi\Fpdi;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $driverLicenseFile = $_FILES['driverLicenseFile'];
    $driverFirstName = $_POST['driverFirstName'];
    $driverLastName = $_POST['driverLastName'];
    $driverLicenseNumber = $_POST['driverLicenseNumber'];
    $driverLicenseExpiration = $_POST['driverLicenseExpiration'];
    $driverPhone = $_POST['driverPhone'];
    $driverEmail = $_POST['driverEmail'];
    $driverStreetAddress = $_POST['driverStreetAddress'];
    $driverApartmentNumber = $_POST['driverApartmentNumber'];
    $driverCity = $_POST['driverCity'];
    $driverState = $_POST['driverState'];
    $driverZipCode = $_POST['driverZipCode'];
    $businessName = $_POST['businessName'];
    $businessLicenseNumber = $_POST['businessLicenseNumber'];
    $businessRegistrationNumber = $_POST['businessRegistrationNumber'];
    $businessLicenseExpiration = $_POST['businessLicenseExpiration'];
    $businessPhone = $_POST['businessPhone'];
    $businessEmail = $_POST['businessEmail'];
    $businessStreetAddress = $_POST['businessStreetAddress'];
    $businessApartmentNumber = $_POST['businessApartmentNumber'];
    $businessCity = $_POST['businessCity'];
    $businessState = $_POST['businessState'];
    $businessZipCode = $_POST['businessZipCode'];
    $svgData = $_POST['signature'];
    $uuid = generateUUID();
    $kisauuid = substr($uuid, 0, 16);
	

    if (empty($svgData)) {
        die('No signature data provided.');
    }

    // Decode Base64
    $svgData = base64_decode($svgData);

    // Create 'signs' directory if it doesn't exist
    $signsDir = __DIR__ . '/signs';
    if (!is_dir($signsDir)) {
        mkdir($signsDir, 0777, true);
    }

    // Generate unique filename
    $uniqueFilename = uniqid('signature_', true) . '.svg';
    $svgFilePath = $signsDir . '/' . $uniqueFilename;

    // Save the SVG data to a file
    if (file_put_contents($svgFilePath, $svgData) === false) {
        die('Error saving the signature.');
    }

  //  echo 'Signature saved successfully: ' . $uniqueFilename . "<br>";

    // Convert SVG to PNG using Imagick
    $pngFilePath = $signsDir . '/' . uniqid('signature_', true) . '.png';
    if (!convertSvgToPng($svgFilePath, $pngFilePath)) {
        die('Error converting SVG to PNG.');
    }

   // echo 'PNG file created successfully: ' . $pngFilePath . "<br>";

    // Save the uploaded driver license file
    $driverLicenseFileName = uniqid('license_', true) . '.' . pathinfo($driverLicenseFile['name'], PATHINFO_EXTENSION);
    $driverLicenseFilePath = $signsDir . '/' . $driverLicenseFileName;
    if (!move_uploaded_file($driverLicenseFile['tmp_name'], $driverLicenseFilePath)) {
        die('Error saving the driver license file.');
    }

  //  echo 'Driver license file saved successfully: ' . $driverLicenseFileName . "<br>";
	
    // Generate QR Code
    $qrCode = new QrCode('https://www.newyorkpedicabservices.com/driver/?id='.$kisauuid);
    $writer = new PngWriter();
    $qrCodeData = $writer->write($qrCode)->getString();
    $qrCodeFilePath = $signsDir . '/' . uniqid('qrcode_', true) . '.png';
    file_put_contents($qrCodeFilePath, $qrCodeData);


    // Create a new PDF and add a page
    $pdf = new Fpdi();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
	$pdf->SetTextColor(0, 0, 255);
    $pdf->Cell(0, 10, 'New York Pedicab Services', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 14);
	$pdf->SetTextColor(255, 0, 0);
    $pdf->Cell(0, 10, 'Pedicab Driver Registration', 0, 1, 'C');
	
	$pdf->Image($qrCodeFilePath, 160, 10, 25, 25); // x, y, width, height
	
	$lineHeight = 9;
    // Add form data to PDF
	$pdf->Ln(5);
    $pdf->SetFont('Arial', '', 12);
	$pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(0, $lineHeight, 'Pedicab Driver Information:', 0, 1);
    $pdf->Cell(50, $lineHeight, 'Dashboard Identification:');
    $pdf->Cell(50, $lineHeight, $kisauuid, 0, 1);
    $pdf->Cell(50, $lineHeight, 'First Name:');
    $pdf->Cell(50, $lineHeight, $driverFirstName, 0, 1);
    $pdf->Cell(50, $lineHeight, 'Last Name:');
    $pdf->Cell(50, $lineHeight, $driverLastName, 0, 1);
    $pdf->Cell(50, $lineHeight, 'License Number:');
    $pdf->Cell(50, $lineHeight, $driverLicenseNumber, 0, 1);
    $pdf->Cell(50, $lineHeight, 'License Expiration:');
    $pdf->Cell(50, $lineHeight, $driverLicenseExpiration, 0, 1);
    $pdf->Cell(50, $lineHeight, 'Phone:');
    $pdf->Cell(50, $lineHeight, $driverPhone, 0, 1);
    $pdf->Cell(50, $lineHeight, 'Email:');
    $pdf->Cell(50, $lineHeight, $driverEmail, 0, 1);
    $pdf->Cell(50, $lineHeight, 'Street Address:');
    $pdf->Cell(50, $lineHeight, $driverStreetAddress, 0, 1);
    $pdf->Cell(50, $lineHeight, 'Apartment Number:');
    $pdf->Cell(50, $lineHeight, $driverApartmentNumber, 0, 1);
    $pdf->Cell(50, $lineHeight, 'City:');
    $pdf->Cell(50, $lineHeight, $driverCity, 0, 1);
    $pdf->Cell(50, $lineHeight, 'State:');
    $pdf->Cell(50, $lineHeight, $driverState, 0, 1);
    $pdf->Cell(50, $lineHeight, 'Zip Code:');
    $pdf->Cell(50, $lineHeight, $driverZipCode, 0, 1);

    $pdf->Ln(5);
    $pdf->Cell(0, $lineHeight, 'Pedicab Business Information:', 0, 1);
    $pdf->Cell(50, $lineHeight, 'Business Name:');
    $pdf->Cell(50, $lineHeight, $businessName, 0, 1);
    $pdf->Cell(50, $lineHeight, 'License Number:');
    $pdf->Cell(50, $lineHeight, $businessLicenseNumber, 0, 1);
    $pdf->Cell(50, $lineHeight, 'Registration Number:');
    $pdf->Cell(50, $lineHeight, $businessRegistrationNumber, 0, 1);
    $pdf->Cell(50, $lineHeight, 'License Expiration:');
    $pdf->Cell(50, $lineHeight, $businessLicenseExpiration, 0, 1);
    $pdf->Cell(50, $lineHeight, 'Phone:');
    $pdf->Cell(50, $lineHeight, $businessPhone, 0, 1);
    $pdf->Cell(50, $lineHeight, 'Email:');
    $pdf->Cell(50, $lineHeight, $businessEmail, 0, 1);
    $pdf->Cell(50, $lineHeight, 'Street Address:');
    $pdf->Cell(50, $lineHeight, $businessStreetAddress, 0, 1);
    $pdf->Cell(50, $lineHeight, 'Apartment Number:');
    $pdf->Cell(50, $lineHeight, $businessApartmentNumber, 0, 1);
    $pdf->Cell(50, $lineHeight, 'City:');
    $pdf->Cell(50, $lineHeight, $businessCity, 0, 1);
    $pdf->Cell(50, $lineHeight, 'State:');
    $pdf->Cell(50, $lineHeight, $businessState, 0, 1);
    $pdf->Cell(50, $lineHeight, 'Zip Code:');
    $pdf->Cell(50, $lineHeight, $businessZipCode, 0, 1);

    $pdf->Ln(10);
    $pdf->Cell(0, $lineHeight, 'Declaration:', 0, 1);

    $declarations = [
        'I am a licensed pedicab driver and I operate a licensed pedicab with a valid insurance.',
        'I provided the true details of my pedicab driver license and the licensed pedicab that I operate above.',
        'I will never operate without a valid pedicab driver license.',
        'I will never operate without a licensed and insured pedicab.',
        'I will notify Ibrahim Donmez and New York Pedicab Services if my pedicab driver license details change.',
        'I will notify Ibrahim Donmez and New York Pedicab Services if I do not renew my pedicab driver license before its expiration date.',
        'I will notify Ibrahim Donmez and New York Pedicab Services if my pedicab business license details change.',
        'I will notify Ibrahim Donmez and New York Pedicab Services if the pedicab business license that I operate with does not get renewed before its expiration date.',
        'I agree to indemnify, defend and hold harmless Ibrahim Donmez and New York Pedicab Services from any and all claims and/or lawsuits for personal injury (including death) and property damage, and all damages, liabilities, losses, expenses and costs, including reasonable attorneys\' fees, incurred in connection with any claims (including, but not limited to, claims of negligence) arising out of or related in any way to all pedicab services that I provide.',
        'I acknowledge that this agreement may be executed in any number of counterparts and each such counterpart shall for all purposes be deemed an original. Delivery of an executed counterpart of a signature page to this agreement by facsimile, pdf or electronic signature shall be as effective as delivery of a manually executed counterpart of this Agreement.'
    ];

    foreach ($declarations as $index => $declaration) {
        $pdf->Cell($lineHeight, 5, '[X]', 0, 0);
        $pdf->MultiCell(0, 5, ($index + 1) . '. ' . $declaration, 0, 1);
    }

    $pdf->Ln(5);
    $pdf->Cell(15); // Sola yaslanmış isim için boşluk ekleyerek sağa çekiyoruz
    $pdf->Cell(0, $lineHeight, $driverFirstName . ' ' . $driverLastName, 0, 1, 'L');

    // Add the PNG signature to the PDF
    $x = 10; // Sola yaslamak için x değerini değiştirdik
    $y = $pdf->GetY() - 2; // İmzanın daha yakın olması için 2 piksel ekliyoruz.
    $width = 50;
    $height = 25;

    $pdf->Image($pngFilePath, $x, $y, $width, $height); // x, y, width, height

    // Add the driver license image to the PDF
    $pdf->Ln(30); // İmza ile ehliyet fotoğrafı arasına boşluk bırakıyoruz
    $pdf->Cell(0, 10, 'Driver License:', 0, 1);
    $licenseX = 10;
    $licenseY = $pdf->GetY();
    $licenseWidth = 80; // Ehliyet fotoğrafı genişliği
    $licenseHeight = 40; // Ehliyet fotoğrafı yüksekliği

    $pdf->Image($driverLicenseFilePath, $licenseX, $licenseY, $licenseWidth, $licenseHeight);


	$uniqidpdf = uniqid('output_', true);
    // Save the PDF
    $pdfFilePath = $signsDir . '/' . $uniqidpdf . '.pdf';
    $pdf->Output('F', $pdfFilePath);

    echo 'PDF successfully created and signature placed.' . "<br>";
    echo 'PDF file path: ' . $pdfFilePath . "<br>";

    // Remove the temporary PNG file
    unlink($pngFilePath);

    echo 'Temporary PNG file removed.' . "<br>";
	$uniqidpdf = $uniqidpdf . ".pdf";
	header("location: signs/" . $uniqidpdf); 
	
	
	
$satir = [
    "driverLicenseFile" => $driverLicenseFileName,
    "driverFirstName" => $driverFirstName,
    "driverLastName" => $driverLastName,
    "driverLicenseNumber" => $driverLicenseNumber,
    "driverLicenseExpiration" => $driverLicenseExpiration,
    "driverPhone" => $driverPhone,
    "driverEmail" => $driverEmail,
    "driverStreetAddress" => $driverStreetAddress,
    "driverApartmentNumber" => $driverApartmentNumber,
    "driverCity" => $driverCity,
    "driverState" => $driverState,
    "driverZipCode" => $driverZipCode,
    "businessName" => $businessName,
    "businessLicenseNumber" => $businessLicenseNumber,
    "businessRegistrationNumber" => $businessRegistrationNumber,
    "businessLicenseExpiration" => $businessLicenseExpiration,
    "businessPhone" => $businessPhone,
    "businessEmail" => $businessEmail,
    "businessStreetAddress" => $businessStreetAddress,
    "businessApartmentNumber" => $businessApartmentNumber,
    "businessCity" => $businessCity,
    "businessState" => $businessState,
    "businessZipCode" => $businessZipCode,
    "signature_svg" => $uniqueFilename,
    "uuid" => $kisauuid,
    "pdf_link" => $uniqidpdf,	
	
];

$sql = "INSERT INTO registration (id, driverLicenseFile, driverFirstName, driverLastName, driverLicenseNumber, driverLicenseExpiration, driverPhone, driverEmail, driverStreetAddress, driverApartmentNumber, driverCity, driverState, driverZipCode, businessName, businessLicenseNumber, businessRegistrationNumber, businessLicenseExpiration, businessPhone, businessEmail, businessStreetAddress, businessApartmentNumber, businessCity, businessState, businessZipCode, signature_svg, pdf_link) 
VALUES ('$kisauuid', '$driverLicenseFileName', '$driverFirstName', '$driverLastName', '$driverLicenseNumber', '$driverLicenseExpiration', '$driverPhone', '$driverEmail', '$driverStreetAddress', '$driverApartmentNumber', '$driverCity', '$driverState', '$driverZipCode', '$businessName', '$businessLicenseNumber', '$businessRegistrationNumber', '$businessLicenseExpiration', '$businessPhone', '$businessEmail', '$businessStreetAddress', '$businessApartmentNumber', '$businessCity', '$businessState', '$businessZipCode', '$uniqueFilename', '$uniqidpdf')";

$durum = $baglanti->prepare($sql)->execute();


    if ($durum) {
		
		       // First email
        $email1 = new \SendGrid\Mail\Mail();
        $email1->setFrom("info@newyorkpedicabservices.com", "NYPS");
        $email1->setSubject(
            "Pedicab Driver Registration - " . $driverFirstName . " " . $driverLastName
        );
        $email1->addTo("info@newyorkpedicabservices.com", "NYPS");

        $htmlContent1 = <<<EOD
<html>
<body>
    <h1>Pedicab Driver Registration - $driverFirstName $driverLastName</h1>
   
</body>
</html>
EOD;
        


		$dosyaadi = $driverFirstName . "-" . $driverLastName . "-" . $kisauuid . ".pdf";
        $email1->addContent("text/html", $htmlContent1);
		
		 $email1->addAttachment(
            file_get_contents($pdfFilePath),
            "application/pdf",
            $dosyaadi,
            "attachment"
        );
		
		
			       // second email
        $email2 = new \SendGrid\Mail\Mail();
        $email2->setFrom("info@newyorkpedicabservices.com", "NYPS");
        $email2->setSubject(
            "New York Pedicab Services Registration” - " . $driverFirstName . " " . $driverLastName
        );
        $email2->addTo($driverEmail, $driverFirstName . " " . $driverLastName);

        $htmlContent2 = <<<EOD
<html>
<body>
    <h1>Pedicab Driver Registration - $driverFirstName $driverLastName</h1>
    <p>Thank you for registering with New York Pedicab Services.</p>
	<p>Attached is your services agreement with New York Pedicab Services.</p>
	<p>Thank you,</p>
	<p>New York Pedicab Services</p>
	<p>(212) 961-7435</p>
	<p>info@newyorkpedicabservices.com</p>
</body>
</html>
EOD;
        }

        $email2->addContent("text/html", $htmlContent2);
		
		 $email2->addAttachment(
            file_get_contents($pdfFilePath),
            "application/pdf",
            $dosyaadi,
            "attachment"
        );
 // SendGrid API key
        $sendgrid = new \SendGrid(
            "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"
        );

        try {
            // Send the first email
            $response1 = $sendgrid->send($email1);
            // print $response1->statusCode() . "\n";
            //print_r($response1->headers());
            // print $response1->body() . "\n";

            // Send the second email
           $response2 = $sendgrid->send($email2);
            // print $response2->statusCode() . "\n";
            // print_r($response2->headers());
            // print $response2->body() . "\n";
        } catch (Exception $e) {
            // echo 'Caught exception: '. $e->getMessage() ."\n";
        }
		
		
	}

 else {
    header("location: index.php");
}

function convertSvgToPng($svgFilePath, $pngFilePath) {
    try {
        $imagick = new Imagick();
        $imagick->setBackgroundColor(new ImagickPixel('transparent'));
        $imagick->readImageBlob(file_get_contents($svgFilePath));
        $imagick->setImageFormat("png24");
        $imagick->writeImage($pngFilePath);
        $imagick->clear();
        $imagick->destroy();
        return true;
    } catch (Exception $e) {
        echo 'Error: ', $e->getMessage(), "<br>";
        return false;
    }
}
?>
   <?php
$countryArray = array(
	'US'=>array('name'=>'UNITED STATES','code'=>'1')
);
function countrySelector($defaultCountry = "", $id = "", $name = "", $classes = ""){
    global $countryArray; // Assuming the array is placed above this function
    
    // Eğer GET veya POST verisi varsa countryName değişkenini belirle
    $countryNameValue = 'UNITED STATES';
    if (isset($_GET['countryName']) && !empty($_GET['countryName'])) {
        $countryNameValue = $_GET['countryName'];
    } elseif (isset($_POST['countryName']) && !empty($_POST['countryName'])) {
        $countryNameValue = $_POST['countryName'];
    }

    $output = "<select style='width:35%;' class='form-control phone-number-input " . $classes . "' id='" . $id . "' name='countryCode' onchange='updateCountryName(this)'>";
    
    foreach($countryArray as $code => $country){
        $countryName = ucwords(strtolower($country["name"])); // Making it look good
        
        $selected = ''; // Initialize selected variable
        
        // Eğer GET veya POST verisi varsa ve bu ülke kodu ile adı eşleşiyorsa seçili yap
        if ((isset($_GET['countryCode']) && !empty($_GET['countryCode']) && isset($_GET['countryName']) && !empty($_GET['countryName'])) || 
            (isset($_POST['countryCode']) && !empty($_POST['countryCode']) && isset($_POST['countryName']) && !empty($_POST['countryName']))) {
            $countryCode = isset($_POST['countryCode']) ? $_POST['countryCode'] : (isset($_GET['countryCode']) ? $_GET['countryCode'] : '');
            $countryNameInput = isset($_POST['countryName']) ? $_POST['countryName'] : (isset($_GET['countryName']) ? $_GET['countryName'] : '');

            $selected = ($countryCode == $country["code"] && $countryNameInput == $country["name"]) ? 'selected' : '';
        } else {
            $selected = ($countryName == 'United States') ? 'selected' : '';
        }
        
        $output .= "<option " . $selected . " value='" . $country["code"] . "' data-country-name='" . $country["name"] . "'>(+" . $country["code"] . ") " . $countryName . " </option>";
    }
    
    $output .= "</select>";
    $output .= "<input type='hidden' id='" . $id . "_name' name='countryName' value='" . htmlspecialchars($countryNameValue, ENT_QUOTES) . "'>";

    $output .= "<script>
    function updateCountryName(selectElement) {
        var countryNameInput = document.getElementById(selectElement.id + '_name');
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        countryNameInput.value = selectedOption.getAttribute('data-country-name');
    }
    </script>";
    
    return $output; // or echo $output; to print directly
}

?>
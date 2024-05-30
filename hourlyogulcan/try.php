<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adres Önerisi</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Adres Önerisi</h2>
        <div class="form-group">
            <label for="pickUpAddress">Pick Up Address:</label>
            <input type="text" class="form-control" id="pickUpAddress" name="pickUpAddress">
            <div id="pickUpSuggestions"></div>
        </div>
        <div class="form-group">
            <label for="destinationAddress">Destination Address:</label>
            <input type="text" class="form-control" id="destinationAddress" name="destinationAddress">
            <div id="destinationSuggestions"></div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#pickUpAddress, #destinationAddress').keyup(function(){
                var user_input = $(this).val();
                var target_div_id = $(this).attr('id') + 'Suggestions';
                $.ajax({
                    url: 'suggest_address.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {address: user_input},
                    success: function(response){
                        $('#' + target_div_id).html(response);
                    }
                });
            });
        });
    </script>
</body>
</html>

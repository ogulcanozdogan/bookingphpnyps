<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adımlı Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* İleri ve geri butonları sadece ilgili adımlarda görünsün */
        .step:not(:target) {
            display: none;
        }
    </style>
</head>
<body>
    <!-- İlk adım -->
    <div id="step1" class="step">
        <form method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <!-- İleri butonu -->
            <button type="button" id="next1">İleri</button>
        </form>
    </div>

    <!-- İkinci adım -->
    <div id="step2" class="step">
        <form method="post">
            <!-- Geri butonu -->
            <button type="button" id="back2">Geri</button>
            <!-- İleri butonu -->
            <button type="button" id="next2">İleri</button>
        </form>
    </div>

    <!-- Üçüncü adım -->
    <div id="step3" class="step">
        <form method="post">
            <!-- Geri butonu -->
            <button type="button" id="back3">Geri</button>
            <!-- Sonuçları göster -->
            <h2>Gönderilen Veriler:</h2>
            <p id="result_name"></p>
            <p id="result_email"></p>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // İleri butonlarına tıklandığında bir sonraki adımı göster
            $('#next1').click(function() {
                var currentStep = $(this).closest('.step');
                var nextStep = currentStep.next('.step');
                currentStep.hide();
                nextStep.show();
            });

            // Geri butonlarına tıklandığında bir önceki adımı göster
            $('#back2').click(function() {
                var currentStep = $(this).closest('.step');
                var prevStep = currentStep.prev('.step');
                currentStep.hide();
                prevStep.show();
            });

            $('#next2').click(function() {
                var name = $('#name').val();
                var email = $('#email').val();
                $('#result_name').text('Name: ' + name);
                $('#result_email').text('Email: ' + email);
            });
        });
    </script>
</body>
</html>

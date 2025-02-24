<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Style -->
    <link rel="stylesheet" href="app.css">

    <!-- ExcaliFont -->
    <link href='Virgil.woff2' rel='stylesheet' type='text/css'>
</head>

<body>
    <div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="calculator card rounded border-0 shadow-sm">
            <input type="text" name="calculator-screen" id="calculator-screen" class="calculator-screen border-0 form-control mb-3 text-end" disabled>
            <div class="row m-0 gap-2">
                <button onclick="clearScreen()" class="calculator-function calculator-button shadow-sm">AC</button>
                <button onclick="deleteNumber()" class="calculator-function calculator-button shadow-sm">←</button>
                <button onclick="addToScreen('%')" class="calculator-function calculator-button shadow-sm">%</button>
                <button onclick="addToScreen('/')" class="calculator-function calculator-button shadow-sm">/</button>
                <button onclick="addToScreen('7')" class="calculator-button shadow-sm">7</button>
                <button onclick="addToScreen('8')" class="calculator-button shadow-sm">8</button>
                <button onclick="addToScreen('9')" class="calculator-button shadow-sm">9</button>
                <button onclick="addToScreen('*')" class="calculator-function calculator-button shadow-sm">x</button>
                <button onclick="addToScreen('4')" class="calculator-button shadow-sm">4</button>
                <button onclick="addToScreen('5')" class="calculator-button shadow-sm">5</button>
                <button onclick="addToScreen('6')" class="calculator-button shadow-sm">6</button>
                <button onclick="addToScreen('-')" class="calculator-function calculator-button shadow-sm">-</button>
                <button onclick="addToScreen('1')" class="calculator-button shadow-sm">1</button>
                <button onclick="addToScreen('2')" class="calculator-button shadow-sm">2</button>
                <button onclick="addToScreen('3')" class="calculator-button shadow-sm">3</button>
                <button onclick="addToScreen('+')" class="calculator-function calculator-button shadow-sm">+</button>
                <button onclick="addToScreen('00')" class="calculator-button shadow-sm">00</button>
                <button onclick="addToScreen('0')" class="calculator-button shadow-sm">0</button>
                <button onclick="addToScreen('.')" class="calculator-button shadow-sm">.</button>
                <button onclick="calculateResult()" class="calculator-function calculator-equals calculator-button shadow-sm">=</button>
            </div>
        </div>
    </div>

    <script>
        // Global variable to hold the current screen value
        let screenValue = '';

        // Function to add values to the screen
        function addToScreen(value) {
            screenValue += value;
            $('#calculator-screen').val(screenValue);
        }

        // Function to clear the screen
        function clearScreen() {
            screenValue = '';
            $('#calculator-screen').val(screenValue);
        }

        // Function to delete the last character
        function deleteNumber() {
            screenValue = screenValue.slice(0, -1);
            $('#calculator-screen').val(screenValue);
        }

        // Function to handle equal sign and calculate result using AJAX
        function calculateResult() {
            $.ajax({
                url: 'calculate.php',
                type: 'POST',
                data: {
                    expression: screenValue
                },
                success: function(response) {
                    let data = JSON.parse(response);

                    if (data.error) {
                        // If there is an error, show SweetAlert
                        Swal.fire('Error', data.error, 'error');
                    } else if (data.result) {
                        // If the result is valid, show the result on the screen
                        $('#calculator-screen').val(data.result);
                        screenValue = data.result;
                    }
                },
                error: function() {
                    Swal.fire('Error', 'There was an error calculating the result', 'error');
                }
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
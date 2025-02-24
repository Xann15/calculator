<?php

$allowedOperators = [
    "+" => "plus",
    "-" => "minus",
    "*" => "multiply",
    "/" => "divide"
];

$errorMessage = "";
if ($_SERVER['REQUEST_METHOD'] && isset($_POST['calculate'])) {

    $numA = $_POST['numA'];
    $numB = $_POST['numB'];
    $op = $_POST['operator'];


    !in_array($op, array_keys($allowedOperators)) ? $errorMessage = "Operators (" . $op . ") Not Allowed!, please use +, -, *, or /." : "";

    !is_numeric($numA) || !is_numeric($numB) ? $errorMessage = "Only numeric allowed in this operation."  : "";

    if ($numA != "" && $numB != "") {
        switch ($op):
            case ($op == "+"):
                $result = $numA + $numB;
                break;
            case ($op == "-"):
                $result = $numA - $numB;
                break;
            case ($op == "*"):
                $result = $numA * $numB;
                break;
            case ($op == "/"):
                $numB == 0 ? $errorMessage = "Cannot divide number by zeroo.." : $result = $numA / $numB;
                break;
            default:
                $errorMessage = "Unexpected operator error $op."; // ini hanya antisipasi penerapan best practice, ini seharusnya tidak akan pernah tereksekusi
        endswitch;
    } else {
        $errorMessage = "Please make sure all fields are filled..";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Style -->
    <link rel="stylesheet" href="style.css">

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="wrapper">
        <div class="calculator shadow-sm corner">
            <div class="calculator-header text-muted fw-bold">
                <p>Calculator App</p>
            </div>
            <div class="inside">
                <label class="calculator-screen shadow-sm corner <?= $result < 0 ? "text-danger" : "" ?>"><?= isset($result) ? $result : 0 ?></label>

                <form action="" method="post">
                    <div class="calculator-input">
                        <input type="text" name="numA" id="numA" class="form-control border-0 shadow-sm" placeholder="Enter Number A" required>
                        <div class="operator my-3">
                            <?php foreach ($allowedOperators as $symbol => $id): ?>
                                <input type="radio" class="btn-check" value="<?= $symbol ?>" name="operator" id="<?= $id ?>" autocomplete="off" required>
                                <label class="btn btn-outline-dark" for="<?= $id ?>"><?= $symbol ?></label>
                            <?php endforeach; ?>
                        </div>
                        <input type="text" name="numB" id="numB" class="form-control border-0 shadow-sm mb-3" placeholder="Enter Number B" required>
                        <button type="submit" class="btn btn-dark" name="calculate" id="calculate">Calculate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let errorMessage = "<?= $errorMessage ?>"

        if (errorMessage !== "") {
            Swal.fire({
                icon: "error",
                title: "Invalid Input!",
                text: errorMessage,
                footer: "Calculator App",
                timer: 5000
            })
        }
    </script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</body>

</html>
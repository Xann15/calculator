<?php

if (isset($_POST['expression'])) {
    $expression = $_POST['expression'];

    // Sanitize input to avoid security issues
    $expression = preg_replace('/[^0-9+\-\/\*\%\(\)\.\,]/', '', $expression);

    // Check if the expression is empty
    if (empty($expression)) {
        echo json_encode(['error' => 'Input cannot be empty.']);
        exit;
    }

    // Handle division by zero
    if (strpos($expression, '/0') !== false) {
        echo json_encode(['error' => 'Cannot devided by zero..']);
        exit;
    }

    // Calculate the result
    try {
        // Evaluating the expression
        $result = eval('return ' . $expression . ';');
        echo json_encode(['result' => $result]);
    } catch (Exception $e) {
        echo json_encode(['error' => 'Error: Invalid expression.']);
    }
}
?>

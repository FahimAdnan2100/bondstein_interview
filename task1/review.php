<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "review";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $product_id = $_POST['product_id'] ?? '';
    $user_id = $_POST['user_id'] ?? '';
    $review_text = $_POST['review_text'] ?? '';

    // Validate if all fields are present
    if ($product_id !== '' && $user_id !== '' && $review_text !== '') {
        // Validate numerical IDs
        if (is_numeric($product_id) && is_numeric($user_id)) {
            // save data
            $sql = "INSERT INTO reviews (product_id, user_id, review_text) VALUES ('$product_id', '$user_id', '$review_text')";
            if ($conn->query($sql) === true) {
                $response = [
                    'status' => 'success',
                    'message' => 'Review submitted successfully',
                    'product_id' => $product_id,
                    'user_id' => $user_id,
                    'review_text' => $review_text
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                $response = [
                    'status' => 'error',
                    'message' => $conn->error
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        } else {
            // Return error for invalid IDs
            $response = [
                'status' => 'error',
                'message' => "Invalid Numerical IDs"
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    } else {
        // Return error for missing fields
        $response = [
            'status' => 'error',
            'message' => 'Missing required fields: product_id, user_id, review_text'
        ];
        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode($response);
    }
} else {
    // Return error for non-POST requests
    $response = [
        'status' => 'error',
        'message' => 'Only POST requests are allowed for this endpoint'
    ];
    header('Content-Type: application/json');
    http_response_code(405); // Method Not Allowed
    echo json_encode($response);
}

// Close database connection
$conn->close();

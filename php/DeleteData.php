<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "whatsup";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$request = json_decode(file_get_contents('php://input'), true);

if (isset($request['profileId']) && isset($request['newUsername']) && isset($request['newPassword']) && isset($request['confirmPassword'])) {
    $profileId = $request['profileId'];
    $newUsername = $request['newUsername'];
    $newPassword = $request['newPassword'];
    $confirmPassword = $request['confirmPassword'];

    // Update the username and password
    $updateSql = "UPDATE profile_credentials SET Username = '$newUsername', Password = '$newPassword' WHERE ProfileID = '$profileId'";
    $updateResult = $conn->query($updateSql);

    if ($updateResult) {
        echo json_encode(
            array(
                'operation' => 'success',
                'message' => 'Data updated successfully'
            )
        );
    } else {
        echo json_encode(
            array(
                'operation' => 'error',
                'message' => 'Failed to update data'
            )
        );
    }
} else {
    echo json_encode(
        array(
            'operation' => 'error',
            'message' => 'Invalid request. Missing parameters'
        )
    );
}

$conn->close();
?>
bri — 🤙🫰
Briana Jade Adricula
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "whatsup";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$request = json_decode(
    file_get_contents('php://input'),
    true
);

if (isset($request['id'])) {
    $profileID = $request['id'];

    
    $deleteSql = "DELETE FROM profile WHERE ProfileID = '$profileID'";
    $delSql = "DELETE FROM profile_credentials WHERE ProfileID = '$profileID'";
    $deleteResult = $conn->query($deleteSql);
    $delResult = $conn->query($delSql);

    if ($deleteResult && $delResult) {
        echo json_encode(
            array(
                'operation' => 'success',
                'message' => 'Data deleted successfully'
            )
        );
    } else {
        echo json_encode(
            array(
                'operation' => 'error',
                'message' => 'Failed to delete data'
            )
        );
    }
} else {
    echo json_encode(
        array(
            'operation' => 'error',
            'message' => 'Invalid request. Missing ID parameter'
        )
    );
}

$conn->close();
?>
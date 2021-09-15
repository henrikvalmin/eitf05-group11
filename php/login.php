<?php
if (isset($_POST["username"]) and isset($_POST["password"]) and $_POST["username"] != '' and $_POST["password"] != '') {

    $con = mysqli_connect('localhost', 'root', '', 'users') or die("Unable to connect");

    // Prepare statement
    $statement = $con->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $statement->bind_param("ss", $username, $password);

    // Set variables
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Execute statement and store result
    $statement->execute();
    $result = $statement->get_result();

    // Check if user exists, based on result
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        header('Content-Type: application/json');
        echo json_encode($row);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['msg' => "user does not exist"]);
    }
} else {
    $response = [
        'msg' => "Username and password weren't both set."
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}
// --- legacy ---
//     $response = array(
//         'Attempted username' => "$username",
//         'Attempted password' => "$password",
//     );
//     header('Content-Type: application/json');
//     echo json_encode($response);
// } else {
//     $response = [
//         'msg' => "Username and password weren't both set."
//     ];

//     header('Content-Type: application/json');
//     echo json_encode($response);
// }

<?php
if (isset($_POST["username"]) and isset($_POST["password"]) and $_POST["username"] != '' and $_POST["password"] != '') {

    $con = mysqli_connect('localhost', 'root', '', 'plants') or die("Unable to connect");

    // Create a prepared statement
    $statement = $con->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $statement->bind_param("ss", $username, $password);

    // Set variables
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Execute the prepared statement and store result
    $statement->execute();
    $result = $statement->get_result();

    // --- ALLOW SQL INJECTION : these two lines instead of the two above ---
    // $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    // $result = $con->query($query);

    //     -> allows input with the form 
    //          a' OR '1'='1
    //      for both fields, return all rows from the user database in the
    //      following select statement




    // Check if user exists, based on result
    if ($result->num_rows > 0) {
        //$row = $result->fetch_assoc();
        $res = $result->fetch_all();
        header('Content-Type: application/json');
        // echo json_encode($row);

        // ----- Setting the username if successful login
        session_start();
        session_regenerate_id();
        header('Location: ../index.php');
        $_SESSION["curr_user"] = $res[0][0];
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

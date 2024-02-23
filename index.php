<?php

$conn = mysqli_connect("localhost", "root", "", "clutch1");
if ($conn === false) {
    die("ERROR");
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $schoolid = $_REQUEST['schoolid'];
        $first_name = $_REQUEST['first_name'];
        $middle_initial = $_REQUEST['middle_initial'];
        $last_name = $_REQUEST['last_name'];
        $gender = $_REQUEST['gender'];
        $date_of_birth = $_REQUEST['date_of_birth'];
        $course = $_REQUEST['course'];

        $sql = "INSERT INTO schooldata (schoolid, first_name, middle_initial, last_name, gender, date_of_birth, course) VALUES ('$schoolid', '$first_name','$middle_initial','$last_name','$gender','$date_of_birth','$course')";
        $res = $conn->query($sql);

        if ($res === TRUE) {
            echo "Record added";
        } else {
            echo "Error: " . $conn->error;
        }
        break;


    case "PUT":
        // Write update query
        $_PUT = file_get_contents("php://input");
        parse_str($_PUT, $put_vars);
        $schoolid = $put_vars['schoolid'];
        $first_name = $put_vars['first_name'];
        $middle_initial = $put_vars['middle_initial'];
        $last_name = $put_vars['last_name'];
        $gender = $put_vars['gender'];
        $date_of_birth = $put_vars['date_of_birth'];
        $course = $put_vars['course'];

        $sql = "UPDATE schooldata SET first_name='$first_name', middle_initial='$middle_initial', last_name='$last_name', gender='$gender', date_of_birth='$date_of_birth', course='$course' WHERE schoolid='$schoolid'";

        $res = $conn->query($sql);
        if ($res === TRUE) {
            echo "Record updated";
        } else {
            echo "Error: " . $conn->error;
        }
        break;


    case "DELETE":
        // Write delete query
        $schoolid = $_GET['schoolid'];
        $sql = "DELETE FROM schooldata WHERE schoolid='$schoolid'";
        $res = $conn->query($sql);

        if ($res === TRUE) {
            echo "Record deleted";
        } else {
            echo "Error: " . $conn->error;
        }
        break;
        default:
        var_dump($_GET);
    
        
        
        // Search query based on schoolid
        $data = $_GET;
        if (isset($data['search'])) {
            $search = $data['search'];
            $sql = "SELECT * FROM schooldata WHERE schoolid = '$search' OR firstname = '$search'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Process each row sa data
                    var_dump($row);
                }
            } else {
                echo "No results found.";
            }
        } else {
            $sql = "SELECT * FROM schooldata";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Process each row sa data
                    var_dump($row);
                }
            } else {
                echo "No results found.";
            }
        }
        break;
    
    
}
?>
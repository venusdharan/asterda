<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "triophore";

if(isset($_POST['op']))
{
    if($_POST['op'] != '')
    {
        $op = $_POST['op'];
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        
        if($op == 'add')
        {
            if(isset($_POST['data']))
            {
                if($_POST['data'] != '')
                {
                    $data = $_POST['data'];
                    $sql = "INSERT INTO ward (name) VALUES ('$data')";
                    if($conn->query($sql) === TRUE) {
                        echo mysqli_insert_id($conn);
                    } else {
                        echo "Failed";
                    }
                    $conn->close();
                    exit();
                }
            }
        }
        
        if($op == 'all')
        {
            $sql = "SELECT * FROM ward";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                $r = array();
                while($row = $result->fetch_assoc()) {
                   // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                    
                   array_push($r, $row)  ;
                    
                }
                echo json_encode($r);
            } else {
                echo "0 results";
            }
            $conn->close();
        }
        
        if($op == 'del')
        {
            if(isset($_POST['data']))
            {
                if($_POST['data'] != '')
                {
                    $data = $_POST['data'];
                    $sql = "DELETE FROM ward WHERE id='$data'";

                    if ($conn->query($sql) === TRUE) {
                        echo "Record deleted successfully";
                    } else {
                        echo "Error deleting record: ";
                    }
                }
            }
        }
        
        
        
        
        
        
        
        
        
        
        
        
        
    }
}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: cursive;
        }

        header{
            background-color: #f0f5f5;
            height: 100vh;
            width: 100vw;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 440px;
            width: 450px;
            background-color: white;
            border-radius: 10px;
            flex-direction: column;
        }
        div{
            height: 50px;
            width: 450px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        button{
            background-color: #99ebff;
            border-radius: 5px;
            border: none;
            font-size: 16px;   
            height: 40px;
            width: 150px;    
         }
        button:hover{
           box-shadow: 0px 0px 10px 1px rgba(0, 0, 0, 0.2);
        }
      input{
        box-shadow: 0px 0px 10px 1px rgba(0, 0, 0, 0.2);
        border: none;
        height: 30px;
        border-radius: 5px;
        width: 220px;
      }
      input::placeholder{
        position: relative;
        left: 10px;
      }
      h1{
        color: #99ebff;

      }
      #h1{
        height: 300px;
        width: 300px;
        background-color: green;
        display: flex;
        dis
      }
      #email{
        margin-left: 35px;
      }
    </style>
</head>
</head>
<body>

    
    <header>
    <form method="post">
        <h1>ORDER BY Clause</h1><br>
        <div>
        <label>FirstName:</label>
        <input type="text" name="fname"  placeholder="entre your Firstname" reaquired>
        </div>
        <br>
        <div>
        <label>LastName:</label>
        <input type="text" name="lname"  placeholder="entre your Lastname" reaquired>
        </div>
        <br>
        <div>
        <label>Email:</label>
        <input type="email" name="email" placeholder="entre your Email Addresse"  id="email" reaquired>
        </div>
        <br>
      
        <button type="submit" name="submit">Insert Data</button>
        <br><br>
        
    </form>
</header>

<?php
    
    echo "<table style='border: solid 2px black;'>";
    echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th><th>Email</th></tr>";

class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
  }

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "</tr>" . "\n";
  }
}


$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "ana";
$tablename = "Form";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

      $fname = $_POST["fname"];
      $lname = $_POST["lname"];
      $email = $_POST["email"];
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO $tablename (`Firstname`, `Lastname`, `Email`) VALUES ('$fname', '$lname', '$email')";
        $conn->exec($sql);


        $stmt = $conn->prepare("SELECT id, FirstName, LastName, Email FROM $tablename");
        $stmt->execute();
    
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
          }
        $display = "New record created successfully";
      } catch(PDOException $e) {
        echo  "Erreur " . $e->getMessage(); 
      }
      $conn = null;
    }
    /*
    <?php
echo "<table style='border: solid 2px black;'>";
echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th><th>Email</th></tr>";

class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
  }

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "</tr>" . "\n";
  }
}



try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT id, FirstName, LastName, Email FROM $tablename");
  $stmt->execute();

  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
    */
    ?>

</body>
</html>
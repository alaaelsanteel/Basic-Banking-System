<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <title>Customers</title>
    <link rel="stylesheet" href="cust.css">

</head>

<body id="home">
    <header class="hero">
        <div id="navbar" class="navbar top">
            <h1 class="logo">
                <span class="text-primary">

                    <i></i> Banking
                </span> System

            </h1>
            <nav>
                <ul>
                    <li><a href="home.html">Home</a></li>
                    <li><a href="customers.php">Customers</a></li>
                    <li><a href="transfer.php">Transfer</a></li>
                    <li><a href="transferHistory.php">Transfer History</a></li>
                </ul>
            </nav>


    </header>

    </div>
    <div class="title">
        <div class="white-box">
            <h1>Customers Info</h1>
            <section class="customers">
                <table class="customers-table">
                    <thead>
                        <tr>
                            <th>iD</th>
                            <th>first name</th>
                            <th>last name</th>
                            <th>e-mail</th>
                            <th>Current balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //conect to database
                        $con = mysqli_connect('localhost', 'root', '', 'banking_system');
                        //check the connection
                        if (!$con) {
                            echo 'connection error: ' . mysqli_connect_error();
                        }
                        $sql = "SELECT * FROM customers";

                        $result = $con->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["First_Name"] . "</td><td>" . $row["Last_Name"] . "</td><td>" . $row["E-Mail"] . "</td><td>" . $row["Current_Balance"];
                            }
                            echo "</table>";
                        } else {
                            echo "no result founded";
                        }
                        $con->close();
                        ?>
                </table>

            </section>
        </div>
    </div>

</body>


</html>
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
            <h1>Transfer History</h1>
            <section class="customers">
                <table class="customers-table">
                    <thead>
                        <tr>
                            <th>Sender iD</th>
                            <th>Receiver ID</th>
                            <th>Amount</th>
                            <th>[Date] [Time]</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        //start connection
                        $con = mysqli_connect("localhost" , "root" , "" , "banking_system");
                        //try connection
                        if($con -> connect_error){
                            die("Connection Failed:" . $con -> connect_error);
                        }

                        // sql statement
                        $sql = "SELECT * FROM transfers";

                        $result = $con -> query($sql);

                        if($result -> num_rows > 0) {
                            while($row = $result -> fetch_assoc())
                            {
                                echo "<tr><td>".$row["Sender_ID"]."</td><td>".$row["Receiver_ID"]."</td><td>".$row["Amount"]."</td><td>".$row["date"];
                            }
                            echo "</table>";
                        }
                        $con -> close();
                    ?>
                        
                </table>

            </section>
        </div>
    </div>

</body>
</html>
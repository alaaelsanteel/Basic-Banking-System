<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <title>Customers</title>
    <link rel="stylesheet" href="transfer.css">

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
            <section class="transfer">
                <h1 class="heading-title">Transaction</h1>
                <div class="container">
                    <form method="POST" class="transfer-form">

                        <label class="from">Transfer From:</label>
                        <input type="number" id="form" name="sender" placeholder="Enter Customer ID">
                        <label class="to">Transfer To:</label>
                        <input type="number" id="to" name="receiver" placeholder="Enter Customer ID">
                        <label class="amount">Amount:</label>
                        <input type="number" id="amount" name="amount" placeholder="Enter The Amount">
                        <div class="btnholder">
                            <button class="btn" type="submit" name="submit">Transfer</button>
                        </div>
                        <?php
                        //start connection
                        $con = mysqli_connect("localhost", "root", "", "banking_system");
                        //try connection
                        if ($con->connect_error) {
                            die("Connection Failed:" . $con->connect_error);
                        }
                        if (isset($_POST['submit'])) {
                            $sender = $_POST['sender'];
                            $receiver = $_POST['receiver'];
                            $amount = $_POST['amount'];

                            if ($sender <= 0 || $receiver <= 0 || $amount <= 0) {
                                echo '<script>alert("Error Massage: Values must be more than zero!")</script>';
                            } else {
                                // sender
                                $sqlGetSender = "SELECT * from customers where ID=$sender";
                                $sender_query = mysqli_query($con, $sqlGetSender);
                                $sqlSender = mysqli_fetch_array($sender_query);

                                // receiver
                                $sqlGetReceiver = "SELECT * from customers where ID=$receiver";
                                $receive_query = mysqli_query($con, $sqlGetReceiver);
                                $sqlReceiver = mysqli_fetch_array($receive_query);

                                if ($amount < $sqlSender['Current_Balance']) {
                                    $new_balance_sender = $sqlSender['Current_Balance'] - $amount;
                                    $sql = "UPDATE customers set Current_Balance=$new_balance_sender where ID=$sender";
                                    $selsender = mysqli_query($con, $sql);

                                    $new_balance_receiver = $sqlReceiver['Current_Balance'] + $amount;
                                    $sql = "UPDATE customers set Current_Balance=$new_balance_receiver where ID=$receiver";
                                    mysqli_query($con, $sql);


                                    $sender_id = $sqlSender['ID'];
                                    $receiver_id = $sqlReceiver['ID'];

                                    $Insertsql = "INSERT INTO `transfers` ( `Sender_ID`, `Receiver_ID`, `Amount`, `date`) VALUES ('$sender_id ','$receiver_id','$amount', current_timestamp())";

                                    $insert = mysqli_query($con, $Insertsql);
                                }
                                if ($amount >= $sqlSender['Current_Balance']) {
                                    echo '<script>alert("Opps, the amount of money is higher than you have")</script>';
                                }
                            }
                        }
                        ?>

                    </form>
                </div>
            </section>
            <section class="transfer">
                <h1 class="heading-title">Get Customers Info</h1>
                <form method="GET">
                    <input type="number" id="to" name="select" placeholder="Enter Customer ID" require>

                    <button class="btn" type="submit" name="show">Show</button>
                </form>

            </section>
            <section class="customers">
                <table>
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
                        <!--retrieve data-->
                        <?php
                        //conect to database
                        $con = mysqli_connect('localhost', 'root', '', 'banking_system');
                        //check the connection
                        if (!$con) {
                            echo 'connection error: ' . mysqli_connect_error();
                        }
                        if (isset($_GET['show'])) {
                            $id = $_GET['select'];

                            $sql = "SELECT * FROM customers WHERE ID=$id";
                            $result = $con->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["First_Name"] . "</td><td>" . $row["Last_Name"] . "</td><td>" . $row["E-Mail"] . "</td><td>" . $row["Current_Balance"];
                                }
                                echo "</table>";
                            } else if ($result->num_rows <= 0) {
                                echo "<h4>  No result founded</h4>";
                            }
                        }
                        ?>
                    </tbody>
                    </tabel>
            </section>
        </div>
    </div>


</body>


</html>
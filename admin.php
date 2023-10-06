<?php
$conn = mysqli_connect("localhost", "root", "", "miniproject");
$sql = "SELECT * from `user`";
$result = mysqli_query($conn, $sql);
// $row1=mysqli_fetch_assoc($result);
session_start();
$name = $_SESSION['uname'];
if ($_SESSION['login'] != true) {
    header("location : login.php");
}
// $_SESSION['sno'] = $row1['sno'] ;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Admin Portal</title>
</head>

<body>
    <header>
        <span class="greet top">Welcome to admin Portal</span>
        <span class="logout top"><a href="logout.php">Logout</a></span>
        <span class="search">
            <form method="post">
                <input type="text" name="isearch" id="isearc">
                <button type="submit" class="ed sbtn" name='bsearch'>Search</button>
            </form>
        </span>
    </header>
    <main>
        <div>
            <p>Welcome <?php echo $name; ?></p>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Books Taken</th>
                        <th>Return time</th>
                        <th>Charges</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $num = 1;
                    $nosearch = true;
                    // if ($_SERVER['REQUEST_METHOD'] == 'post') {
                        if (isset($_POST['bsearch'])) {
                            $nosearch = false;
                            if ($nosearch == false) {
                                $isearch = $_POST['isearch'];
                                $sql = "SELECT * from `user` where `uname` like '%$isearch%'";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $_SESSION['sno'] = $row['sno'];
                                    echo "<tr>
                                <td>" . $num . "</td>
                                <td>" . $row['uname'] . "</td>
                                <td>" . $row['books_taken'] . "</td>
                                <td>" . $row['return_time'] . "</td>
                                <td>" . $row['charge'] . "</td>
                                <td><a href='edit.php?sno_edit=" . $row['sno'] . "'><button class='ed'>Edit</button></a>
                                            <a href='delete.php?sno_delete=" . $row['sno'] . "'><button class='ed'>Delete</button></a></td>
                                        </tr>";
                                    $num++;
                                }
                            }
                        }
                        elseif ($nosearch == true) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $_SESSION['sno'] = $row['sno'];
                                echo "<tr>
                                <td>" . $num . "</td>
                                <td>" . $row['uname'] . "</td>
                                <td>" . $row['books_taken'] . "</td>
                                <td>" . $row['return_time'] . "</td>
                                <td>" . $row['charge'] . "</td>
                                <td><a href='edit.php?sno_edit=" . $row['sno'] . "'><button class='ed'>Edit</button></a>
                                <a href='delete.php?sno_delete=" . $row['sno'] . "'><button class='ed'>Delete</button></a></td>
                                </tr>";
                                $num++;
                            }
                        }
                    // }
                ?>
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        <p>&copy;Copyright 2023-2023 SOU Library. All rights are reserved.</p>
    </footer>
</body>
<script>
    function auth() {
        let a = document.getElementById("isearc").value;
        document.writeln(a);
    }
</script>

</html>
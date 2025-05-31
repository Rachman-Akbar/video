<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "mystore";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_POST['toggle'])) {
    $id = (int)$_POST['id'];
    $current_status = (int)$_POST['status'];
    $new_status = $current_status === 1 ? 0 : 1;
    $conn->query("UPDATE customers SET status = $new_status WHERE id = $id");
}
?>

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body {
        background: #f8f9fa;
    }
    .container {
        width: 85%;
        margin: 30px auto;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        padding: 30px 0 20px 0;
    }
    h2 {
        margin-bottom: 25px;
        color: #333;
        letter-spacing: 1px;
    }
    table {
        border-collapse: collapse;
        width: 95%;
        margin: 0 auto 20px auto;
        font-family: Arial, sans-serif;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0,0,0,0.06);
    }
    th, td {
        border: 1px solid #e0e0e0;
        padding: 10px 16px;
        text-align: center;
    }
    th {
        background: #007bff;
        color: #fff;
        font-size: 1.05em;
    }
    tr:nth-child(even) {
        background: #f7faff;
    }
    .active {
        color: #28a745;
        font-weight: bold;
    }
    .inactive {
        color: #dc3545;
        font-weight: bold;
    }
    button {
        padding: 6px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        color: #fff;
        font-size: 1em;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: background 0.2s;
    }
    .btn-aktif {
        background: #28a745;
    }
    .btn-aktif:hover {
        background: #218838;
    }
    .btn-banned {
        background: #dc3545;
    }
    .btn-banned:hover {
        background: #b52a37;
    }
</style>

<div class="container">
    <h2 style="text-align:center;"><i class="fa fa-users"></i> Data Pelanggan</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Status</th>
        </tr>
        <?php
        $data = $conn->query("SELECT * FROM customers");
        while ($row = $data->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>";
            if ($row['status'] == 1) {
                echo "<form method='POST' style='margin:0;display:inline;'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <input type='hidden' name='status' value='1'>
                        <button type='submit' name='toggle' class='btn-aktif'>
                            <i class='fa fa-check-circle'></i> Aktif
                        </button>
                      </form>";
            } else {
                echo "<form method='POST' style='margin:0;display:inline;'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <input type='hidden' name='status' value='0'>
                        <button type='submit' name='toggle' class='btn-banned'>
                            <i class='fa fa-ban'></i> Banned
                        </button>
                      </form>";
            }
            echo "</td></tr>";
        }
        ?>
    </table>
</div>
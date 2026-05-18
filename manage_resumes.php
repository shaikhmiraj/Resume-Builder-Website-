<?php
session_start();
require_once "config.php";

/* ===== CHECK ADMIN LOGIN ===== */
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

/* ===== PAGINATION SETTINGS ===== */
$limit = 10;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

/* ===== FILTER SETTINGS ===== */
$where = "";
$filter_user = "";

if(isset($_GET['user_filter']) && $_GET['user_filter'] != ""){
    $filter_user = intval($_GET['user_filter']);
    $where = "WHERE resume.user_id = $filter_user";
}

/* ===== TOTAL RECORD COUNT (WITH FILTER) ===== */
$count_sql = "
SELECT COUNT(*) as total
FROM resume
$where
";
$count_result = mysqli_query($conn, $count_sql);
$count_row = mysqli_fetch_assoc($count_result);
$total_records = $count_row['total'];
$total_pages = ceil($total_records / $limit);

/* ===== FETCH RESUMES ===== */
$query = "
SELECT resume.id,
       resume.template,
       resume.download_count,
       users.name AS username,
       users.email
FROM resume
JOIN users ON resume.user_id = users.id
$where
ORDER BY resume.id DESC
LIMIT $limit OFFSET $offset
";

$result = mysqli_query($conn, $query);

if(!$result){
    die("SQL Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Resumes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="navbar">
    <a href="admin_dashboard.php">Dashboard</a>
    <a href="manage_users.php">Manage Users</a>
    <a href="manage_resumes.php">Manage Resumes</a>
    <a href="logout.php">Logout</a>
</div>

<h2 style="text-align:center; margin-top:30px;">Manage Resumes</h2>

<div class="container">

<!-- ===== FILTER DROPDOWN ===== -->
<form method="GET" style="margin-bottom:20px;">
    <select name="user_filter">
        <option value="">All Users</option>
        <?php
        $users = mysqli_query($conn, "SELECT id, name FROM users");
        while($u = mysqli_fetch_assoc($users)){
            $selected = ($filter_user == $u['id']) ? "selected" : "";
            echo "<option value='{$u['id']}' $selected>" . htmlspecialchars($u['name']) . "</option>";
        }
        ?>
    </select>
    <button type="submit">Filter</button>
</form>

<!-- ===== TABLE ===== -->
<table border="1" width="100%" cellpadding="10" cellspacing="0">
<tr>
    <th>ID</th>
    <th>User Name</th>
    <th>Email</th>
    <th>Template</th>
    <th>Downloads</th>
    <th>Action</th>
</tr>

<?php 
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){ 
?>
<tr>
    <td><?= $row['id']; ?></td>
    <td><?= htmlspecialchars($row['username']); ?></td>
    <td><?= htmlspecialchars($row['email']); ?></td>
    <td><?= htmlspecialchars($row['template']); ?></td>
    <td><?= $row['download_count']; ?></td>
    <td>
        <a href="delete_resume.php?id=<?= $row['id']; ?>"
           onclick="return confirm('Are you sure you want to delete this resume?')">
           Delete
        </a>
    </td>
</tr>
<?php 
    }
}else{
?>
<tr>
    <td colspan="6" style="text-align:center;">No resumes found.</td>
</tr>
<?php } ?>
</table>

<!-- ===== PAGINATION ===== -->
<div style="margin-top:20px; text-align:center;">
<?php
if($total_pages > 1){
    for($i = 1; $i <= $total_pages; $i++){

        $link = "?page=$i";
        if($filter_user != ""){
            $link .= "&user_filter=$filter_user";
        }

        if($i == $page){
            echo "<strong style='margin:5px;'>$i</strong>";
        } else {
            echo "<a href='$link' style='margin:5px;'>$i</a>";
        }
    }
}
?>
</div>

</div>
</body>
</html>
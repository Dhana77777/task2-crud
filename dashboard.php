<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}
?>

<h2>Welcome <?php echo $_SESSION['user']; ?></h2>

<form method="post">
<input type="text" name="title" placeholder="Title" required>
<textarea name="content" placeholder="Content"></textarea>
<button name="add">Add Post</button>
</form>

<?php
if (isset($_POST['add'])) {
    mysqli_query($conn, "INSERT INTO posts(title,content) VALUES('{$_POST['title']}','{$_POST['content']}')");
}

$result = mysqli_query($conn, "SELECT * FROM posts");
while ($row = mysqli_fetch_assoc($result)) {
    echo "<h3>".$row['title']."</h3>";
    echo "<p>".$row['content']."</p>";
    echo "<a href='delete.php?id=".$row['id']."'>Delete</a><hr>";
}
?>

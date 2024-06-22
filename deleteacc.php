<?php
session_start();
include 'db.php';

if (isset($_SESSION['id'])) {
  $user_id = $_SESSION['id'];

  // Check if the user is sure they want to delete their account
  if (isset($_POST['confirm'])) {
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Log the user out
    session_unset();
    session_destroy();

    // Redirect to the login page
    header('Location: login.php');
    exit;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Delete Account</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

.delete-account {
    max-width: 400px;
    margin: 40px auto;
    padding: 20px;
    font-family: Roboto, sans-serif;
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  .delete-account h2 {
    margin-top: 0;
  }
  
  .delete-account p {
    margin-bottom: 20px;
  }
  
  .delete-account form {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  
  .delete-account input[type="checkbox"] {
    margin-right: 10px;
  }
  
  .delete-account input[type="submit"] {
    background-color: #FF0000;
    color: #ffffff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .delete-account input[type="submit"]:hover {
    background-color: #CC0000;
  }
</style>
</head>
<body>
  <main>
    <section class="delete-account">
      <h2>Delete Account</h2>
      <p>Are you sure you want to delete your account? This action is permanent and cannot be undone.</p>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="checkbox" id="confirm" name="confirm" required>
        <label for="confirm">I understand that this action is permanent and cannot be undone.</label>
        <br><br>
        <input type="submit" value="Delete Account">
      </form>
    </section>
  </main>
  <script>
  // Add an event listener to the submit button
document.querySelector('input[type="submit"]').addEventListener('click', function(event) {
  // Check if the checkbox is checked
  if (!document.querySelector('input[type="checkbox"]').checked) {
    event.preventDefault();
    alert('Please confirm that you want to delete your account.');
  }
});
</script>
  <div id="footer"></div>
</body>
</html>
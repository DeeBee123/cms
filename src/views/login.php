
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="src/style/login.css">
    <link rel="stylesheet" href="src/style/global.css">
</head>
<body>
<div class='bold-line'></div>
<div class='container'>
  <div class='window'>
    <div class='overlay'></div>
    <div class='content'>
      <div class='welcome'>Admin Login</div>
      <div class='subtitle'>For demo purposes: <br>Username = username <br> and Password = password</div>
      <?php 
      session_start();
      $msg = '';
      if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
          if ($_POST['username'] == 'username' && $_POST['password'] == 'password') {
              $_SESSION['logged_in'] = true;
              $_SESSION['timeout'] = time();
              $_SESSION['username'] = $_POST['username'];
              header("Location: " . "/cms/admin");
          } else {
              $msg = 'Wrong username or password. Try again.';
          }
      }
      ?>
      <form method="POST">
      <div class='input-fields'>
        <?php echo($msg)?> 
        <input name="username" type='text' placeholder='Username' class='input-line full-width' autocomplete="off" required></input>
        <input name="password" type='password' placeholder='Password' class='input-line full-width' autocomplete="off" required></input>
      </div>
      <div class='spacing'>or continue with <a href="/cms/" class='highlight'>User rights</a></div>
      <input name="login" type="submit" class='ghost-round full-width' value="Login">
      </form>
    </div>
  </div>
</div>
</body>
</html>
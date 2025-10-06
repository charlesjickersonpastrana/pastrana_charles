<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create User</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      background-color: #fff;
      color: #000;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .create-box {
      width: 400px;
      padding: 40px 35px;
      border: 1px solid #ccc;
      border-radius: 12px;
      background-color: #fff;
      box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .create-box h2 {
      text-align: center;
      font-weight: 600;
      margin-bottom: 25px;
      letter-spacing: 1px;
    }

    .inputBox {
      position: relative;
      margin-bottom: 20px;
    }

    .inputBox input {
      width: 100%;
      padding: 12px 12px;
      border: 1px solid #aaa;
      border-radius: 8px;
      font-size: 1em;
      outline: none;
      background-color: #f9f9f9;
    }

    .inputBox input:focus {
      border-color: #000;
      background-color: #fff;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #000;
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 1em;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background-color: #333;
    }

    .group {
      text-align: center;
      margin-top: 15px;
      font-size: 0.95em;
    }

    .group a {
      color: #000;
      text-decoration: underline;
    }

    .group a:hover {
      opacity: 0.7;
    }
  </style>
</head>
<body>

  <div class="create-box">
    <h2>Create User</h2>

    <?php if (!empty($error)): ?>
      <div class="error-box"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="<?= site_url('users/create'); ?>">
      <div class="inputBox">
        <input type="text" name="username" placeholder="Username" required value="<?= isset($username) ? html_escape($username) : '' ?>">
      </div>

      <div class="inputBox">
        <input type="email" name="email" placeholder="Email" required value="<?= isset($email) ? html_escape($email) : '' ?>">
      </div>

      <button type="submit">Create</button>
    </form>

    <div class="group">
      <p><a href="<?= site_url('users'); ?>">Return to Home</a></p>
    </div>
  </div>

</body>
</html>

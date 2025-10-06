<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    section {
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 100vh;
      overflow: hidden;
      background: linear-gradient(135deg, #3da46f, #5ab56d);
    }

    .register {
      position: relative;
      padding: 60px;
      background: rgba(255, 255, 255, 0.25);
      backdrop-filter: blur(15px);
      border-radius: 20px;
      width: 400px;
      display: flex;
      flex-direction: column;
      gap: 30px;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
    }

    .register h2 {
      text-align: center;
      font-size: 2em;
      font-weight: 600;
      color: #2e633f;
    }

    .register .inputBox {
      position: relative;
      margin-bottom: 20px;
    }

    .register .inputBox input {
      width: 100%;
      padding: 15px 20px;
      font-size: 1.1em;
      color: #2e633f;
      border-radius: 5px;
      background: #fff;
      border: none;
    }

    .register .inputBox ::placeholder {
      color: #2e633f;
    }

    .register button {
      width: 100%;
      padding: 15px;
      border: none;
      background: #2e633f;
      color: #fff;
      font-size: 1.25em;
      font-weight: 500;
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
    }

    .register button:hover {
      background: #3da46f;
    }

    .group {
      text-align: center;
    }

    .group a {
      font-size: 1em;
      color: #2e633f;
      font-weight: 500;
      text-decoration: none;
    }

    .group a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <section>
    <div class="register">
      <h2>Register</h2>

      <?php if (!empty($error)): ?>
        <div style="background: rgba(255,0,0,0.1); color: #d64c42; padding: 10px; border: 1px solid #d64c42; border-radius: 5px; margin-bottom: 15px; text-align: center;">
          <?= $error ?>
        </div>
      <?php endif; ?>

      <form method="post" action="<?= site_url('auth/register') ?>">
        <div class="inputBox">
          <input type="text" placeholder="Username" name="username" required>
        </div>

        <div class="inputBox">
          <input type="email" placeholder="Email" name="email" required>
        </div>

        <div class="inputBox">
          <input type="password" placeholder="Password" name="password" required>
        </div>

        <div class="inputBox">
          <input type="password" placeholder="Confirm Password" name="confirm_password" required>
        </div>

        <button type="submit">Register</button>
      </form>

      <div class="group">
        <p>Already have an account? <a href="<?= site_url('auth/login'); ?>">Login here</a></p>
      </div>
    </div>
  </section>
</body>
</html>

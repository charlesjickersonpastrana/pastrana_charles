<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #797979ff;
      color: #000;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .login {
      width: 380px;
      padding: 40px 35px;
      border: 1px solid #ccc;
      border-radius: 12px;
      background-color: #fff;
      box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .login h2 {
      text-align: center;
      font-weight: 600;
      margin-bottom: 25px;
      letter-spacing: 1px;
    }

    .error-box {
      background: #f8d7da;
      color: #842029;
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 0.9em;
      text-align: center;
      border: 1px solid #f5c2c7;
    }

    .inputBox {
      position: relative;
      margin-bottom: 20px;
    }

    .inputBox input {
      width: 100%;
      padding: 12px 40px 12px 12px;
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

    .toggle-password {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #555;
      font-size: 1em;
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

  <div class="login">
    <h2>Welcome Back</h2>

    <?php if (!empty($error)): ?>
      <div class="error-box"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="<?= site_url('auth/login'); ?>">
      <div class="inputBox">
        <input type="text" name="username" placeholder="Username" required>
      </div>

      <div class="inputBox">
        <input type="password" name="password" id="password" placeholder="Password" required>
        <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
      </div>

      <button type="submit">Login</button>
    </form>

    <div class="group">
      <p>Don't have an account? <a href="<?= site_url('auth/register'); ?>">Register</a></p>
    </div>
  </div>

  <script>
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      this.classList.toggle('fa-eye');
      this.classList.toggle('fa-eye-slash');
    });
  </script>

</body>
</html>

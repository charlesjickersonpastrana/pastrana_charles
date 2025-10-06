<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Unique Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: #0f0f1a;
      overflow: hidden;
    }

    /* Animated background circles */
    .circles {
      position: absolute;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 0;
    }

    .circles li {
      position: absolute;
      display: block;
      list-style: none;
      width: 25px;
      height: 25px;
      background: rgba(255, 255, 255, 0.1);
      animation: animate 20s linear infinite;
      bottom: -150px;
      border-radius: 50%;
    }

    .circles li:nth-child(1) { left: 25%; width: 80px; height: 80px; animation-duration: 15s; }
    .circles li:nth-child(2) { left: 10%; width: 20px; height: 20px; animation-duration: 10s; }
    .circles li:nth-child(3) { left: 70%; width: 20px; height: 20px; animation-duration: 20s; }
    .circles li:nth-child(4) { left: 40%; width: 60px; height: 60px; animation-duration: 18s; }
    .circles li:nth-child(5) { left: 65%; width: 20px; height: 20px; animation-duration: 12s; }
    .circles li:nth-child(6) { left: 75%; width: 110px; height: 110px; animation-duration: 25s; }
    .circles li:nth-child(7) { left: 35%; width: 150px; height: 150px; animation-duration: 35s; }
    .circles li:nth-child(8) { left: 50%; width: 25px; height: 25px; animation-duration: 45s; }
    .circles li:nth-child(9) { left: 20%; width: 15px; height: 15px; animation-duration: 11s; }
    .circles li:nth-child(10){ left: 85%; width: 150px; height: 150px; animation-duration: 30s; }

    @keyframes animate {
      0% { transform: translateY(0) rotate(0deg); opacity: 1; border-radius: 0; }
      100% { transform: translateY(-1000px) rotate(720deg); opacity: 0; border-radius: 50%; }
    }

    /* Login Card */
    .login {
      position: relative;
      width: 380px;
      padding: 50px 40px;
      background: rgba(255, 255, 255, 0.07);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 20px;
      backdrop-filter: blur(18px);
      box-shadow: 0 0 25px rgba(0, 255, 255, 0.4);
      z-index: 1;
    }

    .login h2 {
      text-align: center;
      font-size: 2em;
      font-weight: 600;
      margin-bottom: 25px;
      color: #00e5ff;
      text-shadow: 0 0 10px #00e5ff;
    }

    .inputBox {
      position: relative;
      margin-bottom: 25px;
    }

    .inputBox input {
      width: 100%;
      padding: 14px 45px 14px 15px;
      font-size: 1em;
      color: #fff;
      background: rgba(255, 255, 255, 0.1);
      border: none;
      outline: none;
      border-radius: 10px;
    }

    .inputBox input::placeholder {
      color: #bbb;
    }

    .toggle-password {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      font-size: 1.1em;
      color: #00e5ff;
    }

    .login button {
      width: 100%;
      padding: 14px;
      border: none;
      background: linear-gradient(90deg, #00e5ff, #00ffa3);
      color: #0f0f1a;
      font-size: 1.1em;
      font-weight: 600;
      border-radius: 10px;
      cursor: pointer;
      transition: 0.3s;
      text-transform: uppercase;
    }

    .login button:hover {
      opacity: 0.8;
      box-shadow: 0 0 15px #00ffa3;
    }

    .group {
      text-align: center;
      margin-top: 15px;
    }

    .group a {
      font-size: 0.95em;
      color: #00e5ff;
      text-decoration: none;
    }

    .group a:hover {
      text-decoration: underline;
    }

  </style>
</head>
<body>
  <!-- Background circles -->
  <ul class="circles">
    <li></li><li></li><li></li><li></li><li></li>
    <li></li><li></li><li></li><li></li><li></li>
  </ul>

  <!-- Login Card -->
  <div class="login">
    <h2>Login</h2>

    <?php if (!empty($error)): ?>
      <div style="background: rgba(255,0,0,0.15); color: #ff7b7b; padding: 10px; border-radius: 8px; margin-bottom: 15px; text-align: center; font-size: 0.9em;">
        <?= $error ?>
      </div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('auth/login') ?>">
      <div class="inputBox">
        <input type="text" placeholder="Username" name="username" required>
      </div>

      <div class="inputBox">
        <input type="password" placeholder="Password" name="password" id="password" required>
        <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
      </div>

      <button type="submit">Login</button>
    </form>

    <div class="group">
      <p style="font-size: 0.9em;">
        Don't have an account? <a href="<?= site_url('auth/register'); ?>">Register here</a>
      </p>
    </div>
  </div>

  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      this.classList.toggle('fa-eye');
      this.classList.toggle('fa-eye-slash');
    });
  </script>
</body>
</html>
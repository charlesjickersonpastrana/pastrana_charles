<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #fff;
      color: #000;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .register {
      width: 400px;
      padding: 40px 35px;
      border: 1px solid #ccc;
      border-radius: 12px;
      background-color: #fff;
      box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .register h2 {
      text-align: center;
      font-weight: 600;
      margin-bottom: 25px;
      letter-spacing: 1px;
    }

    .inputBox {
      position: relative;
      margin-bottom: 20px;
    }

    .inputBox input,
    .inputBox select {
      width: 100%;
      padding: 12px 40px 12px 12px;
      border: 1px solid #aaa;
      border-radius: 8px;
      font-size: 1em;
      outline: none;
      background-color: #f9f9f9;
    }

    .inputBox input:focus,
    .inputBox select:focus {
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
    }

    .group a {
      color: #000;
      text-decoration: underline;
      font-size: 0.95em;
    }

    .group a:hover {
      opacity: 0.7;
    }
  </style>
</head>
<body>

  <div class="register">
    <h2>Create Account</h2>
    <form method="POST" action="<?= site_url('auth/register'); ?>">

      <div class="inputBox">
        <input type="text" name="username" placeholder="Username" required>
      </div>

      <div class="inputBox">
        <input type="email" name="email" placeholder="Email" required>
      </div>

      <div class="inputBox">
        <input type="password" id="password" name="password" placeholder="Password" required>
        <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
      </div>

      <div class="inputBox">
        <input type="password" id="confirmPassword" name="confirm_password" placeholder="Confirm Password" required>
        <i class="fa-solid fa-eye toggle-password" id="toggleConfirmPassword"></i>
      </div>

      <div class="inputBox">
        <select name="role" required>
          <option value="user" selected>User</option>
          <option value="admin">Admin</option>
        </select>
      </div>

      <button type="submit">Register</button>

    </form>

    <div class="group">
      <p>Already have an account? <a href="<?= site_url('auth/login'); ?>">Login</a></p>
    </div>
  </div>

  <script>
    function toggleVisibility(toggleId, inputId) {
      const toggle = document.getElementById(toggleId);
      const input = document.getElementById(inputId);

      toggle.addEventListener('click', function () {
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
      });
    }

    toggleVisibility('togglePassword', 'password');
    toggleVisibility('toggleConfirmPassword', 'confirmPassword');
  </script>

</body>
</html>

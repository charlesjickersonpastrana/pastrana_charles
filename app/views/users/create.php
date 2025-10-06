<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create User</title>
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
      height: 100vh;
      background: radial-gradient(circle at top, #0f2027, #203a43, #2c5364);
      overflow: hidden;
    }

    /* Animated background glow */
    body::before {
      content: '';
      position: absolute;
      width: 400px;
      height: 400px;
      background: #00f2fe;
      border-radius: 50%;
      filter: blur(200px);
      top: -100px;
      left: -100px;
      animation: float1 10s infinite alternate ease-in-out;
    }

    body::after {
      content: '';
      position: absolute;
      width: 500px;
      height: 500px;
      background: #4facfe;
      border-radius: 50%;
      filter: blur(220px);
      bottom: -150px;
      right: -150px;
      animation: float2 12s infinite alternate ease-in-out;
    }

    @keyframes float1 {
      from { transform: translateY(0); }
      to { transform: translateY(60px); }
    }

    @keyframes float2 {
      from { transform: translateY(0); }
      to { transform: translateY(-60px); }
    }

    .form-container {
      position: relative;
      width: 380px;
      padding: 40px;
      border-radius: 15px;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 0 20px rgba(0, 242, 254, 0.3),
                  0 0 40px rgba(79, 172, 254, 0.2);
      z-index: 1;
    }

    .form-container h1 {
      text-align: center;
      font-size: 2em;
      font-weight: 700;
      color: #00f2fe;
      margin-bottom: 25px;
      text-shadow: 0 0 10px #00f2fe;
    }

    .form-group input {
      width: 100%;
      padding: 12px 15px;
      font-size: 1em;
      border-radius: 8px;
      border: 2px solid transparent;
      margin-bottom: 18px;
      background: rgba(255, 255, 255, 0.1);
      color: #fff;
      transition: 0.3s;
    }

    .form-group input::placeholder {
      color: #aaa;
    }

    .form-group input:focus {
      outline: none;
      border-color: #00f2fe;
      box-shadow: 0 0 8px #00f2fe, 0 0 15px #4facfe;
      background: rgba(255,255,255,0.15);
    }

    .btn-submit {
      width: 100%;
      padding: 14px;
      background: linear-gradient(90deg, #00f2fe, #4facfe);
      color: #000;
      border: none;
      border-radius: 8px;
      font-size: 1.1em;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
      box-shadow: 0 0 15px rgba(0,242,254,0.5);
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 0 20px rgba(0,242,254,0.8), 0 0 40px rgba(79,172,254,0.6);
    }

    .link-wrapper {
      text-align: center;
      margin-top: 18px;
    }

    .btn-link {
      display: inline-block;
      padding: 10px 18px;
      background: none;
      color: #00f2fe;
      text-decoration: none;
      border-radius: 8px;
      font-weight: 500;
      transition: 0.3s;
      border: 1px solid #00f2fe;
    }

    .btn-link:hover {
      background: #00f2fe;
      color: #000;
      box-shadow: 0 0 12px #00f2fe;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h1>Create User</h1>
    <form id="user-form" action="<?=site_url('users/create/')?>" method="POST">
      <div class="form-group">
        <input type="text" name="username" placeholder="Username" required value="<?= isset($username) ? html_escape($username) : '' ?>">
      </div>
      <div class="form-group">
        <input type="email" name="email" placeholder="Email" required value="<?= isset($email) ? html_escape($email) : '' ?>">
      </div>
      <button type="submit" class="btn-submit">Create User</button>
    </form>
    <div class="link-wrapper">
      <a href="<?=site_url('/users'); ?>" class="btn-link">Return to Home</a>
    </div>
  </div>
</body>
</html>
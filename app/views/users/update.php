<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Update Create</title>
  <style>
    body {
      background: linear-gradient(135deg, #667eea, #764ba2);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 20px;
      color: #fff;
    }

    .form-container {
      background: rgba(255, 255, 255, 0.08);
      border-radius: 20px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.35);
      padding: 40px;
      width: 100%;
      max-width: 480px;
      box-sizing: border-box;
      backdrop-filter: blur(8px);
    }

    h1 {
      text-align: center;
      font-size: 28px;
      margin-bottom: 30px;
      font-weight: 700;
      letter-spacing: 1px;
      color: #fdfdfd;
    }

    .form-group {
      margin-bottom: 22px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #f1f1f1;
      font-size: 15px;
    }

    .form-input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
      background: #fff;
      color: #333;
      box-sizing: border-box;
      transition: border 0.3s ease;
    }

    .form-input:focus {
      border: 2px solid #667eea;
      outline: none;
      box-shadow: 0 0 8px rgba(102, 126, 234, 0.6);
    }

    .btn-submit {
      width: 100%;
      padding: 14px;
      background: linear-gradient(to right, #28a745, #20c997);
      color: #fff;
      border: none;
      border-radius: 10px;
      font-size: 17px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 10px;
    }

    .btn-submit:hover {
      background: linear-gradient(to right, #218838, #198754);
      transform: translateY(-2px);
    }

    .error-message {
      color: #ffb3b3;
      margin-top: 6px;
      font-size: 13px;
      display: none;
    }

    .btn-return {
      display: inline-block;
      padding: 12px 20px;
      background: linear-gradient(to right, #373bff, #282ca7);
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
      margin-top: 20px;
      transition: all 0.3s ease;
    }

    .btn-return:hover {
      background: linear-gradient(to right, #2529b0, #1f2380);
      transform: translateY(-2px);
    }

    .link-wrapper {
      text-align: center;
      margin-top: 25px;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h1>Update User</h1>
    <form id="user-form" action="<?=site_url('users/update/'.$user['id'])?>" method="POST" novalidate>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?=html_escape($user['username']);?>"  placeholder="Enter your username" required class="form-input"/>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?=html_escape($user['email']);?>" placeholder="Enter your email" required class="form-input"/>
        <div id="email-error" class="error-message">Please enter a valid email address.</div>
      </div>
      <button type="submit" class="btn-submit">Update User</button>
    </form>

    <div class="link-wrapper">
      <a href="<?=site_url('/'); ?>" class="btn-return">Return to Home</a>
    </div>
  </div>
</body>
</html>
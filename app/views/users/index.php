<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Students Info</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      font-family: "Poppins", sans-serif;
      background: radial-gradient(circle at top left, #141e30, #243b55);
      color: #fff;
    }

    .dashboard-container {
      max-width: 1200px;
      margin: 50px auto;
      padding: 20px;
    }

    .dashboard-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .dashboard-header h2 {
      font-weight: 700;
      color: #00f2fe;
      text-shadow: 0 0 10px #00f2fe;
    }

    .logout-btn {
      padding: 10px 18px;
      border: none;
      border-radius: 6px;
      background: linear-gradient(90deg, #ff416c, #ff4b2b);
      color: #fff;
      font-weight: 600;
      transition: 0.3s;
      box-shadow: 0 0 10px rgba(255,65,108,0.6);
    }
    .logout-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 0 20px rgba(255,75,43,0.8);
    }

    .user-status {
      padding: 12px 18px;
      border-radius: 10px;
      font-size: 14px;
      background: rgba(0, 242, 254, 0.1);
      border: 1px solid rgba(0, 242, 254, 0.3);
      color: #00f2fe;
      margin-bottom: 20px;
    }
    .user-status.error {
      background: rgba(255, 65, 108, 0.1);
      border: 1px solid rgba(255, 65, 108, 0.3);
      color: #ff416c;
    }

    .table-card {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(15px);
      border-radius: 15px;
      padding: 20px;
      box-shadow: 0 0 25px rgba(0,0,0,0.4);
    }

    table {
      width: 100%;
      border-radius: 10px;
      overflow: hidden;
    }

    th {
      background: #00f2fe;
      color: #000;
      font-size: 14px;
      text-transform: uppercase;
      text-align: center;
    }

    td {
      background: rgba(255,255,255,0.05);
      border-bottom: 1px solid rgba(255,255,255,0.1);
      color: #fff;
      text-align: center;
    }

    a.btn-action {
      padding: 6px 14px;
      border-radius: 6px;
      font-size: 13px;
      margin: 0 2px;
      text-decoration: none;
      color: #fff;
      font-weight: 500;
      transition: 0.3s;
    }

    a.btn-update {
      background: linear-gradient(90deg, #00f2fe, #4facfe);
      box-shadow: 0 0 10px rgba(0,242,254,0.5);
    }
    a.btn-update:hover {
      box-shadow: 0 0 20px rgba(79,172,254,0.8);
    }

    a.btn-delete {
      background: linear-gradient(90deg, #ff416c, #ff4b2b);
      box-shadow: 0 0 10px rgba(255,65,108,0.5);
    }
    a.btn-delete:hover {
      box-shadow: 0 0 20px rgba(255,75,43,0.8);
    }

    .btn-create {
      width: 100%;
      padding: 14px;
      border: none;
      background: linear-gradient(90deg, #00f2fe, #4facfe);
      color: #000;
      font-size: 1.1em;
      border-radius: 10px;
      font-weight: 600;
      transition: 0.3s;
      margin-top: 20px;
      box-shadow: 0 0 15px rgba(0,242,254,0.6);
    }
    .btn-create:hover {
      transform: translateY(-2px);
      box-shadow: 0 0 25px rgba(79,172,254,0.8);
    }

    .pagination-container {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    .search-form input {
      border-radius: 8px;
      border: 1px solid rgba(0,242,254,0.4);
      background: rgba(255,255,255,0.08);
      color: #fff;
    }
    .search-form input:focus {
      outline: none;
      border: 1px solid #00f2fe;
      box-shadow: 0 0 10px #00f2fe;
      background: rgba(255,255,255,0.15);
    }

    .search-form button {
      background: #00f2fe;
      border: none;
      color: #000;
      font-weight: 600;
      border-radius: 8px;
      padding: 8px 16px;
    }
    .search-form button:hover {
      box-shadow: 0 0 15px #00f2fe;
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    
    <div class="dashboard-header">
      <h2>
        <?= ($logged_in_user['role'] === 'admin') ? 'Admin Dashboard' : 'User Dashboard'; ?>
      </h2>
      <a href="<?=site_url('auth/logout'); ?>"><button class="logout-btn">Logout</button></a>
    </div>

    <?php if(!empty($logged_in_user)): ?>
      <div class="user-status mb-3">
        <strong>Welcome:</strong> <?= html_escape($logged_in_user['username']); ?>
      </div>
    <?php else: ?>
      <div class="user-status error mb-3">
        Logged in user not found
      </div>
    <?php endif; ?>

    <!-- Search + Table -->
    <div class="table-card">
      <form action="<?=site_url('users');?>" method="get" class="d-flex mb-3 search-form">
        <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
        <input name="q" type="text" class="form-control me-2" placeholder="Search" value="<?=html_escape($q);?>">
        <button type="submit">Search</button>
      </form>

      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <?php if ($logged_in_user['role'] === 'admin'): ?>
              <th>Password</th>
              <th>Role</th>
            <?php endif; ?>
            <th>Action</th>
          </tr>
          <?php foreach ($user as $user): ?>
          <tr>
            <td><?=html_escape($user['id']); ?></td>
            <td><?=html_escape($user['username']); ?></td>
            <td><?=html_escape($user['email']); ?></td>
            <?php if ($logged_in_user['role'] === 'admin'): ?>
              <td>*******</td>
              <td><?= html_escape($user['role']); ?></td>
            <?php endif; ?>
            <td>
              <a href="<?=site_url('/users/update/'.$user['id']);?>" class="btn-action btn-update">Update</a>
              <a href="<?=site_url('/users/delete/'.$user['id']);?>" class="btn-action btn-delete">Delete</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </table>
      </div>

      <div class="pagination-container">
        <?php echo $page; ?>
      </div>
    </div>

    <a href="<?=site_url('users/create'); ?>" class="btn-create">+ Create New User</a>
  </div>
</body>
</html>
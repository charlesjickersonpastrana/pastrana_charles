<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Index</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background: #f8f9fa; }
        h1 { color: #333; }
        .top-actions { margin-bottom: 15px; }
        .btn { padding: 8px 14px; text-decoration: none; border-radius: 4px; font-size: 14px; font-weight: bold; }
        .btn-create { background: #007bff; color: white; }
        .btn-create:hover { background: #0056b3; }
        .btn-edit { background: #28a745; color: white; }
        .btn-edit:hover { background: #218838; }
        .btn-delete { background: #dc3545; color: white; }
        .btn-delete:hover { background: #c82333; }
        table { width: 80%; border-collapse: collapse; margin-top: 20px; background: #fff;
                box-shadow: 0 2px 6px rgba(0,0,0,0.1); border-radius: 6px; overflow: hidden; }
        th, td { border: 1px solid #ddd; padding: 12px 15px; text-align: left; }
        th { background: #007bff; color: #fff; text-transform: uppercase; }
        tr:nth-child(even) { background: #f9f9f9; }
    </style>
</head>
<body>
    <h1>User Index</h1>
    <div class="top-actions">
        <a href="<?= site_url('users/create'); ?>" class="btn btn-create">➕ Create New User</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>  
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= html_escape($user['id']); ?></td>
                        <td><?= html_escape($user['username']); ?></td>
                        <td><?= html_escape($user['email']); ?></td>
                        <td>
                            <a class="btn btn-edit" href="<?= site_url('users/update/'.$user['id']); ?>">Edit</a>
                            <a class="btn btn-delete" href="<?= site_url('users/delete/'.$user['id']); ?>" onclick="return confirm('Delete this user?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No users found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

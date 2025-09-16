<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background: #f8f9fa; }
        h1 { color: #333; }
        form { background: #fff; padding: 20px; width: 320px;
               border-radius: 6px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
        label { display: block; margin-bottom: 6px; font-weight: bold; }
        input[type="text"], input[type="email"] {
            width: 100%; padding: 8px; margin-bottom: 12px;
            border: 1px solid #ccc; border-radius: 4px;
        }
        button { background: #007bff; color: white; padding: 8px 14px;
                 border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <h1>Create User</h1>
    <form method="post" action="<?= site_url('users/create/'.segment(4)); ?>">
        <label>Username:</label>
        <input type="text" name="username" 
               value="<?= html_escape($user['username']); ?>" 
               required>

        <label>Email:</label>
        <input type="email" name="email" 
               value="<?= html_escape($user['email']); ?>" 
               required>

        <button type="submit">Save User</button>
    </form>
</body>
</html>

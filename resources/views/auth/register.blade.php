<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body { font-family: Arial; background: #f4f4f4; }
    .container { max-width: 400px; margin: 80px auto; background: #fff; padding: 32px; border-radius: 12px; box-shadow: 0 4px 16px rgba(0,0,0,0.1); }
    .error { background: #ffe6e6; color: #b00020; padding: 10px; border-radius: 8px; margin-bottom: 16px; text-align: center; }
    .link { text-align: center; margin-top: 20px; }
    .link a button { background-color: #007bff; color: white; border: none; padding: 10px 16px; border-radius: 8px; cursor: pointer; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Sign Up</h2>
    
    <!-- Display errors -->
    <?php if(isset($errors) && $errors->any()): ?>
      <div class="error">
        <?php foreach($errors->all() as $error): ?>
          <?php echo $error; ?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="/register">
      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
      
      <label>Username</label>
      <input type="text" name="username" required><br><br>
      
      <label>Email</label>
      <input type="email" name="email" required><br><br>
      
      <label>Password</label>
      <input type="password" name="password" required><br><br>
      
      <button type="submit"><i class="fas fa-user-plus"></i> Register</button>
    </form>
    
    <div class="link">
      <a href="/login">
        <button><i class="fas fa-arrow-left"></i> Back to Login</button>
      </a>
    </div>
  </div>
</body>
</html>
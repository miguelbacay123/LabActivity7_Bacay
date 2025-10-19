<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body { font-family: Arial; background: #f4f4f4; }
    .container {
      max-width: 400px;
      margin: 80px auto;
      background: #fff;
      padding: 32px;
      border-radius: 12px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      margin-bottom: 10px;
    }
    .subtitle {
      text-align: center;
      margin-bottom: 30px;
      font-size: 0.95em;
      color: #666;
    }
    .error {
      background: #ffe6e6;
      color: #b00020;
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 16px;
      text-align: center;
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }
    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }
    button {
      width: 100%;
      background-color: #007bff;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 8px;
      font-size: 1em;
      cursor: pointer;
      margin-top: 20px;
    }
    .link {
      text-align: center;
      margin-top: 20px;
    }
    .link a button {
      background-color: #28a745;
      color: white;
      border: none;
      padding: 10px 16px;
      border-radius: 8px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Welcome to Student Management System</h2>
    <div class="subtitle">Enter your credentials to login</div>

    @if($errors->any())
      <div class="error">
        @foreach($errors->all() as $error)
          {{ $error }}
        @endforeach
      </div>
    @endif

    <form method="POST" action="/login">
      @csrf <!-- Add this line -->
      
      <label for="username">Username</label>
      <input type="text" name="username" id="username" required>

      <label for="password">Password</label>
      <input type="password" name="password" id="password" required>

      <button type="submit"><i class="fas fa-sign-in-alt"></i> Login</button>
    </form>

    <div class="link">
      <a href="/register"><button><i class="fas fa-user-plus"></i> Sign Up</button></a>
    </div>
  </div>
</body>
</html>
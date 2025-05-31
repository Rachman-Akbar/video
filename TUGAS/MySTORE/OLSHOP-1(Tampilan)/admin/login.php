<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Toko Fashion Online</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: url('https://images.unsplash.com/photo-1503341455253-b2e723bb3dbb?auto=format&fit=crop&w=1920&q=80') no-repeat center center;
      background-size: cover;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-card {
      background-color: rgba(255, 255, 255, 0.95);
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 500px;
    }

    h3 {
      font-weight: bold;
      margin-bottom: 1.5rem;
      text-align: center;
    }

    label {
      font-weight: 500;
    }

    .form-text {
      text-align: center;
    }

    .form-text a {
      text-decoration: none;
    }
  </style>
</head>
<body>

  <div class="login-card">
    <h3>Login Admin</h3>
    <form>
      <div class="mb-3">
        <label for="email">Email</label>
        <input type="email" id="email" class="form-control" placeholder="Masukkan email" required>
      </div>
      <div class="mb-3">
        <label for="password">Password</label>
        <input type="password" id="password" class="form-control" placeholder="Masukkan password" required>
      </div>
      <button class="btn btn-primary w-100 mb-3">Login</button>
    </form>
  </div>

</body>
</html>

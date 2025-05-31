  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: url('images/ecommerce.jpg') no-repeat center center;
      background-size: cover;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .register-card {
      background-color: rgba(255, 255, 255, 0.95);
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 500px;
    }

    label {
      font-weight: 500;
    }

    h3 {
      font-weight: bold;
      margin-bottom: 1.5rem;
      text-align: center;
    }
  </style>
</head>
<body>

  <div class="register-card">
    <h3>Register</h3>
    <form>
      <div class="mb-3">
        <label for="username">Username</label>
        <input type="text" id="username" class="form-control" placeholder="Masukkan username" required>
      </div>
      <div class="mb-3">
        <label for="email">Email</label>
        <input type="email" id="email" class="form-control" placeholder="Masukkan email" required>
      </div>
      <div class="mb-3">
        <label for="password">Password</label>
        <input type="password" id="password" class="form-control" placeholder="Masukkan password" required>
      </div>
      <div class="mb-3">
        <label for="confirmPassword">Konfirmasi Password</label>
        <input type="password" id="confirmPassword" class="form-control" placeholder="Ulangi password" required>
      </div>
      <button class="btn btn-primary w-100">Buat Akun</button>
    </form>
  </div>

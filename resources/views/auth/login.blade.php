<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - SiPrnayana Support</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="login-container">
        <!-- Logo Placeholder -->
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo" />
        <!-- Nama Sistem -->
        <div class="system-title">Sipranayana Support</div>

        <form method="POST" action="{{ route('login') }}" id="loginForm" novalidate>
            @csrf
            <div class="form-group">
                <input type="text" id="email" name="email" required placeholder=" " />
                <label for="email">Email</label>
                <div class="error-message" id="userError"></div>
            </div>

            <div class="form-group" style="position: relative;">
                <input type="password" id="password" name="password" required placeholder=" " />
                <label for="password">Password</label>
                <span class="toggle-password" onclick="togglePassword()">👁️</span>
                <div class="error-message" id="passError"></div>
            </div>

            <button type="submit" class="login-btn">Login</button>
        </form>

        <div class="error-message" id="userError">
            @error('email')
                {{ $message }}
            @enderror
        </div>

        <div class="error-message" id="passError">
            @error('password')
                {{ $message }}
            @enderror
        </div>

    </div>

    <script>
        function togglePassword() {
            const passInput = document.getElementById('password');
            passInput.type = passInput.type === 'password' ? 'text' : 'password';
        }

        // Frontend Validasi
        document.getElementById("loginForm").addEventListener("submit", function(e) {
            let valid = true;
            const email = document.getElementById("email");
            const password = document.getElementById("password");
            const userError = document.getElementById("userError");
            const passError = document.getElementById("passError");

            userError.textContent = "";
            passError.textContent = "";

            if (email.value.trim() === "") {
                userError.textContent = "Email wajib diisi.";
                valid = false;
            }

            if (password.value.trim() === "") {
                passError.textContent = "Password wajib diisi.";
                valid = false;
            }

            if (!valid) {
                e.preventDefault();
            }
        });
    </script>
</body>

</html>

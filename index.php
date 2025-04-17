<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
   <link rel="stylesheet" href="stylish.css"
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form id="loginForm" onsubmit="return login()">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" id="password"name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.html">Sign Up</a></p>
        <p><a href="#">Forgot Password?</a></p>
    </div>

    <script>
        function login() {
            const storedData = JSON.parse(localStorage.getItem('userData'));
            const email = document.querySelector('input[name="email"]').value;
            const password = document.querySelector('input[name="password"]').value;

            if (email === storedData.email && password === storedData.password) {
                alert("logged in successsful");
                window.location.href = 'home.html';
            } else {
                alert('Invalid credentials!');
            }
            return false;
        }

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // In a real app, you would validate with server
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            
            // Simple validation for demo
            if(username && password) {
                // Set session flag
                sessionStorage.setItem('isAuthenticated', 'true');
                
                // Redirect to dashboard
                window.location.href = 'home.html';
                
                // Prevent back navigation to login
                history.pushState(null, null, 'home.html');
            } else {
                alert('Please enter both username and password');
            }
        });
        
        // If already logged in, redirect to home
        if(sessionStorage.getItem('isAuthenticated')) {
            window.location.href = 'home.html';
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up Success</title>
    <style>
        .dialog-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.dialog-box {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
}

.dialog-box button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.dialog-box button:hover {
    background-color: #0056b3;
}

        </style>
</head>
<body>
    <div class="dialog-container">
        <div class="dialog-box">
            <p>Registration successful!</p>
            <button onclick="redirectToLogin()">OK</button>
        </div>
    </div>

    <script>
        function redirectToLogin() {
            // Redirect to login page
            window.location.href = "index.html";
        }
    </script>
</body>
</html>

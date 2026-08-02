<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Library Management System</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center px-4">

        <div class="bg-white w-full max-w-md rounded-xl shadow-md p-8">

            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">
                    Library Management
                </h1>

                <p class="text-gray-500 mt-2">
                    Admin Portal
                </p>
            </div>

            <form id="loginForm">

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Username
                    </label>

                    <input
                        type="text"
                        id="username"
                        placeholder="Enter username"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 outline-none focus:border-blue-500">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        placeholder="Enter password"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 outline-none focus:border-blue-500">
                </div>

                <p id="error" class="text-red-500 text-sm mb-4 hidden">
                    Invalid username or password
                </p>

                <button
                    type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition">
                    Login
                </button>

            </form>

            <p class="text-center text-sm text-gray-400 mt-6">
                Library Management System
            </p>

        </div>

    </div>

    <script src="assets/js/data.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>
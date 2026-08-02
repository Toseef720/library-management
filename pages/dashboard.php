<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard | Library Management</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white p-5">

            <div class="mb-10">
                <h1 class="text-xl font-bold">Library Admin</h1>
                <p class="text-gray-400 text-sm mt-1">Management System</p>
            </div>

            <nav class="space-y-2">

                <a href="dashboard.php"
                    class="block bg-blue-600 px-4 py-3 rounded-lg">
                    Dashboard
                </a>

                <a href="books.php"
                    class="block px-4 py-3 rounded-lg hover:bg-gray-800">
                    Books
                </a>

                <a href="issue-return.php"
                    class="block px-4 py-3 rounded-lg hover:bg-gray-800">
                    Issue / Return
                </a>

            </nav>

            <div class="mt-10">
                <a href="../index.php"
                    class="block px-4 py-3 rounded-lg text-red-400 hover:bg-gray-800">
                    Logout
                </a>
            </div>

        </aside>


        <!-- Main Content -->
        <main class="flex-1 p-8">

            <!-- Header -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800">
                    Dashboard
                </h2>

                <p class="text-gray-500 mt-1">
                    Welcome back, Admin
                </p>
            </div>


            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <p class="text-gray-500 text-sm">Total Books</p>
                    <h3 id="totalBooks"class="text-3xl font-bold mt-2">120</h3>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <p class="text-gray-500 text-sm">Available Books</p>
                    <h3 id="availableBooks" class="text-3xl font-bold mt-2">85</h3>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <p class="text-gray-500 text-sm">Issued Books</p>
                    <h3 id="issuedCount"  class="text-3xl font-bold mt-2">35</h3>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <p class="text-gray-500 text-sm">Overdue Books</p>
                    <h3 id="overdueCount" class="text-3xl font-bold mt-2">4</h3>
                </div>

            </div>


            <!-- Recent Issues -->
            <div class="bg-white rounded-xl shadow-sm mt-8">

                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Recent Issues
                    </h3>
                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-left">

                        <thead class="bg-gray-50 text-gray-500 text-sm">
                            <tr>
                                <th class="px-6 py-4">Student</th>
                                <th class="px-6 py-4">Book</th>
                                <th class="px-6 py-4">Issue Date</th>
                                <th class="px-6 py-4">Due Date</th>
                                <th class="px-6 py-4">Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr class="border-t border-gray-100">
                                <td class="px-6 py-4">Rahul Sharma</td>
                                <td class="px-6 py-4">Clean Code</td>
                                <td class="px-6 py-4">01 Aug 2026</td>
                                <td class="px-6 py-4">15 Aug 2026</td>
                                <td class="px-6 py-4">
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                        Issued
                                    </span>
                                </td>
                            </tr>

                            <tr class="border-t border-gray-100">
                                <td class="px-6 py-4">Aman Verma</td>
                                <td class="px-6 py-4">Database Systems</td>
                                <td class="px-6 py-4">29 Jul 2026</td>
                                <td class="px-6 py-4">12 Aug 2026</td>
                                <td class="px-6 py-4">
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                        Issued
                                    </span>
                                </td>
                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </main>

    </div>


    <script src="../assets/js/data.js"></script>
    <script src="../assets/js/dashboard.js"></script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Issue / Return | Library Management</title>

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
               class="block px-4 py-3 rounded-lg hover:bg-gray-800">
                Dashboard
            </a>

            <a href="books.php"
               class="block px-4 py-3 rounded-lg hover:bg-gray-800">
                Books
            </a>

            <a href="issue-return.php"
               class="block bg-blue-600 px-4 py-3 rounded-lg">
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
        <div class="flex justify-between items-center mb-8">

            <div>
                <h2 class="text-3xl font-bold text-gray-800">
                    Issue / Return
                </h2>

                <p class="text-gray-500 mt-1">
                    Manage issued library books
                </p>
            </div>

            <button
                onclick="openIssueModal()"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg font-medium">
                + Issue Book
            </button>

        </div>


        <!-- Search -->
        <div class="bg-white p-5 rounded-xl shadow-sm mb-6">

            <input
                id="issueSearch"
                type="text"
                placeholder="Search student, roll number or book..."
                class="w-full md:w-96 border border-gray-300 rounded-lg px-4 py-3 outline-none focus:border-blue-500"
            >

        </div>


        <!-- Issued Books Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead class="bg-gray-50 text-gray-500 text-sm">

                        <tr>
                            <th class="px-6 py-4">Student</th>
                            <th class="px-6 py-4">Roll No.</th>
                            <th class="px-6 py-4">Book</th>
                            <th class="px-6 py-4">Issue Date</th>
                            <th class="px-6 py-4">Due Date</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Action</th>
                        </tr>

                    </thead>

                    <tbody id="issueTable"></tbody>

                </table>

            </div>

        </div>

    </main>

</div>


<!-- Issue Book Modal -->
<div
    id="issueModal"
    class="fixed inset-0 bg-black/50 hidden items-center justify-center p-4">

    <div class="bg-white rounded-xl w-full max-w-lg p-6">

        <div class="flex justify-between items-center mb-6">

            <h3 class="text-xl font-semibold">
                Issue Book
            </h3>

            <button
                onclick="closeIssueModal()"
                class="text-gray-500 text-xl">
                ×
            </button>

        </div>


        <form id="issueForm" class="space-y-4">

            <input
                id="studentName"
                type="text"
                placeholder="Student Name"
                required
                class="w-full border rounded-lg px-4 py-3"
            >

            <input
                id="rollNo"
                type="text"
                placeholder="Roll Number"
                required
                class="w-full border rounded-lg px-4 py-3"
            >


            <select
                id="issueBook"
                required
                class="w-full border rounded-lg px-4 py-3">

                <option value="">Select Book</option>

            </select>


            <div>
                <label class="text-sm text-gray-600">
                    Issue Date
                </label>

                <input
                    id="issueDate"
                    type="date"
                    required
                    class="w-full border rounded-lg px-4 py-3 mt-1"
                >
            </div>


            <div>
                <label class="text-sm text-gray-600">
                    Due Date
                </label>

                <input
                    id="dueDate"
                    type="date"
                    required
                    class="w-full border rounded-lg px-4 py-3 mt-1"
                >
            </div>


            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium">

                Issue Book

            </button>

        </form>

    </div>

</div>


<script src="../assets/js/data.js"></script>
<script src="../assets/js/issue-return.js"></script>

</body>
</html>
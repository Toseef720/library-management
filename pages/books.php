<?php

require_once "../config/database.php";

$result = $conn->query("SELECT * FROM books ORDER BY id DESC");

$books = [];

while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books | Library Management</title>

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
                    class="block bg-blue-600 px-4 py-3 rounded-lg">
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


        <!-- Main -->
        <main class="flex-1 p-8">

            <!-- Header -->
            <div class="flex justify-between items-center mb-8">

                <div>
                    <h2 class="text-3xl font-bold text-gray-800">
                        Books
                    </h2>

                    <p class="text-gray-500 mt-1">
                        Manage library books
                    </p>
                </div>

                <button
                    onclick="openBookModal()"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg font-medium">
                    + Add Book
                </button>

            </div>

            <?php if (isset($_GET["success"])): ?>

                <div
                    id="message"
                    class="bg-green-100 text-green-700 px-5 py-4 rounded-lg mb-6">

                    <?php if ($_GET["success"] === "added"): ?>
                        Book added successfully.
                    <?php elseif ($_GET["success"] === "updated"): ?>
                        Book updated successfully.
                    <?php elseif ($_GET["success"] === "deleted"): ?>
                        Book deleted successfully.
                    <?php endif; ?>

                </div>

            <?php endif; ?>


            <?php if (isset($_GET["error"]) && $_GET["error"] === "has_history"): ?>

                <div
                    id="message"
                    class="bg-red-100 text-red-700 px-5 py-4 rounded-lg mb-6">
                    Cannot delete this book because it has existing issue/return records.
                </div>

            <?php endif; ?>


            <!-- Search -->
            <div class="bg-white p-5 rounded-xl shadow-sm mb-6">

                <input
                    type="text"
                    id="bookSearch"
                    placeholder="Search by title, author or ISBN..."
                    class="w-full md:w-96 border border-gray-300 rounded-lg px-4 py-3 outline-none focus:border-blue-500">

            </div>


            <!-- Books Table -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="w-full text-left">

                        <thead class="bg-gray-50 text-gray-500 text-sm">

                            <tr>
                                <th class="px-6 py-4">Title</th>
                                <th class="px-6 py-4">Author</th>
                                <th class="px-6 py-4">Category</th>
                                <th class="px-6 py-4">ISBN</th>
                                <th class="px-6 py-4">Quantity</th>
                                <th class="px-6 py-4">Available</th>
                                <th class="px-6 py-4">Actions</th>
                            </tr>

                        </thead>

                        <tbody id="bookTable"></tbody>

                    </table>

                </div>

            </div>

        </main>

    </div>


    <!-- Add Book Modal -->
    <div
        id="bookModal"
        class="fixed inset-0 bg-black/50 hidden items-center justify-center p-4">

        <div class="bg-white rounded-xl w-full max-w-lg p-6">

            <div class="flex justify-between items-center mb-6">

                <h3 id="bookModalTitle" class="text-xl font-semibold">
                    Add Book
                </h3>

                <button
                    onclick="closeBookModal()"
                    class="text-gray-500 text-xl">
                    ×
                </button>

            </div>


            <form id="bookForm" action="../actions/add-book.php" method="post" class="space-y-4">
                <input type="hidden" id="bookId" name="id">
                <input
                    id="bookTitle"
                    name="title"
                    type="text"
                    placeholder="Book Title"
                    required
                    class="w-full border rounded-lg px-4 py-3">

                <input
                    id="bookAuthor"
                    name="author"
                    type="text"
                    placeholder="Author"
                    required
                    class="w-full border rounded-lg px-4 py-3">

                <input
                    id="bookCategory"
                    name="category"
                    type="text"
                    placeholder="Category"
                    required
                    class="w-full border rounded-lg px-4 py-3">

                <input
                    id="bookISBN"
                    name="isbn"
                    type="text"
                    placeholder="ISBN"
                    required
                    class="w-full border rounded-lg px-4 py-3">

                <input
                    id="bookQuantity"
                    name="quantity"
                    type="number"
                    min="1"
                    placeholder="Quantity"
                    required
                    class="w-full border rounded-lg px-4 py-3">

                <button
                    id="bookSubmitButton"
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium">
                    Add Book
                </button>

            </form>

        </div>

    </div>

    <script>
        const books = <?php echo json_encode($books); ?>
    </script>
    <script src="../assets/js/books.js"></script>

    <script>
        const message = document.getElementById("message");

        if (message) {
            setTimeout(function() {
                message.remove();
            }, 3000);
        }
    </script>

</body>

</html>
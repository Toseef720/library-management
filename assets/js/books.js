const bookTable = document.getElementById("bookTable");
const bookSearch = document.getElementById("bookSearch");
const bookForm = document.getElementById("bookForm");
let editingBookId = null;

function displayBooks(data) {

    bookTable.innerHTML = "";

    for (let i = 0; i < data.length; i++) {

        bookTable.innerHTML += `
            <tr class="border-t border-gray-100">

                <td class="px-6 py-4 font-medium">
                    ${data[i].title}
                </td>

                <td class="px-6 py-4">
                    ${data[i].author}
                </td>

                <td class="px-6 py-4">
                    ${data[i].category}
                </td>

                <td class="px-6 py-4">
                    ${data[i].isbn}
                </td>

                <td class="px-6 py-4">
                    ${data[i].quantity}
                </td>

                <td class="px-6 py-4">
                    ${data[i].available}
                </td>

                <td class="px-6 py-4">

                    <button
                        onclick="editBook(${data[i].id})"
                        class="text-blue-600 mr-3">
                        Edit
                    </button>

                    <button
                        onclick="deleteBook(${data[i].id})"
                        class="text-red-600">
                        Delete
                    </button>

                </td>

            </tr>
        `;
    }
}

displayBooks(books);

function deleteBook(id) {

    const confirmDelete = confirm(
        "Are you sure you want to delete this book?"
    );

    if (!confirmDelete) {
        return;
    }

    window.location.href =
        "../actions/delete-book.php?id=" + id;
}

function editBook(id) {

    let selectedBook = null;

    for (let i = 0; i < books.length; i++) {

        if (Number(books[i].id) === Number(id)) {
            selectedBook = books[i];
            break;
        }
    }

    if (selectedBook === null) {
        return;
    }

    document.getElementById("bookId").value = selectedBook.id;
    document.getElementById("bookTitle").value = selectedBook.title;
    document.getElementById("bookAuthor").value = selectedBook.author;
    document.getElementById("bookCategory").value = selectedBook.category;
    document.getElementById("bookISBN").value = selectedBook.isbn;
    document.getElementById("bookQuantity").value = selectedBook.quantity;

    document.getElementById("bookModalTitle").innerText = "Edit Book";
    document.getElementById("bookSubmitButton").innerText = "Update Book";

    bookForm.action = "../actions/edit-book.php";

    const modal = document.getElementById("bookModal");

    modal.classList.remove("hidden");
    modal.classList.add("flex");
}


bookSearch.addEventListener("input", function() {

    const value = bookSearch.value.toLowerCase();

    const filteredBooks = books.filter(function(book) {

        return (
            book.title.toLowerCase().includes(value) ||
            book.author.toLowerCase().includes(value) ||
            book.isbn.includes(value)
        );

    });

    displayBooks(filteredBooks);
});

function openBookModal() {

    bookForm.reset();

    document.getElementById("bookId").value = "";

    document.getElementById("bookModalTitle").innerText = "Add Book";
    document.getElementById("bookSubmitButton").innerText = "Add Book";

    bookForm.action = "../actions/add-book.php";

    const modal = document.getElementById("bookModal");

    modal.classList.remove("hidden");
    modal.classList.add("flex");
}

function closeBookModal() {

    const modal = document.getElementById("bookModal");

    modal.classList.add("hidden");
    modal.classList.remove("flex");
}



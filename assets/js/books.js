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

    const confirmDelete = confirm("Are you sure you want to delete this book?");

    if (!confirmDelete) {
        return;
    }

    for (let i = 0; i < books.length; i++) {

        if (books[i].id === id) {
            books.splice(i, 1);
            break;
        }
    }

    displayBooks(books);
}

function editBook(id) {

    let selectedBook = null;

    for (let i = 0; i < books.length; i++) {

        if (books[i].id === id) {
            selectedBook = books[i];
            break;
        }
    }

    if (selectedBook === null) {
        return;
    }

    editingBookId = id;

    document.getElementById("bookTitle").value = selectedBook.title;
    document.getElementById("bookAuthor").value = selectedBook.author;
    document.getElementById("bookCategory").value = selectedBook.category;
    document.getElementById("bookISBN").value = selectedBook.isbn;
    document.getElementById("bookQuantity").value = selectedBook.quantity;

    document.getElementById("bookModalTitle").innerText = "Edit Book";
    document.getElementById("bookSubmitButton").innerText = "Update Book";

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

    editingBookId = null;

    bookForm.reset();

    document.getElementById("bookModalTitle").innerText = "Add Book";
    document.getElementById("bookSubmitButton").innerText = "Add Book";

    const modal = document.getElementById("bookModal");

    modal.classList.remove("hidden");
    modal.classList.add("flex");
}

function closeBookModal() {

    const modal = document.getElementById("bookModal");

    modal.classList.add("hidden");
    modal.classList.remove("flex");
}


bookForm.addEventListener("submit", function(e) {

    e.preventDefault();

    const title = document.getElementById("bookTitle").value;
    const author = document.getElementById("bookAuthor").value;
    const category = document.getElementById("bookCategory").value;
    const isbn = document.getElementById("bookISBN").value;
    const quantity = Number(document.getElementById("bookQuantity").value);

    if (editingBookId === null) {

        const book = {
            id: Date.now(),
            title: title,
            author: author,
            category: category,
            isbn: isbn,
            quantity: quantity,
            available: quantity
        };

        books.push(book);

    } else {

        for (let i = 0; i < books.length; i++) {

            if (books[i].id === editingBookId) {

                const issued = books[i].quantity - books[i].available;

                books[i].title = title;
                books[i].author = author;
                books[i].category = category;
                books[i].isbn = isbn;
                books[i].quantity = quantity;
                books[i].available = Math.max(quantity - issued, 0);

                break;
            }
        }

        editingBookId = null;
    }

    displayBooks(books);

    bookForm.reset();

    closeBookModal();
});
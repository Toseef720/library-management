const issueTable = document.getElementById("issueTable");
const issueForm = document.getElementById("issueForm");
const issueSearch = document.getElementById("issueSearch");
const bookSelect = document.getElementById("issueBook");


// Find book using book ID
function getBook(bookId) {

    for (let i = 0; i < books.length; i++) {

        if (Number(books[i].id) === Number(bookId)) {
            return books[i];
        }
    }

    return null;
}


// Load available books in dropdown
function loadBooks() {

    bookSelect.innerHTML =
        '<option value="">Select Book</option>';

    for (let i = 0; i < books.length; i++) {

        if (Number(books[i].available) > 0) {

            bookSelect.innerHTML += `
                <option value="${books[i].id}">
                    ${books[i].title}
                    (${books[i].available} available)
                </option>
            `;
        }
    }
}


// Display issue records
function displayIssues(data) {

    issueTable.innerHTML = "";

    for (let i = 0; i < data.length; i++) {

        const book = getBook(data[i].book_id);

        if (book === null) {
            continue;
        }


        let statusStyle =
            "bg-yellow-100 text-yellow-700";

        if (data[i].status === "Overdue") {

            statusStyle =
                "bg-red-100 text-red-700";
        }

        if (data[i].status === "Returned") {

            statusStyle =
                "bg-green-100 text-green-700";
        }


        let action = "-";

        if (data[i].status !== "Returned") {

            action = `
                <button
                    onclick="returnBook(${data[i].id})"
                    class="text-blue-600 font-medium">
                    Return
                </button>
            `;
        }


        issueTable.innerHTML += `
            <tr class="border-t border-gray-100">

                <td class="px-6 py-4">
                    ${data[i].student_name}
                </td>

                <td class="px-6 py-4">
                    ${data[i].roll_no}
                </td>

                <td class="px-6 py-4">
                    ${book.title}
                </td>

                <td class="px-6 py-4">
                    ${data[i].issue_date}
                </td>

                <td class="px-6 py-4">
                    ${data[i].due_date}
                </td>

                <td class="px-6 py-4">

                    <span class="${statusStyle} px-3 py-1 rounded-full text-sm">
                        ${data[i].status}
                    </span>

                </td>

                <td class="px-6 py-4">
                    ${action}
                </td>

            </tr>
        `;
    }
}


// Open Issue Book modal
function openIssueModal() {

    issueForm.reset();

    loadBooks();

    const modal =
        document.getElementById("issueModal");

    modal.classList.remove("hidden");
    modal.classList.add("flex");
}


// Close Issue Book modal
function closeIssueModal() {

    const modal =
        document.getElementById("issueModal");

    modal.classList.add("hidden");
    modal.classList.remove("flex");
}


// Return book
function returnBook(id) {

    const confirmReturn =
        confirm("Mark this book as returned?");

    if (!confirmReturn) {
        return;
    }

    window.location.href =
        "../actions/return-book.php?id=" + id;
}


// Search issue records
issueSearch.addEventListener("input", function() {

    const value =
        issueSearch.value.trim().toLowerCase();

    const filteredIssues = [];

    for (let i = 0; i < issuedBooks.length; i++) {

        const book =
            getBook(issuedBooks[i].book_id);

        const studentName =
            issuedBooks[i].student_name.toLowerCase();

        const rollNo =
            issuedBooks[i].roll_no
                .toString()
                .toLowerCase();

        const bookTitle =
            book ? book.title.toLowerCase() : "";

        if (
            studentName.includes(value) ||
            rollNo.includes(value) ||
            bookTitle.includes(value)
        ) {
            filteredIssues.push(issuedBooks[i]);
        }
    }

    displayIssues(filteredIssues);
});


// Initial page load
loadBooks();
displayIssues(issuedBooks);
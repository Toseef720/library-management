const issueTable = document.getElementById("issueTable");
const issueForm = document.getElementById("issueForm");
const issueSearch = document.getElementById("issueSearch");
const bookSelect = document.getElementById("issueBook");


function getBook(bookId) {

    for (let i = 0; i < books.length; i++) {

        if (books[i].id === bookId) {
            return books[i];
        }
    }

    return null;
}


function loadBooks() {

    bookSelect.innerHTML = '<option value="">Select Book</option>';

    for (let i = 0; i < books.length; i++) {

        if (books[i].available > 0) {

            bookSelect.innerHTML += `
                <option value="${books[i].id}">
                    ${books[i].title} (${books[i].available} available)
                </option>
            `;
        }
    }
}


function displayIssues(data) {

    issueTable.innerHTML = "";

    for (let i = 0; i < data.length; i++) {

        const book = getBook(data[i].bookId);

        if (book === null) {
            continue;
        }

        let statusStyle = "bg-yellow-100 text-yellow-700";

        if (data[i].status === "Overdue") {
            statusStyle = "bg-red-100 text-red-700";
        }

        if (data[i].status === "Returned") {
            statusStyle = "bg-green-100 text-green-700";
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
                    ${data[i].studentName}
                </td>

                <td class="px-6 py-4">
                    ${data[i].rollNo}
                </td>

                <td class="px-6 py-4">
                    ${book.title}
                </td>

                <td class="px-6 py-4">
                    ${data[i].issueDate}
                </td>

                <td class="px-6 py-4">
                    ${data[i].dueDate}
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

function openIssueModal() {
    issueForm.reset();
    loadBooks();

    const modal = document.getElementById("issueModal");

    modal.classList.remove("hidden");
    modal.classList.add("flex");
}

function closeIssueModal() {
    const modal = document.getElementById("issueModal");

    modal.classList.add("hidden");
    modal.classList.remove("flex");
}


issueForm.addEventListener("submit", function(e) {

    e.preventDefault();

    const studentName = document.getElementById("studentName").value;
    const rollNo = document.getElementById("rollNo").value;
    const bookId = Number(document.getElementById("issueBook").value);
    const issueDate = document.getElementById("issueDate").value;
    const dueDate = document.getElementById("dueDate").value;

    if (dueDate < issueDate) {
        alert("Due date cannot be before issue date");
        return;
    }

    const book = getBook(bookId);

    if (book === null || book.available <= 0) {
        alert("Book is not available");
        return;
    }

    const issue = {
        id: Date.now(),
        studentName: studentName,
        rollNo: rollNo,
        bookId: bookId,
        issueDate: issueDate,
        dueDate: dueDate,
        returnDate: null,
        status: "Issued"
    };

    issuedBooks.push(issue);

    book.available--;

    displayIssues(issuedBooks);

    issueForm.reset();

    closeIssueModal();
});


function returnBook(id) {

    const confirmReturn = confirm("Mark this book as returned?");

    if (!confirmReturn) {
        return;
    }

    for (let i = 0; i < issuedBooks.length; i++) {

        if (issuedBooks[i].id === id) {

            if (issuedBooks[i].status === "Returned") {
                return;
            }

            issuedBooks[i].status = "Returned";

            issuedBooks[i].returnDate =
                new Date().toISOString().split("T")[0];

            const book = getBook(issuedBooks[i].bookId);

            if (book !== null) {
                book.available++;
            }

            break;
        }
    }

    displayIssues(issuedBooks);
    loadBooks();
}

issueSearch.addEventListener("input", function() {

    const value = issueSearch.value.trim().toLowerCase();

    const filteredIssues = [];

    for (let i = 0; i < issuedBooks.length; i++) {

        const book = getBook(issuedBooks[i].bookId);

        const studentName = issuedBooks[i].studentName.toLowerCase();
        const rollNo = issuedBooks[i].rollNo.toString().toLowerCase();
        const bookTitle = book ? book.title.toLowerCase() : "";

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


loadBooks();
displayIssues(issuedBooks);
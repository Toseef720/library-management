let totalBooks = 0;
let availableBooks = 0;
let issuedCount = 0;
let overdueCount = 0;

for (let i = 0; i < books.length; i++) {
    totalBooks += books[i].quantity;
    availableBooks += books[i].available;
}

const today = new Date().toISOString().split("T")[0];

for (let i = 0; i < issuedBooks.length; i++) {

    if (issuedBooks[i].status !== "Returned") {

        if (issuedBooks[i].dueDate < today) {
            issuedBooks[i].status = "Overdue";
        } else {
            issuedBooks[i].status = "Issued";
        }
    }
}

for (let i = 0; i < issuedBooks.length; i++) {

    if (issuedBooks[i].status === "Issued") {
        issuedCount++;
    }

    if (issuedBooks[i].status === "Overdue") {
        overdueCount++;
    }
}

document.getElementById("totalBooks").innerText = totalBooks;
document.getElementById("availableBooks").innerText = availableBooks;
document.getElementById("issuedCount").innerText = issuedCount;
document.getElementById("overdueCount").innerText = overdueCount;
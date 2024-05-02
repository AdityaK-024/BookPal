// Sample book data (replace with your actual book data)
const books = [
    { title: "Dear Zoo", author: "" },
    { title: "The Very Hungry Caterpillar", author: "" },
    { title: "Where is the Green Sheep", author: "" },
    { title: "Giraffes Can't Dance", author: "" },
    { title: "Secret Garden", author: "" },
    { title: "Educated", author: "" },
    { title: "Becoming", author: "" },
    { title: "Good Night Stories for Rebel Girls", author: "" },
    { title: "This is Going to Hurt", author: "" },
    { title: "The Complete MAUS", author: "" },
    { title: "Fantastic Beasts", author: "" },
    { title: "The Mindfulness Colouring Book ", author: "" },
    { title: "Humans of New York", author: "Author 3" },
    { title: "Ways of Seeing", author: "Author 3" },
    { title: "Man's Search For Meaning ", author: "" },
    { title: "Start With Why", author: "Author 3" },
    { title: "Thinking, Fast and Slow", author: "" },
    { title: "How to Win Friends and Influence People", author: "" },
    { title: "The Barefoot Investor<", author: " " },
    { title: " ", author: "" },
    // Add more book objects as needed
];

// Function to filter books based on search query
function searchBooks(query) {
    const filteredBooks = books.filter(book => {
        const titleMatches = book.title.toLowerCase().includes(query.toLowerCase());
        const authorMatches = book.author.toLowerCase().includes(query.toLowerCase());
        return titleMatches || authorMatches;
    });
    return filteredBooks;
}

// Function to display filtered books in the list
function displayBooks(filteredBooks) {
    const bookList = document.getElementById("bookList");
    bookList.innerHTML = ""; // Clear previous list items

    filteredBooks.forEach(book => {
        const listItem = document.createElement("li");
        listItem.textContent = `${book.title} by ${book.author}`;
        bookList.appendChild(listItem);
    });
}

// Event listener for search input
document.getElementById("searchInput").addEventListener("input", function(event) {
    const searchQuery = event.target.value.trim();
    const filteredBooks = searchBooks(searchQuery);
    
    // Display the book list only if there's a search query
    const bookList = document.getElementById("bookList");
    if (searchQuery !== "") {
        bookList.style.display = "block";
        displayBooks(filteredBooks);
    } else {
        bookList.style.display = "none";
    }
});

// Initial hide the book list
document.getElementById("bookList").style.display = "none";

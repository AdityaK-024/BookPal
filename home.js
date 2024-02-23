// Get all "Add to List" buttons
const addToListButtons = document.querySelectorAll('.add-button');

// Add click event listener to each button
addToListButtons.forEach(button => {
    button.addEventListener('click', function() {
        // Toggle the "show" class for the dropdown content when the button is clicked
        const dropdownContent = this.nextElementSibling;
        dropdownContent.classList.toggle('show');

        // Hide the dropdown content when clicking outside of it
        window.addEventListener('click', function(event) {
            if (!dropdownContent.contains(event.target) && !button.contains(event.target)) {
                dropdownContent.classList.remove('show');
            }
        });
    });
});

const dropdownOptions = document.querySelectorAll('.dropdown-content a');

dropdownOptions.forEach(option => {
    option.addEventListener('click', function(e) {
        e.preventDefault();
        const selectedOption = this.textContent;
        const button = this.parentElement.previousElementSibling;

        switch (selectedOption) {
            case 'Currently Reading':
            case 'Read':
            case 'Want to Read':
                button.textContent = selectedOption;
                break;
            case 'Remove from List':
                button.textContent = 'Add to List'
            default:
                break;
        }

        const dropdownContent = button.nextElementSibling;
        dropdownContent.classList.remove('show');
    });
});

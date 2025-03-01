
        
document.addEventListener('DOMContentLoaded', function () {
    const dropdownButtons = document.querySelectorAll('.dropdown-btn');
    dropdownButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const dropdownContainer = this.nextElementSibling;
            dropdownContainer.style.display = (dropdownContainer.style.display === 'block') ? 'none' : 'block';
            this.querySelector('i').classList.toggle('down');
        });
    });
});



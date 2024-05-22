document.getElementById('burger-menu').addEventListener('click', function() {
    document.getElementById('menu-overlay').classList.add('open');
});

document.getElementById('close-menu').addEventListener('click', function() {
    document.getElementById('menu-overlay').classList.remove('open');
});

const dropdowns = document.querySelectorAll('.dropdown-btn');
dropdowns.forEach((dropdown, index) => {
    dropdown.addEventListener('click', function() {
        const content = this.nextElementSibling;
        const isOpen = content.classList.contains('open');
        
        document.querySelectorAll('.dropdown-content').forEach(c => {
            c.classList.remove('open');
            c.previousElementSibling.classList.remove('open');
        });

        if (!isOpen) {
            content.classList.add('open');
            this.classList.add('open');
        }
    });
});
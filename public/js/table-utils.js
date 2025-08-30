document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const table = document.querySelector('table.table tbody');
    const rows = table.querySelectorAll('tr');

    searchInput.addEventListener('keyup', function () {
        const filter = this.value.toLowerCase();

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
});

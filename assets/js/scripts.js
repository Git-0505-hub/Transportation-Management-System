// Script for toggling visibility of navigation menu (mobile-friendly)
document.addEventListener("DOMContentLoaded", () => {
    const toggleMenu = document.querySelector("#toggleMenu");
    const navLinks = document.querySelector(".nav-links");

    if (toggleMenu) {
        toggleMenu.addEventListener("click", () => {
            navLinks.classList.toggle("show");
        });
    }
});

// Confirmation before deletion (used in admin/manage_buses.php and manage_users.php)
function confirmDelete(message = "Are you sure you want to delete this item?") {
    return confirm(message);
}

// Live search for bus routes (used in user/search_buses.php)
function liveSearch(inputId, tableId) {
    const input = document.getElementById(inputId);
    const filter = input.value.toLowerCase();
    const table = document.getElementById(tableId);
    const rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName("td");
        let match = false;

        for (let j = 0; j < cells.length; j++) {
            if (cells[j].innerText.toLowerCase().includes(filter)) {
                match = true;
                break;
            }
        }

        rows[i].style.display = match ? "" : "none";
    }
}

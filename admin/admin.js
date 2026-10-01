document.addEventListener('DOMContentLoaded', () => {
    const adminToggle = document.getElementById('admin-toggle');
    const sidebar = document.querySelector('.sidebar');

    if (adminToggle && sidebar) {
        adminToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            // Toggle icon
            const icon = adminToggle.querySelector('i');
            if (icon.classList.contains('bx-menu')) {
                icon.classList.replace('bx-menu', 'bx-x');
            } else {
                icon.classList.replace('bx-x', 'bx-menu');
            }
        });
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 768) {
            if (!sidebar.contains(e.target) && !adminToggle.contains(e.target) && sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
                const icon = adminToggle.querySelector('i');
                icon.classList.replace('bx-x', 'bx-menu');
            }
        }
    });
});

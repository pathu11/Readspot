document.querySelectorAll('.not-menu-icons').forEach((icons) => {
    icons.addEventListener('click', (e) => {
        document.querySelectorAll('.not-menu-icons.active').forEach((activeIcons) => {
            if (activeIcons !== icons) {
                activeIcons.classList.remove('active');
            }
        });

        icons.classList.toggle('active');

        e.stopPropagation();
    });
});


document.addEventListener('click', () => {
    document.querySelectorAll('.not-menu-icons.active').forEach((icons) => {
        icons.classList.remove('active');
    });
});
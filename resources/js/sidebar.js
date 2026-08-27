document.addEventListener('DOMContentLoaded', () => {
    const btnSidebar = document.getElementById('btn-sidebar');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');

    if (btnSidebar && sidebar && sidebarOverlay) {
        const toggleSidebar = () => {
            sidebar.classList.toggle('-translate-x-full');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                // Ocultar overlay
                sidebarOverlay.classList.remove('opacity-100');
                sidebarOverlay.classList.add('opacity-0');
                setTimeout(() => {
                    sidebarOverlay.classList.add('hidden');
                }, 300); // Esperar la transición antes de ocultar
            } else {
                // Mostrar overlay
                sidebarOverlay.classList.remove('hidden');
                // Pequeño timeout para permitir que el display:block aplique antes de animar opacidad
                setTimeout(() => {
                    sidebarOverlay.classList.remove('opacity-0');
                    sidebarOverlay.classList.add('opacity-100');
                }, 10);
            }
        };

        btnSidebar.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);
    }
});

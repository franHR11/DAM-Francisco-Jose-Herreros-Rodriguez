document.addEventListener('DOMContentLoaded', function() {
    // Ordenamiento
    document.querySelectorAll('.sortable').forEach(headerCell => {
        headerCell.addEventListener('click', () => {
            const table = headerCell.closest('table');
            const columnIndex = headerCell.cellIndex;
            const rows = Array.from(table.querySelectorAll('tbody tr'));
            const isAsc = headerCell.classList.contains('asc');
            
            // Limpiar clases de ordenamiento previas
            document.querySelectorAll('.sortable').forEach(th => {
                th.classList.remove('asc', 'desc');
            });
            
            // Establecer nuevo orden
            headerCell.classList.toggle('desc', isAsc);
            headerCell.classList.toggle('asc', !isAsc);

            // Ordenar filas
            rows.sort((a, b) => {
                let aVal = a.cells[columnIndex].textContent;
                let bVal = b.cells[columnIndex].textContent;
                
                // Intentar ordenar como números si es posible
                if (!isNaN(aVal) && !isNaN(bVal)) {
                    return isAsc ? bVal - aVal : aVal - bVal;
                }
                
                // Ordenar como texto
                return isAsc 
                    ? bVal.localeCompare(aVal) 
                    : aVal.localeCompare(bVal);
            });

            // Reordenar tabla
            rows.forEach(row => table.querySelector('tbody').appendChild(row));
        });
    });

    // Filtrado
    document.querySelectorAll('.column-filter').forEach(input => {
        input.addEventListener('keyup', () => {
            const columnIndex = input.parentElement.cellIndex;
            const filterValue = input.value.toLowerCase();
            const table = input.closest('table');
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const cell = row.cells[columnIndex];
                const value = cell.textContent.toLowerCase();
                row.style.display = value.includes(filterValue) ? '' : 'none';
            });
        });
    });
});

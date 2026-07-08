import './bootstrap';

// Alpine is bundled and started by Livewire 3, so it is not imported here.

// Enhance admin list tables with search / sort / pagination (dependency-free).
import { DataTable } from 'simple-datatables';

function initDataTables() {
    document.querySelectorAll('table[data-datatable]').forEach((table) => {
        if (table.dataset.dtReady) return;
        // Skip tiny tables (a single empty-state row isn't worth paginating).
        const rows = table.tBodies[0] ? table.tBodies[0].rows.length : 0;
        if (rows < 2) return;

        table.dataset.dtReady = '1';
        new DataTable(table, {
            perPage: 10,
            perPageSelect: [10, 25, 50, 100],
            searchable: true,
            sortable: true,
            // Fluid columns so the table stays within its (scrollable) container
            // on small screens instead of forcing a wide fixed layout.
            fixedColumns: false,
            fixedHeight: false,
            labels: {
                placeholder: 'Rechercher…',
                perPage: 'par page',
                noRows: 'Aucun résultat',
                info: '{start}–{end} sur {rows}',
                noResults: 'Aucun résultat pour cette recherche',
            },
        });
    });
}

document.addEventListener('DOMContentLoaded', initDataTables);

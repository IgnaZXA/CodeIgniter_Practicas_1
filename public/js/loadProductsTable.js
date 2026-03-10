window.onload = function () {
    let table = new DataTable('#usersTable', {

        ajax: {
            url: '/api/products',
            dataSrc: 'data'
        },

        columns: [
            { data: 'id' },
            { data: 'nombre' },
            { data: 'cuenta_usuario' },
            { data: 'rol' },
            {
                data: 'id',
                render: function (data) {
                    return `
                        <a href="/users/edit/${data}" class="btn btn-sm btn-primary">Editar</a>
                        <a href="/users/delete/${data}" class="btn btn-sm btn-danger"
                           onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                           Eliminar
                        </a>
                    `;
                }
            }
        ],
        // searching: false,
        dom: 'lrtip',
        columnDefs: [{ orderable: false, targets: 4 }],     // Definicion de las columnas --> "La columna con index 4 no es ordenable" (si fuera mas de una columna encapsula en un array)
        order: [[1, 'asc']],                                // Orden ascendente en base a la columna con index 1 (empieza con el 0)
        orderCellsTop: true,                                // Para inicar en que fila de <thead> se añaden los eventos de ordenacion
    });

    // todos los filtros con input
    $('.filterInput').each(function (index) {
        $(this).on('keyup', function () {
            if (table.column(index).search() !== this.value) {
                table.column(index).search(this.value).draw();
            }
        });
    });

    // Filtro por rol
    $('#rol_filter').on('change', function () { // .on('change', function...) es el .onChange
        let obtainedFilterVal = $(this)[0].value;
        table.column(3).search($(this)[0].value, {
            exact: true
        }).draw();
    });
};
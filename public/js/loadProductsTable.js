window.onload = function () {

    let table = new DataTable('#productsTable', {

        ajax: {
            url: '/api/products',
            dataSrc: 'data'
        },

        processing: true,
        serverSide: true,

        pageLength: 100,
        language: {
            lengthLabels: {
                '-1' : 'Show all'
            }
        },
        
        lengthMenu: [10, 25, 50, 75, 100, 500, -1],

        columns: [
            { data: 'id' },
            { data: 'name' },
            { 
                data: 'price',
                render : function (data) { // Se puede usar render para formatear el precio.
                    return `${data} €`;
                } 
             },
            { data: 'stock' },
            { data: 'category_name' },
            {
                data: 'id',
                render: function (data) {
                    if (userRole <= 2){ // SuperAdmin y Admin.
                        return `
                            <a href="/products/edit/${data}" class="btn btn-sm btn-primary">Editar</a>
                            <a href="/products/delete/${data}" class="btn btn-sm btn-danger"
                               onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                               Eliminar
                            </a>
                        `;
                    }
                    return "";
                }
            }
        ],
        // searching: false,
        dom: 'lrtip',                                       // Borra el search que te viene por defecto.
        columnDefs: [{ orderable: false, targets: 5 }],     // Definicion de las columnas --> "La columna con index 3 no es ordenable" (si fuera mas de una columna encapsula en un array)
        order: [[0, 'asc']],                                // Orden ascendente en base a la columna con index 1 (empieza con el 0)
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
    $('#category_filter').on('change', function () { // .on('change', function...) es el .onChange
        table.column(4).search($(this)[0].value, {
            exact: true
        }).draw();
    });
};
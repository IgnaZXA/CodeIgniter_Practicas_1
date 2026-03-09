window.onload = function () {
    let table = new DataTable('#usersTable', {

        ajax: {
            url: '/api/users',
            dataSrc: ''
        },

        columns: [
            { data: 'id' },
            { data: 'nombre' },
            { data: 'cuenta_usuario' },
            { data: 'rol' },
            { data: 'contrasenia' },
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
        columnDefs: [{ orderable: false, targets: 5 }],     // Definicion de las columnas --> "La columna con index 5 no es ordenable" (si fuera mas de una columna encapsula en un array)
        order: [[1, 'asc']],                                // Orden ascendente en base a la columna con index 1 (empieza con el 0)
        orderCellsTop: true,                                // Para inicar en que fila de <thead> se añaden los eventos de ordenacion
    });

    document.querySelectorAll('#usersTable thead tr:nth-child(2) th input')
        .forEach((input, index) => {

            input.addEventListener('keyup', function () {

                if (table.column(index).search() !== this.value) {
                    table.column(index).search(this.value).draw();
                }

            });

        });

    document.querySelector('#usersTable thead select')
        .addEventListener('change', function () {

            table.column(3).search(this.value).draw();

        });
};
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var Directory = {
    loadUsers: function (route) {
        $(".table").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": route,
            "columns": [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'job_title', name: 'job_title'},
                {data: 'location', name: 'location'},
                {data: 'created_at', name: 'created_at'},
                {data: function (row, type, set) {
                        return '<a href="#!" class="btn btn-danger" data-user-id="' + row.id + '">Eliminar</a>';
                    }
                }
            ]
        });
    }
}

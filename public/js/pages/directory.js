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
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            "drawCallback": function () {
                $(".btn-remove").click(function () {
                    if (confirm($(this).data("question"))) {
                        var obj = $(this);
                        var old_html = $(obj).html();
                        $.ajax({
                            type: 'POST',
                            url: $(this).data("route"),
                            data: {id: $(this).data("user-id"), _token: $(this).data("token")},
                            dataType: 'jsonp',
                            beforeSend: function () {
                                obj.html('<i class="fas fa-spinner fa-pulse"></i>')
                            },
                            complete: function () {
                                obj.html(old_html);
                            },
                            success: function (response) {
                                if (response.status) {
                                    alert(response.msg);
                                    location.reload();
                                } else {
                                    alert(response.msg);
                                }

                            }
                        });
                    }

                });
            }
        });
    }
}

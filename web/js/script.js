$(document).ready( function () {
    var table = $('#table_id').DataTable({
        ajax: "users",
        dataSrc: 'data',
        "aoColumnDefs": [
           {
               "bSortable": false,
               "aTargets": ["sorting_disabled"]
           }
        ]
    });
    $('.add-user').click(function(){
        $.post( "add-user", function( data ) {
            if(data){
            table.ajax.reload();
            
        }
        });
    });
    $('.body-content').on('click', '.btn-delete-user', function(){
        let result = confirm('Вы действительно хотите удалить этого пользователя?');
        let user_id = $(this).data('id');
        if(result){
           $.post( "delete-user",{ 'user_id': user_id}, function( data ) {
                if(data){
                table.ajax.reload();
            }
            }); 
        }
    })
} );


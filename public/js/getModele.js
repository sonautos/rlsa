$("#make").change(function(){
    $.ajax({
        url: "{{ route('api.modeles.get_by_make') }}?make_id=" + $(this).val(),
        method: 'GET',
        success: function(data) {
            $('#modele').html(data.html);
        }
    });
});

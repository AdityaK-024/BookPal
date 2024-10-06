$(document).ready(function(){
    $('#searchInput').keyup(function(){
        var query = $(this).val();

         $.ajax({
            url: 'browse_.php',
            type: 'GET',
            data: {query: query},
            success: function(response){
                $('#bookList').html(response);
            }
        });
    });
});

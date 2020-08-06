(function($) {
    $(document).ready(function() {
        console.log("Hi");
        $('#genre-category').on('change', function() {
            var value = $(this).val();
            console.log(value);
            $.ajax({
                url:wpAjax.ajaxUrl,
                data: { action: 'filter', category : value},
                type: 'post',
                success: function(result) {
                  $('.posts-filter').html(result);
                },
                error: function(result) {
                  console.warn(result);
                }
            })
        }); 
    });
})(jQuery);
(function($) {
  $(document).ready(function() {
    $('#genre-category').on('change', function() {
      var value = $(this).val();
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
      });
    }); 


    $(".load").on("click",function(){ // When btn is pressed.
      $(".load").attr("disabled",true); // Disable the button, temp.
      loadposts();
      $(this).insertAfter('.posts-filter'); // Move the 'Load More' button to the end of the the newly added posts.
    });
    var ppp = 3; // Post per page
    var pageNumber = 1;
    function loadposts() {
      pageNumber++;
      var str = '&pageNumber='+pageNumber+'&ppp='+ppp+'&action=more_post_ajax';
      $.ajax({
          type: "POST",
          //dataType: "html",
          url: wpAjax.ajaxUrl,
          data: str,
          success: function(data){
              var $data = $(data);
              if($data.length){
                  $(".posts-filter").append($data);
                  $(".load").attr("disabled",false);
              } else{
                  $(".load").attr("disabled",true);
              }
          },
          error : function(data) {
            console.warn(data);
          }
      });
      return false;
  }

  });
})(jQuery);
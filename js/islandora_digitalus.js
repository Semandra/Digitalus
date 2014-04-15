
(function($) {
  Drupal.behaviors.IslandoraDigitalus = {
    attach: function(context, settings) {
      $('#digitalus_image').hide();
      $('.digitalus_thumb').click(function() {
        $('.digitalus_thumb').hide('slow');
        $('#digitalus_image').show('slow');
      });
      $('#digitalus_image').click(function() {
        $('.digitalus_thumb').show('slow');
        $('#digitalus_image').hide('slow');
      });
    }
  };
})(jQuery);

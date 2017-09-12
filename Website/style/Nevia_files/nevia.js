(function($) {

  $(document).ready(function() {

    $('.not-front .node:not(.node-page,.node-product)').after(('<div class="line"></div>'));
    $('.node-teaser:first').addClass('first-child');
    $('.view-recent-news .views-row-last').addClass('omega').removeClass('alpha');
  });

})(jQuery);
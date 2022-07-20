
jQuery(document).ready(function() {
	jQuery('.blog-single.post-desc p img').parent().addClass('blog-single-img');
var maxLength = 15;
jQuery('.jqte_editor').keyup(function() {
	// alert('zee'); 
  var textlen = maxLength - jQuery(this).val().length;
  jQuery('#rchars').text(textlen);
});
});

jQuery(document).ready(function() {
  var user_email = $('input[name="cand_email"]').val();;

  $(".email-pass-delete").on("input", function() {
    var current_email = $('.email-pass-delete').val();

    if (user_email == current_email) {
      $(".del_acount").removeClass("hide_del_button");
    } else {
      $(".del_acount").addClass("hide_del_button");
    }
  });
});

jQuery(document).ready(function(){
  $("#filter").keyup(function(){
      $(".live-filter").removeClass("live-filter-nd");
      // Retrieve the input field text and reset the count to zero
      var filter = $(this).val(), count = 0;

      // Loop through the comment list
      $(".live-filter li").each(function(){

          // If the list item does not contain the text phrase fade it out
          if ($(this).text().search(new RegExp(filter, "i")) < 0) {
              $(this).fadeOut();

          // Show the list item if the phrase matches and increase the count by 1
          } else {
              $(this).show();
              count++;
          }
      });  
  });
});

jQuery(document).on('click', '.submitDeleteEntry', function () {

  var id = this.id;
  alert(id);
  jQuery.ajax({
      type: 'POST',
      url: ajaxurl,
      data: {"action": "fws_delete_row", "id": id},
      success: function (data) {
         
      }
  });
});
	
jQuery(document).click(function (event) {
        var $target = jQuery(event.target);
        if (!$target.closest('#searchResult').length && (!jQuery(event.target).parents().hasClass('form-group')) ) {
            jQuery("#searchResult").hide();
        }
    });

jQuery(".show-candidate-search").on("click", function () {
  $('.panel-group').slideToggle('slow');
  $('.panel-group').removeClass('search-candidate-display-none');
});

jQuery(".close-open-sender-message").on("click", function () {

  // $(this).closest(".candidate-message-info").slideToggle("slow");
  $(this).closest(".candidate-message-info").toggleClass("little-sender-message");
});

jQuery(".message-link").on('click', function () {
  var id = jQuery(".current-user-id").val();
  jQuery.ajax({
      type: 'POST',
      url: ajaxurl,
      data: {"action": "update_last_seen_value", "id": id},
      success: function (data) {
          console.log(data);
      }
  });
});
/*jQuery('body').on("click", function (event) {
    if(!jQuery(event.target).parents().hasClass('navbar-collapse')) {
        jQuery('.navbar-collapse').removeClass('show');
        jQuery('body').removeClass('overflow_y_hid');
        jQuery('body .main-head').removeClass('hgt_chng');
      } else{
        let closeicon = event.target.className;
        if(closeicon.indexOf('close-icon') >= 0){
            jQuery('.navbar-collapse').removeClass('show');
            jQuery('body').removeClass('overflow_y_hid');
            jQuery('body .main-head').removeClass('hgt_chng');
          }
      }
    });*/

/*jQuery(document).mouseup(function(e) {
  var container = jQuery('#searchResult');
if (!container.is(e.target) && container.has(e.target).length === 0)
{
container.hide();
}
});*/

/*jQuery(function(){				
	var $win = jQuery(window); // or $box parent container
	var $searchresult = jQuery("#searchResult");
	$win.on("click", function(event){		
		if ( 
	$searchresult.has(event.target).length == 0 //checks if descendants of $box was clicked
	&&
	!$searchresult.is(event.target) //checks if the $box itself was clicked
	){
		jQuery("#searchResult").hide();
	}
	});
	  
});*/




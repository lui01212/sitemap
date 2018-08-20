$(document).ready(OnJscStartUp);

function OnJscStartUp()
{
    try
    {
      var $rating = $.cookie('rating');

      if($rating !='null' && $rating!='' && $rating!= undefined) { 
        $('.rateit').rateit('value',$rating);
        $('.rateit-text').text($rating);
        $('.rateit').rateit('readonly', true); 
      }
      $('.rateit').bind('rated', function (e) {
         var ri = $(this);
         var value = ri.rateit('value');
         var productID = ri.data('productid');
         OnJscRating(e,value);
     });
    }
    catch( ex )
    {
    }
}
function OnJscRating(e,value){
  //
  e.preventDefault();
  //
  OnJscRatingAjax(base_url,value);
  //
}
function OnJscRatingAjax(url,value){
  //
  $.ajax({
     type: "GET",
     url: url + '/' +  value
  }).success(function(data) {

         $.cookie('rating',value,{ path: window.location.pathname });

         $('.rateit-text').text(value);

         $('.rating').text(data.rating);

         $('.rating_sum').text(data.story_rating_sum);

         $('.rateit').rateit('readonly', true);
  });
  //
}

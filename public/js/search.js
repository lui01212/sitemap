$(document).ready(OnJscStartUp);
function OnJscStartUp()
{
    try
    {

        $(document).on('keyup','#i_search-bar',{ix : 0},showSearch);
        $(document).on('click','.close-search',{ix : 1},showSearch);
        //
    }
    catch( ex )
    {
    }
}
function showSearch(e){
	//
	$key = e.data.ix;
	$resultSearchBar = $('.result-search-bar');
	//
	if($key == 0){
	  if($(this).val().length >=3)
	  {
	    if ($resultSearchBar.hasClass('open')){
	       $resultSearchBar.removeClass('open').addClass('open');
	    }else{
	      $resultSearchBar.addClass('open'); 
	  	}
	  	OnJscSearch(e,$(this).val());
	  }else{
	  	if ($resultSearchBar.hasClass('open')){
	       $resultSearchBar.removeClass('open');
	    }
	  }
  	}else{
  		$resultSearchBar = $('.result-search-bar');

	    if ($resultSearchBar.hasClass('open')){
	       $resultSearchBar.removeClass('open');
	    }
  	}
}
function OnJscSearch(e,value){
  //
  e.preventDefault();
  //
  var url = $('#i_search').attr('action');
  //
  OnJscSearchAjax(url,value);
  //
}
function OnJscSearchAjax(url,value){
  //
  $.ajax({
     type: "GET",
     url: url + '/' +  value
  }).success(function(data) {
         $('.result-search-bar div.row').html('');
         $('.result-search-bar div.row').append(data);
  });
  //
}
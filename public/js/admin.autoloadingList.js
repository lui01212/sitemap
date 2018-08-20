
$(document).ready(OnJscStartUp);

function OnJscStartUp()
{
    try{
      $.cookie("flagautoload",0);
      $.cookie("flagautoloadall",0);
      $('.preloader').hide();
    	$('.btn-autoloadlist').on('click',OnJscAutoLoding);
      $('.btn-stop').on('click',OnJscStopAutoLoding);
      $('.btn-autoload-all').on('click',OnJscAutoLoadingAll);
    }
    catch( ex )
    {
    }
}
function OnJscAutoLoadingAll(e){
  $.cookie("flagautoloadall",1);
  $('.btn-autoloadlist').eq(0).click();
}
function OnJscStopAutoLoding(e){
      $.cookie("flagautoload",1);
      $.cookie("flagautoloadall",0);
      $('.preloader').hide();
}
function OnJscAutoLoding(e){
   //
   $.cookie("flagautoload",0);
   e.preventDefault();
   var oData = new Object();
   var  id = $(this).attr('id');
   oData.auto_chapter_link = $('#input' + id).val();

   oData.id = id;
   if(oData.auto_chapter_link !=""){
   $('#preloader' + oData.id).show();

   OnJscAutoLodingAjax(oData);
   }
}
function OnJscAutoLodingAjax(oData){
  //
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   $.ajax({ 
        url : $('#form' + oData.id ).attr('action'),
        type : "post",
        dataType:'json',
        data : {auto_chapter_link : oData.auto_chapter_link
        },
        success : function (result){
          if(result.mess == 'ERROR') {alert('ERROR');$('.preloader').hide();}
          if(result.mess == 'NORMAL') 
          {
            $('#input' + result.id).val(result.auto_chapter_link);
            if($('#input' + result.id).val() !="" && $.cookie("flagautoload") == 0 ) $('#' + result.id ).click();
            if($('#input' + result.id).val() =="") $('.preloader').hide();
            if($('#input' + result.id).val() =="" && $.cookie("flagautoloadall") == 1 ){
                      var $btn = $('.btn-autoloadlist');
                      var index = $btn.index($('#' + result.id)) + 1 ;
                      $btn.eq(index).click();
            }
          }
        }
    });
}

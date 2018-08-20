$(document).ready(OnJscStartUp);
function OnJscStartUp()
{
    try
    {
        var $ccolor = $.cookie('ccolor'); if($ccolor !="") $("input[type=radio][name=group][value='"+ $ccolor +"']").prop("checked",true);
        var $cfont = $.cookie('cfont'); if($cfont !=="" && $cfont !== 'null') $(".font-form-control").val($cfont);
        var $flag = $.cookie('ffullpage');
         if($flag =="" || $flag =="null") $.cookie('ffullpage',0,{ path: '/' });
        //
        custumPage();
        //
        fullPage();
        //
        $(document).on('click','.full-page',fullPage);
        $(document).on('click','.setting-default',settingDefault);
        $(document).on('change','.font-form-control',custumPage);
        $(document).on('change','.font-form-control',custumPage);
        $(document).on('change','input[type=radio][name=group]',custumPage);
        $(document).on('click','.group-size button:first-child',custumPage);
        $(document).on('click','.group-size button:last-child',custumPage);
        $(document).on('click','.group-framesize button:first-child',custumPage);
        $(document).on('click','.group-framesize button:last-child',custumPage);
        $(document).on('click','.group-lineheight button:first-child',custumPage);
        $(document).on('click','.group-lineheight button:last-child',custumPage);
        //
        $('.content-chapter a').remove();
        // your script
        $('.content-chapter').html($('.content-chapter').html().replace('đọc truyện với http://truｙencuatui.net/',''));
        $('.content-chapter').html($('.content-chapter').html().replace('tui','moi nguoi ung ho minh nhe'));
        $('.content-chapter').html($('.content-chapter').html().replace('t r u y e n c u a❤t u i n e t','moi nguoi ung ho minh nhe'));
        $('.content-chapter').html($('.content-chapter').html().replace(' Truy Ｃập http://truyencuatuｉ.Net/ để  đọc truyện ','moi nguoi ung ho minh nhe'));
    }
    catch( ex )
    {
    }
}
function fullPage(){

    var $flag = "";

    $flag = $.cookie('ffullpage'); 

    if($flag == '0') {
        $('.full-page').text('Thu Nhỏ Màn Hình');
        $('.footer').addClass('none');
        $('.row.clearfix').addClass('none');
        $('.navbar').addClass('none');
    }else{
        $('.full-page').text('Full Màn Hình');
        $('.footer').removeClass('none');
        $('.row.clearfix').removeClass('none');
        $('.navbar').removeClass('none');
    }
}
function settingDefault(){
    //
    $.cookie('csize','30',{ path: '/' });
    $.cookie('cfull','100',{ path: '/' });
    $.cookie('cline','100',{ path: '/' });
    $.cookie('ccolor','#232323',{ path: '/' });
    $.cookie("cfont","'Times New Roman', sans-serif",{ path: '/' });
    var $ccolor = $.cookie('ccolor'); if($ccolor !="") $("input[type=radio][name=group][value='"+ $ccolor +"']").prop("checked",true);
    var $cfont = $.cookie('cfont'); if($cfont !=="" && $cfont !== 'null') $(".font-form-control").val($cfont);
    //
    custumPage();
}
function custumPage(){

  var $ccolor = $('input[type=radio][name=group]:checked').val();

  $.cookie('ccolor',$ccolor,{ path: '/' });
  
  var $cfont = $('.font-form-control').val();

  $.cookie('cfont',$cfont,{ path: '/' });

  var $csize = $.cookie('csize'); if($csize !="") $('.btn-text-size').text($csize);
  var $cfull = $.cookie('cfull'); if($cfull !="") $('.btn-text-framesize').text($cfull);
  var $cline = $.cookie('cline'); if($cline !="") $('.btn-text-lineheight').text($cline);

  $('.content-chapter').css({'font-size' : $csize + 'px', 'line-height': Number($cline) + 40 +'%'});
  $('.custum-width').css({'width': $cfull + '%'});
  $('body').css({'background-color' : $ccolor});
  $('.content-chapter').css({'font-family':$cfont});
  if($ccolor == '#232323') {
    $('.content-chapter').css({'color' :'rgba(255,255,255,0.6)' }) ;
  }
  else{
    $('.content-chapter').css({'color' :'' }) ;
  };

}

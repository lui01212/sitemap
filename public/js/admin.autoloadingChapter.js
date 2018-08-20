
$(document).ready(OnJscStartUp);

function OnJscStartUp()
{
	try
	{
	    //
	    $.cookie("flagautoloadchapter",1); 
	    //
	    $('#i_stopautoloadchapter').text('CHO PHÉP');  
	    //
	    $('#i_stopautoloadchapter').on('click',stopAuutoLoadChapter);
	    //
	    setTimeout(function() 
	    {
	    	if($('input[name="chapter_link"]').val() !="" && $.cookie("flagautoloadchapter") == 1){
	    		$('#i_autoloadchapter').click();
	    	} 
	    }, 2000);
	}
	catch( ex )
	{
	}
}
function stopAuutoLoadChapter(){
	$flag = $.cookie("flagautoloadchapter");
	if($flag == 1){
		$.cookie("flagautoloadchapter",0);
		$('#i_stopautoloadchapter').text('DỪNG');  
	}else{
		$.cookie("flagautoloadchapter",1);
		$('#i_stopautoloadchapter').text('CHO PHÉP');
	}
}

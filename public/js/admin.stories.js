
$(document).ready(OnJscStartUp);

function OnJscStartUp()
{
    try
    {
    }
    catch( ex )
    {
    }
}
function OnJspSelectImage(input) {
    var oSelected = new Object();
    oSelected.File = input.files[0];
    $('img.img-thumbnail').attr('src', URL.createObjectURL(oSelected.File));
}
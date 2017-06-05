const LIST_TYPE = {"1":"Email", "2":"SMS", "3":"WebHook"};

$(document).ready(function (e) {
    showOldType();
});
function showDiv(prefix,chooser)
{
    for (var i=0;i<chooser.options.length;i++) {
        var div = document.getElementById(prefix + chooser.options[i].value);
        $("#"+prefix+chooser.options[i].value+" :input").prop("disabled", true);
        div.style.display = 'none';
    }

    var selectedOption = (chooser.options[chooser.selectedIndex].value);

    $.each(LIST_TYPE, function( index, value ) {
        if (selectedOption == index)  {
            displayDiv(prefix,index);
        }
    });
}

function displayDiv(prefix,suffix)
{
    var div = document.getElementById(prefix+suffix);
    $("#"+prefix+suffix+" :input").prop("disabled", false);
    div.style.display = 'block';
}

function showOldType()
{
    var type = $("#type").val();

    $("#type1").hide();

    $.each(LIST_TYPE, function( index, value ) {
        if(type == index) {
            displayDiv("type",index);
        }
    });

}

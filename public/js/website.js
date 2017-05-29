/**
 * Created by luantb on 29/05/2017.
 */
function checkEnable(id, status){
    $('#checkEnableDisableID').val(id);
    $('#checkEnableDisableStatus').val(status);

    if($('#checkEnableDisableID').val() !== '' && $('#checkEnableDisableStatus').val() !== '' ){
        $("#checkEnableDisable").submit();
    }
    return false;

}


$(document).ready(function (e) {
    $('#checkEnableDisable').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                console.log("success");
                console.log(data);
                var obj = jQuery.parseJSON(data);

                if(obj.success === true){
                    location.reload();
                }else{

                }
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }));

});
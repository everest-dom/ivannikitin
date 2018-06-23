$(function(){

    $('#all_campaigns').click(function(){
        if($(this).is(':checked')) {
            $('.campaignCheckbox').prop('checked', true);
        } else {
            $('.campaignCheckbox').prop('checked', false);
        }
    });

});
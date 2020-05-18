jQuery(document).ready(function($) { 
// HIDE/SHOW TAG AND CATEGORY #4326
    $("#show_amp_taxonomy").on('change', function(){
        var thisval = $(this).val();
        if(thisval=='hide'){
            $("#amp-show-hide-tax").css({'display':'block'});
        }else if(thisval=='show'){
            $("#amp-show-hide-tax").css({'display':'none'});
        }
    });
    $(".hide-show-amp-tax").on('click', function(){
        var checkBoxes = $(this).children('input:radio')
         checkBoxes.prop("checked", "true");
    });
});
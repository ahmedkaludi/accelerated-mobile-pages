jQuery(document).ready(function($) {
    var count = 0;

 //For Blurb Module
    jQuery(".ampforwp-blurb-add").on('click', function(e) {
        console.log('click');

        event.preventDefault();
        var additional = $(this).parent().parent().find('.ampforwp-blurb-additional');
        var container = $(this).parent().parent().parent().parent();
        var container_class = container.attr('id');
        var container_class_array = container_class.split("ampforwp-blurb-").reverse();
        var instance = container_class_array[0];
        var add = $(this).parent().parent().find('.ampforwp-blurb-add');
        count = additional.find('.widget-top').length;
        var amp_check_img = builder_script_data.amp_icon_check;
        additional.append('<div class="widget"><div class="widget-top"><div class="widget-title-action">     </div>    <div class="widget-title"><h3> New Module<span class="in-widget-title"></span></h3></div></div><div class="widget-inside"><p><label for="widget-ampforwp-blurb['+instance+'][features]['+count+'][title]">Title</label>'+
            '<input class="widefat" id="widget-ampforwp-blurb-'+instance+'-features-'+count+'-title" name="widget-ampforwp-blurb['+instance+'][features]['+count+'][title]" type="text" value="Heart Of The Landing Page" />'+
            '<label for="widget-ampforwp-blurb['+instance+'][features]['+count+'][description]">Description</label>'+
            '<textarea  class="widefat" id="widget-ampforwp-blurb-'+instance+'-features-'+count+'-description" name="widget-ampforwp-blurb['+instance+'][features]['+count+'][description]" rows=\'6\' cols=\'50\'>This is a sample text which is being used for the dummy purpose to avoid confusion.</textarea> <span class="clear"></span></p>' + '<p> <label for=""> Image: </label><input type="button" class="select-img-'+count+' button left" style="width:auto;" value="Select Image" onclick="ampSelectImage('+count+');"/><input type="button" style="display:none" name="removeimg" id="remove-img-'+count+'" class="button button-secondary remove-img-button" data-count-type="'+count+'"  value="Remove Image" onclick="removeImage('+count+')"><img src="'+amp_check_img+'" class="preview-image block-image-'+count+'" >' + '<input type="hidden" id="amp-img-field-'+count+'" class="img'+count+'" style="width:auto;" name="widget-ampforwp-blurb['+instance+'][features]['+count+'][image]" id="'+instance+'-features-'+count+'" value="'+amp_check_img+'" /></p>' + ' <p> <a class="ampforwp-blurb-remove delete button left">Remove Feature</a></p></div></div>');
        });
    jQuery(".ampforwp-blurb-remove").on('click', function() {
        jQuery(this).parent().parent().parent().remove();
    }); 

//For Text Module
    jQuery(".ampforwp-text-add").on('click', function(e) {
        console.log('click');

        event.preventDefault();
        var additional = $(this).parent().parent().find('.ampforwp-text-additional');
        var container = $(this).parent().parent().parent().parent();
        var container_class = container.attr('id');
        var container_class_array = container_class.split("ampforwp-text-").reverse();
        var instance = container_class_array[0];
        var add = $(this).parent().parent().find('.ampforwp-text-add');
        count = additional.find('.widget-top').length;

        additional.append('<div class="widget"><div class="widget-top"><div class="widget-title-action">     </div>    <div class="widget-title"><h3> New Module<span class="in-widget-title"></span></h3></div></div><div class="widget-inside"><p><label for="widget-ampforwp-text['+instance+'][features]['+count+'][title]">Title</label>'+
            '<input class="widefat" id="widget-ampforwp-text-'+instance+'-features-'+count+'-title" name="widget-ampforwp-text['+instance+'][features]['+count+'][title]" type="text" value="This is the default title" />'+
            '<label for="widget-ampforwp-text['+instance+'][features]['+count+'][description]">Description</label>'+
            '<textarea  class="widefat" id="widget-ampforwp-text-'+instance+'-features-'+count+'-description" name="widget-ampforwp-text['+instance+'][features]['+count+'][description]" rows=\'6\' cols=\'50\'>This is the description added by default </textarea> <span class="clear"></span></p>' + ' <p> <a class="ampforwp-text-remove delete button left">Remove Feature</a></p></div></div>' );
        });
     jQuery(".ampforwp-text-remove").on('click', function() {
        jQuery(this).parent().parent().parent().remove();
    });

//For Button Module
    jQuery(".ampforwp-button-add").on('click', function(e) {
        console.log('click');

        event.preventDefault();
        var additional = $(this).parent().parent().find('.ampforwp-button-additional');
        var container = $(this).parent().parent().parent().parent();
        var container_class = container.attr('id');
        var container_class_array = container_class.split("ampforwp-button-").reverse();
        var instance = container_class_array[0];
        var add = $(this).parent().parent().find('.ampforwp-button-add');
        count = additional.find('.widget-top').length;

        additional.append('<div class="widget"><div class="widget-top"><div class="widget-title-action">     </div>    <div class="widget-title"><h3> New Module<span class="in-widget-title"></span></h3></div></div><div class="widget-inside"><p><label for="widget-ampforwp-button['+instance+'][features]['+count+'][title]">Button Text</label>'+ 

          //Text Fields
            '<input class="widefat" id="widget-ampforwp-button-'+instance+'-features-'+count+'-title" name="widget-ampforwp-button['+instance+'][features]['+count+'][title]" type="text" value="Click Here" /></p>'+

            '<p><label for="widget-ampforwp-button['+instance+'][features]['+count+'][url]">Url:</label>'+
            '<input class="widefat" id="widget-ampforwp-button-'+instance+'-features-'+count+'-url" name="widget-ampforwp-button['+instance+'][features]['+count+'][url]" type="text" value="#" /></p>' + 
          // Radio
            '<p>  <label>URL Target:</label> <br />'+

            '<label for="widget-ampforwp-button['+instance+'][features]['+count+']'+"-on"+'">New Tab </label>'+
            '<input class="widefat" id="widget-ampforwp-button['+instance+'][features]['+count+']'+"-on"+'" name="widget-ampforwp-button['+instance+'][features]['+count+']'+'[radio]" type="radio" value="radio-on" />'+
            '<label for="widget-ampforwp-button['+instance+'][features]['+count+']'+"-off"+'">Current </label>'+
            '<input class="widefat" id="widget-ampforwp-button['+instance+'][features]['+count+']'+"-off"+'" name="widget-ampforwp-button['+instance+'][features]['+count+']'+'[radio]" type="radio" checked value="radio-off" /></p>'+
          // Select
            '<p> <label for="widget-ampforwp-button['+instance+']'+"-id-size"+'">Select Size:</label>'+ 
            '<select id="widget-ampforwp-button-'+instance+'-id-size" class="widefat" name="widget-ampforwp-button['+instance+'][features]['+count+'][size]"> <option value="1">Small</option> <option value="2">Medium</option> <option value="3">Large</option> </select> </p>'+

            '<p> <a class="ampforwp-button-remove delete button left">Remove Feature</a></p></div></div>' );
        });


     jQuery(".ampforwp-button-remove").on('click', function() {
        jQuery(this).parent().parent().parent().remove();
    });

     // Tiny Mce code
    // $(document).on('widget-updated', function(event, widget){
    //     var widget_id = $(widget).attr('id');
    //     $('#'+widget_id + ' .switch-tmce').hide();
    // });
 
  remove_button = jQuery('.remove-img-button');

  remove_button.on('click', function(e) {

    id =  jQuery(this).attr('data-count-type')

    imageToRemove = jQuery('.block-image-'+ id);

    imageToRemove.attr('src','');

   //  remove_image_button_activation( id );

  });


function remove_image_button_activation( id ) {

    var currentImage = jQuery('.block-image-'+id).attr('src');


    console.log(id );
    
    if ( currentImage == undefined  ) {
        jQuery('#remove-img-'+id).hide();
    } else {
        jQuery('#remove-img-'+id).show();
    }
}


 

});

var image_field1, image_field2, image_field3;

function ampSelectImage(count){
 
image_field1 = jQuery('#amp-img-field-'+count);
image_field2 = jQuery('.block-image-'+count);
image_field3 = jQuery('#remove-img-'+count);


imageSource = image_field2.attr('src');

  if ( imageSource ) {
    image_field3.show();
  }

  tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
  window.send_to_editor = function(html) {


    if(image_field1 != undefined){
      imgurl = jQuery("<div>" + html + "</div>").find('img').attr('src');


      image_field1.val(imgurl);
      image_field2.attr('src',imgurl);
      image_field2.show();
      image_field3.show();
      tb_remove();
    }
  }  
  return false;
}

jQuery(document).ready(function($) {
    var count = 0;

 
    jQuery(".ampforwp-blurb-add").live('click', function(e) {
        console.log('click');

        event.preventDefault();
        var additional = $(this).parent().parent().find('.ampforwp-blurb-additional');
        var container = $(this).parent().parent().parent().parent();
        var container_class = container.attr('id');
        var container_class_array = container_class.split("ampforwp-blurb-").reverse();
        var instance = container_class_array[0];
        var add = $(this).parent().parent().find('.ampforwp-blurb-add');
        count = additional.find('.widget-top').length;

        additional.append('<div class="widget"><div class="widget-top"><div class="widget-title-action">     </div>    <div class="widget-title"><h3> New Module<span class="in-widget-title"></span></h3></div></div><div class="widget-inside"><p><label for="widget-ampforwp-blurb['+instance+'][features]['+count+'][title]">Title</label>'+
            '<input class="widefat" id="widget-ampforwp-blurb-'+instance+'-features-'+count+'-title" name="widget-ampforwp-blurb['+instance+'][features]['+count+'][title]" type="text" value="This is the default title" />'+
            '<label for="widget-ampforwp-blurb['+instance+'][features]['+count+'][description]">Description</label>'+
            '<textarea  class="widefat" id="widget-ampforwp-blurb-'+instance+'-features-'+count+'-description" name="widget-ampforwp-blurb['+instance+'][features]['+count+'][description]" rows=\'6\' cols=\'50\'>This is the description added by default </textarea> <span class="clear"></span></p>' + '<p> <label for=""> Image: </label><input type="button" class="select-img-'+count+' button left" style="width:auto;" value="Select Image" onclick="ampSelectImage('+count+');"/><input type="button" style="display:none" name="removeimg" id="remove-img-'+count+'" class="button button-secondary remove-img-button" data-count-type="'+count+'"  value="Remove Image" onclick="removeImage('+count+')"><img src="" class="preview-image block-image-'+count+'" >' + '<input type="hidden" id="amp-img-field-'+count+'" class="img'+count+'" style="width:auto;" name="widget-ampforwp-blurb['+instance+'][features]['+count+'][image]" id="'+instance+'-features-'+count+'" value="" /></p>' + ' <p> <a class="ampforwp-blurb-remove delete button left">Remove Feature</a></p></div></div>' );
        });
    jQuery(".ampforwp-blurb-remove").live('click', function() {
        jQuery(this).parent().parent().parent().remove();
    }); 



// image_field1 = jQuery('#amp-img-field-'+count);
// image_field2 = jQuery('.block-image-'+count);
// image_field3 = jQuery('#remove-img-'+count);


 
 //  imageSource = image_field2.attr('src');

 //  if ( imageSource ) {
 //    image_field3.show();
 //  }





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

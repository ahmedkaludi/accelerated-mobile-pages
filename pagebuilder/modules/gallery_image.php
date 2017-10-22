<?php
$output = '';
$options = '<option value="thumbnail">Thumbnail</option><option value="medium">Medium</option><option value="large">Large</option>';
$frontCss = '';
return array(
		'label' =>'Gallery',
		'name' => 'gallery_image',
		'frontend_script' => array(
			'amp-carousel'=>'https://cdn.ampproject.org/v0/amp-carousel-0.1.js',
			'amp-image-lightbox' => 'https://cdn.ampproject.org/v0/amp-image-lightbox-0.1.js',
								   ),
		'frontend_css'=> $frontCss,
		'fields' => array(
						array(
							'type'	=>'multi_upload',
							'name'  => "gallary_selected_image",
							'label' => "Select gallary Images",
							'default'	=>plugins_url('accelerated-mobile-pages/images/150x150.png')
							),
						array(
							'type'	=>'select',
							'name'  =>"image_size_selection",
							'label' =>"Select content type",
							'default'=>'thumbnail',
							'options' => $options,
							),
						array(
							'type'	=>'select',
							'name'  =>"image_show_type",
							'label' =>"Display Format",
							'default'=>'slider-gallery',
							'options' => '<option value="slider-gallery">Slider Gallery</option>
										<option value="tiled-gallery">Tiled Gallery</option>',
							),
						array(
							'type'	=>'text',
							'name'=>"image_height",
							'label'=>"Image height",
							'default'=>'150'
							),
						array(
							'type'	=>'text',
							'name'=>"image_width",
							'label'=>"Image width",
							'default'=>'150'
							),
						array(
							'type'	=>'text',
							'name'=>"css_class",
							'label'=>"Custom CSS Class",
							'default'=>''
							)
					),
		'front_template'=> $output 
);

function pagebuilderGetGalleryFrontendView($moduleDetails,$selectedArray){
	$returnHtml = '<div class="galley-image-container">';
	 
	if(isset($selectedArray['image_show_type']) && $selectedArray['image_show_type']=='slider-gallery'){
		if(isset($moduleDetails['frontend_script'])){
			pagebuilder_add_amp_script($moduleDetails['frontend_script']);
		}
		$returnHtml .= '<amp-carousel height="300"
						  layout="fixed-height"
						  type="carousel">';
	}
	$selectedImage = explode(",", $selectedArray['gallary_selected_image']);
	$selectedImage = array_filter($selectedImage);
	
	if(count($selectedImage)>0){ 
		foreach($selectedImage as $imageUrl){
			$args = array(
						'size'=>$selectedArray['image_size_selection']
						);
			wp_get_image_editor( $imageUrl, $args );
			


			$returnHtml .= '<amp-img';
			if($selectedArray['image_show_type']=='tiled-gallery'){
					if(isset($moduleDetails['frontend_script'])){
							pagebuilder_add_amp_script($moduleDetails['frontend_script']);
						}
					$returnHtml .= ' on="tap:lightbox1"
									  role="button"
									  tabindex="0"';
				}
			$returnHtml .= ' src="'.$imageUrl.'"
							width="400"
							height="300"
							alt="'.$imageUrl.'"></amp-img>';
			if($selectedArray['image_show_type']=='tiled-gallery'){
					$returnHtml .= '<amp-image-lightbox id="lightbox1"
  							layout="nodisplay"></amp-image-lightbox>';
				}


		}
	}
	if(isset($selectedArray['image_show_type']) && $selectedArray['image_show_type']=='slider-gallery'){
		$returnHtml .= '</amp-carousel>';
	}
	
	$returnHtml .= '</div>';

	return $returnHtml;
}

//To add script in amp page
$galleryComponentScriptsAmpPB = array();
function pagebuilder_add_amp_script($scripts = array()){
	global $galleryComponentScriptsAmpPB;
	$galleryComponentScriptsAmpPB = $scripts;
	if(count($galleryComponentScriptsAmpPB)>0){
		add_filter('amp_post_template_data','ampforwp_pagebuilder_component_scripts', 20);
	}
}

function ampforwp_pagebuilder_component_scripts($data){
	global $galleryComponentScriptsAmpPB;
	if(count($galleryComponentScriptsAmpPB)>0){
		foreach($galleryComponentScriptsAmpPB as $scriptName=>$scriptLink){
			if ( empty( $data['amp_component_scripts'][$scriptName] ) ) {
				$data['amp_component_scripts'][$scriptName] = $scriptLink;
			}
		}
	}
	return $data;
}

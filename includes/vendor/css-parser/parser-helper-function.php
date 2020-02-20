<?php
namespace AMPforWP\AMPVendor;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class AMPFORWP_Tree_Shaking_Transient{
	public static function ampforwp_get_proper_transient_name($transient){
		global $post;
		if(ampforwp_is_home()){
			$transient = "home";
		}elseif(ampforwp_is_blog()){
			$transient = "blog";
		}elseif(ampforwp_is_front_page()){
			$transient = "post-".ampforwp_get_frontpage_id();
		}elseif(!empty($post) && is_object($post) && is_singular()){
			$transient = "post-".intval($post->ID);
		}elseif(is_archive()){
			$page_id = get_queried_object_id();
			$transient = "archive-".intval($page_id);
		}
		if( is_user_logged_in() ){
			$transient = $transient.'-admin';
		}
		return $transient;
	}
	public static function ampforwp_set_file_transient( $transient, $value, $expiration = 0 ) {

		$transient = self::ampforwp_get_proper_transient_name($transient);
		$expiration = (int) $expiration;

		$value = apply_filters( "pre_set_transient_{$transient}", $value, $expiration, $transient );

		
		$expiration = apply_filters( "expiration_of_transient_{$transient}", $expiration, $value, $transient );

		if ( wp_using_ext_object_cache() ) {
			$result = wp_cache_set( $transient, $value, 'transient', $expiration );
		} else {
			$transient_timeout = '_transient_timeout_' . $transient;
			$transient_option = '_transient_' . $transient;

			/***
			Creating a file
			**/
			if($value){
				$upload_dir = wp_upload_dir(); 
				$user_dirname = $upload_dir['basedir'] . '/' . 'ampforwp-tree-shaking';
				if(!file_exists($user_dirname)) wp_mkdir_p($user_dirname);
				$content = $value;
				$new_file = $user_dirname."/".$transient_option.".css";
				$ifp = @fopen( $new_file, 'w+' );
				if ( ! $ifp ) {
		          return ( array( 'error' => sprintf( __( 'Could not write file %s' ), $new_file ) ));
		        }
		        $result = @fwrite( $ifp, json_encode($value) );
			    fclose( $ifp );
			}

		}
		return $result;
	}


	public static function ampforwp_get_file_transient( $transient ) {

		$transient = self::ampforwp_get_proper_transient_name($transient);
		//$value = '';
		$pre = apply_filters( "pre_transient_{$transient}", false, $transient );
		if ( false !== $pre )
			return $pre;

		if ( wp_using_ext_object_cache() ) {
			$value = wp_cache_get( $transient, 'transient' );
		} else {
			$transient_option = '_transient_' . $transient;
			/*if ( ! wp_installing() ) {
				// If option is not in alloptions, it is not autoloaded and thus has a timeout
				$alloptions = wp_load_alloptions();
				if ( !isset( $alloptions[$transient_option] ) ) {
					$transient_timeout = '_transient_timeout_' . $transient;
					$timeout = get_option( $transient_timeout );
					if ( false !== $timeout && $timeout < time() ) {
						delete_option( $transient_option  );
						delete_option( $transient_timeout );
						$value = false;
					}
				}
			}*/

			if ( ! isset( $value ) ){
				$upload_dir = wp_upload_dir(); 
				$user_dirname = $upload_dir['basedir'] . '/' . 'ampforwp-tree-shaking';
				if(!file_exists($user_dirname)) wp_mkdir_p($user_dirname);
				$new_file = $user_dirname."/".$transient_option.".css";
				if(file_exists($user_dirname)){
					$files = glob($user_dirname . '/*');
			        //Loop through the file list.
			        foreach($files as $file){
			        	
			        	$file_time  = filectime($file);

						$file_date = date("Y-m-d",$file_time);
						$datetime1 = date_create($file_date);

						$get_current_date =  date('Y-m-d');
						$datetime2 = date_create($get_current_date);

						$interval = date_diff($datetime1, $datetime2);

						$day_diff = $interval->format('%a');
						if($day_diff >= '30' ){
							//Make sure that this is a file and not a directory.
					        if(is_file($file) && strpos($file, '_transient')!==false ){
					        	//Use the unlink function to delete the file.
					            unlink($file);
					        }
					    }			          
			        }
			    }
				if(file_exists($new_file) && filesize($new_file)>0){
					$ifp = @fopen( $new_file, 'r' );
					$value = fread($ifp, filesize($new_file)); 
					fclose($ifp);
				}
				//$value = get_option( $transient_option );
			}
		}

		$value = isset($value) ? $value : '';
		return apply_filters( "transient_{$transient}", json_decode($value, true), $transient );
	}
}
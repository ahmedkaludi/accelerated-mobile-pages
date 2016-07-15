<?php
/* turnoff src set for validating images in the post's the_content */
function amp_disable_srcset( $sources ) {
    return false;
}
add_filter( 'wp_calculate_image_srcset', 'amp_disable_srcset' );

/*
 * Added the style through the custom Hook called "amp_custom_style" and not used wp_enqueue, because of the strict rules of AMP.
 *
 * Check the url for the STRICT Markup required
 * https://github.com/ampproject/amphtml/blob/master/spec/amp-html-format.md#required-markup
*/

function amp_custom_style() {
/* Style Improvements:
- Remove toggle-navigation style because it was replaced with toggle-navigationv2 */
?>
    <style amp-custom>
 
        amp-sidebar {
          width: 250px; 
        }
        .amp-sidebar-image {
          line-height: 100px;
          vertical-align:middle;
        }
        .amp-close-image {
           top: 15px;
           left: 225px;
           cursor: pointer;
        }
        .toggle-navigationv2{
            
        }
        .toggle-navigationv2 ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        } 
        .toggle-navigationv2 ul ul li a  {
            padding-left: 35px;
            background: #fff;
            display: inline-block
        }
        .toggle-navigationv2 ul li a{
    padding: 15px 25px;
    width: 100%;
    display: inline-block;
    background: #fafafa;
    font-size: 14px;
    border-bottom: 1px solid #efefef;
        }
        .close-nav{
    font-size: 12px;
    background: rgba(0, 0, 0, 0.25);
    letter-spacing: 1px;
    display: inline-block;
    padding: 10px;
    border-radius: 100px;
    line-height: 8px;
    margin: 14px;
    left: 191px;
    color: #fff;
        }
        .close-nav:hover{
    background: rgba(0, 0, 0, 0.45);
        }

        .sticky_social{

    width: 100%;
    bottom: 0;
    display: block;
    left: 0;
    box-shadow: 0px 4px 7px #000;
    background: #fff;
    padding: 7px 0px 0px 0px;
    position: fixed;
    margin: 0;
    z-index: 999;
    text-align: center;
        }
        
        body{
              font: 16px/1.4 Sans-serif;
        }
        main{
            padding: 15px
        }
        a { color: #312C7E; text-decoration: none}
        #header{
            text-align: center; 
        }
        #header h1{
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            line-height: 1;
            margin: 15px;
        }
        .nav_container{
            padding: 15px;
            background: #312C7E;
            color: #fff;
            text-align: center
        }
        main{
            background: #f1f1f1;
            margin-top: 0;
            padding: 25px 15% 25px 15%;      
        }
        .post{
            margin-bottom: 12px;
            background: #fefefe;
            -moz-border-radius: 2px;
            -webkit-border-radius: 2px;
            border-radius: 2px;
            -moz-box-shadow: 0 2px 3px rgba(0,0,0,.05);
            -webkit-box-shadow: 0 2px 3px rgba(0,0,0,.05);
            box-shadow: 0 2px 3px rgba(0,0,0,.05);
            padding: 15px;  
        }
        #home .post{
            margin-bottom: 12px;
            background: #fefefe;
            -moz-border-radius: 2px;
            -webkit-border-radius: 2px;
            border-radius: 2px;
            -moz-box-shadow: 0 2px 3px rgba(0,0,0,.05);
            -webkit-box-shadow: 0 2px 3px rgba(0,0,0,.05);
            box-shadow: 0 2px 3px rgba(0,0,0,.05);
            padding: 15px; 
            min-height: 75px;
        }
        .post_image{
            float: right;
            margin-left: 15px;
            width: 100px;
            height: 75px;
        }
        .post h2{
            line-height: 30px;
        }
        .post h2 a{
            font-weight: 300;
            color: #000;
            font-size: 20px;
        }
        .post h2, .post p{
            margin: 0 0 0 5px;
        }
        #home .post p{
            font-size: 12px;
            color: #999;
            line-height: 20px;
            margin: 3px 0 0 5px;
        }
        .post p{
            margin-top: 5px;
            color: #333;
            font-size: 15px;
            line-height: 26px;
            margin-bottom: 15px;
        }
        .subtitle{
            font-size: 12px;
        }
        .toggle-navigation ul{
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: inline-block;
            width: 100%
        }
        .menu-all-pages-container:after{
            content: "";
            clear: both
        }
        .toggle-navigation ul li{
            font-size: 13px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.11);
            padding: 11px 0px;
            width: 25%;
            float: left;
            text-align: center;
            margin-top: 6px
        }
        .toggle-navigation ul ul{
            display: none
        }
        .toggle-navigation ul li a{
            color: #eee;
            padding: 15px;
        }
        .toggle-navigation{
            display: none;
            background: #444;
        }
        .toggle-text{
            color: #DCDCDC;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 3px;
        }
        .toggle-text:before{
            content: "...";
            font-size: 32px;
            position: absolute;
            font-family: georgia;
            line-height: 5px;
            margin-left: -40px;
            letter-spacing: 1px;
        }
        .nav_container:hover + .toggle-navigation,
        .toggle-navigation:hover,
        .toggle-navigation:active,
        .toggle-navigation:focus{
            display: inline-block;
            width: 100%;
        } 
        .clearfix{
            clear: both
        }
        #pagination{ 
            width: 100%;
            margin-top: 5px;
        }
        #pagination .next{
            float: right;
            margin-bottom: 22px;
        }
        #pagination .prev{
            float: left
        }
        #pagination .next a, #pagination .prev a{
            margin-bottom: 12px;
            background: #fefefe;
            -moz-border-radius: 2px;
            -webkit-border-radius: 2px;
            border-radius: 2px;
            -moz-box-shadow: 0 2px 3px rgba(0,0,0,.05);
            -webkit-box-shadow: 0 2px 3px rgba(0,0,0,.05);
            box-shadow: 0 2px 3px rgba(0,0,0,.05);
            padding: 11px 15px;
            font-size: 12px;
            text-transform: uppercase;
            color: #666;
        }
        #footer{
            font-size: 13px;
            text-align: center;
            letter-spacing: 0.2px;
            padding: 20px 0;
        }
        #footer p:first-child{
            margin-bottom: 12px;
        }
        #footer p{
            margin: 0
        }
        .single_img img{
            width: 100%;
            height: 100%
        }
        #title h2{
            margin: 20px 0px 18px 0px;
            text-align: center;
        }
        .postmeta{
            font-size: 12px; 
            padding-bottom: 10px;
            color: #555;
            border-bottom: 1px solid #DADADA;
        }
        .postmeta p{
            margin: 0
        }
        .postmeta span{
            float: right
        }
        .single_img{
            text-align: center
        }
        amp-img, img,  object, video {
            max-width: 100%;
            height: auto;
        }
         
    @media screen and (min-width: 700px) {
     /*header, footer, main, footer {
        margin: 0 10%;
      }*/
        .container{
            padding: 0 15%;

        }
        footer{
            padding: 0
        }
        main{
            padding: 25px 15% 25px 15%;      
        }
        .toggle-navigation ul li{
            width: 20%
        }

    }
    @media screen and (max-width: 767px) {
           .post p{
                 display: block
            }
           #home .post p{
               display: none
            } 
        
            main{
                padding: 25px 18px 25px 18px;      
            }
        .toggle-navigation ul li{
            width: 50%
        }
        }
    @media screen and (max-width: 495px) {
        .post h2 a{
            font-size: 17px;
            line-height: 26px;
        }
        #home .post p{
               display: none
        }
    }
    @media screen and (min-width: 900px) {
      /*header, footer, main, footer {
        margin: 0 18%;
      }*/
        .container{
            padding: 0 15%;      
        } 
        main{
            padding: 25px 15% 25px 15%;      
        }
        header, footer{
            padding: 0
        } 
    }

    #something {
      display: none;
    }

    #something:target {
      display: block;
    } 
	</style>
	<script async src="https://cdn.ampproject.org/v0.js"></script>
<?php }

add_action('amp_custom_style','amp_custom_style');


// amp_image_tag will convert all the img tags and will change it to amp-img to make it AMP compatible.
function amp_image_tag($content) {

    $replace = array (
        '<img' => '<amp-img'
    );
    $content = strtr($content, $replace);
    return $content;
}

add_filter('the_content','amp_image_tag');


?>
<?php
/*
 * Added the style through the custom Hook called "amp_custom_style" and not used wp_enqueue, because of the strict rules of AMP.
 *
 * Check the url for the STRICT Markup required
 * https://github.com/ampproject/amphtml/blob/master/spec/amp-html-format.md#required-markup
*/

function amp_custom_style() { ?>
<style>body {opacity: 0}</style><noscript><style>body {opacity: 1}</style></noscript>
	<style amp-custom>
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
        nav{
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
        nav ul{
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
        nav ul li{
            font-size: 13px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.11);
            padding: 11px 0px;
            width: 25%;
            float: left;
        }
        nav ul ul{
            display: none
        }
        nav ul li a{
            color: #eee
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
        nav ul li{
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
        nav ul li{
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
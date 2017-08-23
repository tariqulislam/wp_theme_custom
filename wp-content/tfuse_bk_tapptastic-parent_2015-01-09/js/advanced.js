jQuery(document).ready(function($) {
    
    jQuery(document).on('click','.image_frame',function(){
        if(tf_script.slider_design != 'simple')
        {
            if(jQuery(this).data('settings').slide_type == 'img')
            {
                jQuery('.slide_poster,.slide_video').hide();
                jQuery('.slide_src').show();
            }
            else
            {
                jQuery('.slide_poster,.slide_video').show();
                jQuery('.slide_src').hide();
            }
        }
    });
    
    jQuery('.over_thumb ').bind('click', function(){
 
       window.setTimeout(function(){
           var sel = jQuery('#slider_design_type').val(); 
           if(sel == 'home' || sel == 'simple'){
                jQuery('#slider_type').html('<option value="">Choose your slider type</option><option value="custom">Manually, I\'ll upload the images myself</option>');            }
           else
            {
                jQuery('#slider_type').html('<option value="">Choose your slider type</option><option value="custom">Manually, I\'ll upload the images myself</option>');
            }
               
       },12);
    });
  
  if(!$('#tapptastic_footer_socials').is(':checked')){
        jQuery('.tapptastic_footer_facebook,.tapptastic_footer_twitter,.tapptastic_footer_vimeo').hide();
        }
            $('#tapptastic_footer_socials').live('change',function () {
            if(!jQuery(this).is(':checked'))
            {
                jQuery('.tapptastic_footer_facebook,.tapptastic_footer_twitter,.tapptastic_footer_vimeo').hide();
            }
            else
            {
                jQuery('.tapptastic_footer_facebook,.tapptastic_footer_twitter,.tapptastic_footer_vimeo').show();
            }
        });

jQuery('.tfuse_selectable_code').live('click', function () {
        var r = document.createRange();
        var w = jQuery(this).get(0);
        r.selectNodeContents(w);
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(r);
    });

  

    function getUrlVars() {
        urlParams = {};
        var e,
            a = /\+/g,
            r = /([^&=]+)=?([^&]*)/g,
            d = function (s) {
                return decodeURIComponent(s.replace(a, " "));
            },
            q = window.location.search.substring(1);
        while (e = r.exec(q))
            urlParams[d(e[1])] = d(e[2]);
        return urlParams;
    }
	 $("#slider_slideSpeed,#slider_play,#slider_pause,#tapptastic_map_zoom").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
            // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
            // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }
        }
    });

    jQuery('#tapptastic_map_lat,#tapptastic_map_long').keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 190 || event.keyCode == 110|| event.keyCode == 189 || event.keyCode == 109 || event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
            // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
            // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }
        }
    });

    $('#tapptastic_framework_options_metabox .handlediv, #tapptastic_framework_options_metabox .hndle').hide();
    $('#tapptastic_framework_options_metabox .handlediv, #tapptastic_framework_options_metabox .hndle').hide();

    var options = new Array();
    
    options['tapptastic_logo_type'] = jQuery('#tapptastic_logo_type').val();
    jQuery('#tapptastic_logo_type').bind('change', function() {
        options['tapptastic_logo_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['tapptastic_header_socials'] = jQuery('#tapptastic_header_socials').val();
    jQuery('#tapptastic_header_socials').bind('change', function() {
        options['tapptastic_header_socials'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['slide_type'] = jQuery('#slide_type').val();
    jQuery('#slide_type').bind('change', function() {
        options['slide_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    
    options['tapptastic_homepage_category'] = jQuery('#tapptastic_homepage_category').val();
    jQuery('#tapptastic_homepage_category').bind('change', function() {
        options['tapptastic_homepage_category'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });

    //blog page
    options['tapptastic_blogpage_category'] = jQuery('#tapptastic_blogpage_category').val();
     jQuery('#tapptastic_blogpage_category').bind('change', function() {
         options['tapptastic_blogpage_category'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });

     
    tfuse_toggle_options(options);

    function tfuse_toggle_options(options)
    {

        jQuery('#tapptastic_logo,#tapptastic_logo_text,\
                #tapptastic_use_page_options,#tapptastic_home_page,#tapptastic_categories_select_categ,.homepage_category_header_element').parents('.option-inner').hide();
        jQuery('').parents('.form-field').hide();      
        
        

        //logo type select
        if(options['tapptastic_logo_type']=='text')
            jQuery('#tapptastic_logo_text').parents('.option-inner').show();
        else
            jQuery('#tapptastic_logo').parents('.option-inner').show();
                
        if(tf_script.slider_design != 'simple')
        {
            if(options['slide_type']=='img')
            {
                jQuery('.slide_src').show();
                jQuery('.slide_poster,.slide_video').hide();
            }
            else
            {
                jQuery('.slide_poster,.slide_video').show();
                jQuery('.slide_src').hide();
            }
        }
        
        
        /*--------------------------------------------------*/
        

        //homepage
       if(options['tapptastic_homepage_category']=='specific'){
            jQuery('.tapptastic_display_type_home').show();
            jQuery('.tapptastic_categories_select_categ').next().show();
            jQuery('#tapptastic_categories_select_categ').parents('.option-inner').show();
            jQuery('#tapptastic_categories_select_categ').parents('.form-field').show();
           
            if($('#tapptastic_use_page_options').is(':checked')) 
                jQuery('#homepage-header,#homepage-shortcodes').removeAttr('style');
				
				jQuery('#tapptastic_content_top').parents('.postbox').show();
        }
        else if (options['tapptastic_homepage_category']=='all')
        {
            jQuery('.tapptastic_display_type_home').show();
            jQuery('.tapptastic_categories_select_categ').next().show();
            if($('#tapptastic_use_page_options').is(':checked')) 
                jQuery('#homepage-header,#homepage-shortcodes').removeAttr('style');
				
				jQuery('#tapptastic_content_top').parents('.postbox').show();
        }
        else if(options['tapptastic_homepage_category']=='page'){
            jQuery('#tapptastic_home_page').parents('.option-inner').show();
            jQuery('#tapptastic_home_page').parents('.form-field').show();
            jQuery('.tapptastic_categories_select_categ').next().hide();
            
            jQuery('#tapptastic_content_top').parents('.postbox').hide();
        } 
        
        /*header element*/
        
        //blog page
        if(options['tapptastic_blogpage_category']=='all'){
            jQuery('.tapptastic_categories_select_categ_blog').hide();
        }
        else if(options['tapptastic_blogpage_category']=='specific'){
            jQuery('.tapptastic_categories_select_categ_blog').show();
        } 
        
        
       
        
       
    }
});

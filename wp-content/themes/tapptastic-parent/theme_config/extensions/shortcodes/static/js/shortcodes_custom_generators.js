function custom_generator_features_list(type,options) {
    shortcode='[features_list btitle="'+options['btitle']+'" bsubtitle="' + options['bsubtitle']+ '" ]';
    for(i in options.array) {
        shortcode+='[feature_list icon="'+options.array[i]['icon']+'" title="' + options.array[i]['title']  + '"]' + options.array[i]['content']  + '[/feature_list]';
    }
    shortcode+='[/features_list]';
    return shortcode;
}

function custom_obtainer_features_list(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    
    sh_options['btitle']= opt_get('tf_shc_features_list_btitle',cont);
    sh_options['bsubtitle']= opt_get('tf_shc_features_list_bsubtitle',cont);
    
    cont.find('[name="tf_shc_features_list_icon"]').each(function(i)
    {
        div=jQuery(this).parents('.option');
        icon=opt_get(jQuery(this).attr('name'),div); 
        
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_features_list_title"]').first().parents('.option');
        title =opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_features_list_title"]').first().attr('name'),div);
        
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_features_list_content"]').first().parents('.option');
        content =opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_features_list_content"]').first().attr('name'),div);
        
      //  console.log(subtitle);
        
        tmp={};
        tmp['title']=title;
        tmp['icon']=icon;
        tmp['content']=content;
        
        
        sh_options['array'].push(tmp);
        });
    
    return sh_options;
}

function custom_generator_info(type,options) {
    shortcode='[info]';
    for(i in options.array) {
        shortcode+='[inf title="'+options.array[i]['title']+'" subtitle="' + options.array[i]['subtitle']  + '"]' + options.array[i]['content']  + '[/inf]';
    }
    shortcode+='[/info]';
    return shortcode;
}

function custom_obtainer_info(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    cont.find('[name="tf_shc_info_title"]').each(function(i)
    {
        div=jQuery(this).parents('.option');
        title=opt_get(jQuery(this).attr('name'),div); 
        
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_info_subtitle"]').first().parents('.option');
        subtitle =opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_info_subtitle"]').first().attr('name'),div);
        div_content=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_info_content"]').first().parents('.option');
        content =opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_info_content"]').first().attr('name'),div_content);
        
      //  console.log(subtitle);
        
        tmp={};
        tmp['title']=title;
        tmp['subtitle']=subtitle;
        tmp['content']=content;
        
        
        sh_options['array'].push(tmp);
        });
    
    return sh_options;
}

jQuery(document).ready(function($) {
    jQuery('.option.option-text.tf_shc_section_img').hide();
    
     jQuery(document).on('change','#tf_shc_section_bg',function () {
        val = $(this).val();
        if(val !='img')
            jQuery('.tf_shc_section_img,.tf_shc_section_effect').hide();
        else
            jQuery('.tf_shc_section_img,.tf_shc_section_effect').show();
    });
    
});
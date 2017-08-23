<?php
/**
 * Play slider's configurations
 *
 * @since Evangelist 1.0
 */

$options = array(
    'tabs' => array(
        array(
            'name' => __('Slider Settings', 'tfuse'),
            'id' => 'slider_settings', #do no t change this ID
            'headings' => array(
                array(
                    'name' => __('Slider Settings', 'tfuse'),
                    'options' => array(
                        array('name' => __('Slider Title', 'tfuse'),
                            'desc' => __('Change the title of your slider. Only for internal use (Ex: Homepage)', 'tfuse'),
                            'id' => 'slider_title',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true),
                        array('name' => __('Slider Background', 'tfuse'),
                            'desc' => __('Upload Slider Background', 'tfuse'),
                            'id' => 'slider_bg',
                            'value' => '',
                            'type' => 'upload',
                            'divider' => true),
                        array('name' => __('Slides Interval','tfuse'),
                            'desc' => __('Enter the slides interval','tfuse'),
                            'id' => 'slider_interval',
                            'value' => '7500',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array('name' => __('Resize images?', 'tfuse'),
                            'desc' => __('Want to let our script to resize the images for you? Or do you want to have total control and upload images with the exact slider image size?', 'tfuse'),
                            'id' => 'slider_image_resize',
                            'value' => 'false',
                            'type' => 'checkbox')
                    )
                )
            )
        ),
        array(
            'name' => __('Add/Edit Slides', 'tfuse'),
            'id' => 'slider_setup', #do not change ID
            'headings' => array(
                array(
                    'name' => __('Add New Slide', 'tfuse'), #do not change
                    'options' => array(
                        array('name' => __('Title', 'tfuse'),
                            'desc' => __('Slider Title', 'tfuse'),
                            'id' => 'slide_title',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true),
                        
                        
                        array('name' => __('Content', 'tfuse'),
                            'desc' => __('Slider Content', 'tfuse'),
                            'id' => 'slide_content',
                            'value' => '',
                            'type' => 'textarea',
                            'divider' => true),
                        
                        array('name' => __('Slide type', 'tfuse'),
                            'desc' => __('Select Slide Type', 'tfuse'),
                            'id' => 'slide_type',
                            'value' => '',
                            'options' => array('img' => __('Image','tfuse'),'video' => __('Video','tfuse')),
                            'type' => 'select',
                            'divider' => true
                            ),
                        array('name' => __('Video Url', 'tfuse'),
                            'desc' => __('Insert Video Url', 'tfuse'),
                            'id' => 'slide_video',
                            'value' => '',
                            'type' => 'textarea'),
                        array('name' => __('Video Poster', 'tfuse'),
                            'desc' => __('Upload Video Poster (Shown for video link (ex: http://domain.com/tutorial.mp4))', 'tfuse'),
                            'id' => 'slide_poster',
                            'value' => '',
                            'type' => 'upload'),
                        
                        array('name' => __('Image <br />(945px × 617px)', 'tfuse'),
                            'desc' => __('You can upload an image from your hard drive or use one that was already uploaded by pressing  "Insert into Post" button from the image uploader plugin.', 'tfuse'),
                            'id' => 'slide_src',
                            'value' => '',
                            'type' => 'upload',
                            'media' => 'image')
                    )
                )
            )
        )
    )
);
$options['extra_options'] = array();
?>
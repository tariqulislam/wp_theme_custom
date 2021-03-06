<footer id="colophon" class="site-footer clearfix" role="contentinfo">
    <div class="site-info clearfix">
        <div class="fw-container">
            <div class="copyright pull-left"><?php echo tfuse_options('footer_copyright');?></div>
            <?php $socials = tfuse_options('footer_socials'); ?>
            <?php if($socials):?>
                <?php
                    $fb = tfuse_options('footer_facebook');
                    $tw = tfuse_options('footer_twitter');
                    $vim = tfuse_options('footer_vimeo');
                ?>
                <div class="socials-button pull-right">
                    <?php if(!empty($fb)):?>
                    <a href="<?php echo $fb;?>" target="_blank" class="facebook-ico"><i class="icon-facebook-f"></i><span><?php _e('facebook','tfuse');?></span></a>
                    <?php endif;?>
                    <?php if(!empty($tw)):?>
                        <a href="<?php echo $tw;?>" target="_blank" class="twitter-ico"><i class="icon-twitter-f"></i><span><?php _e('twitter','tfuse');?></span></a>
                    <?php endif;?>
                    <?php if(!empty($vim)):?>
                        <a href="<?php echo $vim;?>" target="_blank" class="vimeo-ico"><i class="icon-vimeo-f"></i><span><?php _e('vimeo','tfuse');?></span></a>
                    <?php endif;?>
                </div>
            <?php endif;?>
        </div>        
    </div>
</footer>
</div>
<?php wp_footer(); ?>
<script type="text/javascript">
    jQuery(function() {
      jQuery('a[href*=#]:not([href=#], #myTab li a)').on("click touchstart", function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target = jQuery(this.hash);
          target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
          if (target.length) {
            jQuery('html,body').animate({
              scrollTop: (target.offset().top - 100)
            }, 1000);
            return false;
          }
        }
      });
    });
    jQuery(document).ready(function(){
        jQuery()
    });
</script>
</body>
</html>
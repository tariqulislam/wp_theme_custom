<?php 
$matches = get_posts( array( 'posts_per_page' => -1, 'post_type' => 'matches' ) );
if(count($matches) > 0) {
?>
    <div class="news-carousel">                
        <div class="center">
            <span id="cycle-next" class="cycle-prev"><i class="fa fa-arrow-left"></i></span>
            <span id="cycle-prev" class="cycle-next"><i class="fa fa-arrow-right"></i></span>
        </div>                    
        <div   data-cycle-timeout="0" 
                data-cycle-slides=">article" 
                data-cycle-prev="#cycle-prev" 
                data-cycle-next="#cycle-next" 
                data-cycle-carousel-visible="10" 
                data-cycle-fx="carousel" 
                class="cycle-slideshow news-section">
            <?php foreach ($matches as $key => $match) {
                $teams          = get_field( "teams", $match->ID );
                $match_status   = get_field( "match_status", $match->ID );
                $match_time     = get_field( "match_time", $match->ID );
                ?>
                <article    data-toggle="popover" 
                            data-trigger="hover" 
                            data-html="true" 
                            data-container="body"
                            data-placement="bottom" 
                            data-content="
                            <ul class='no-style'>
                                <li>
                                    <img class='round-img' src='<?= wp_get_attachment_url( get_post_thumbnail_id($teams[0]->ID) );?>'>
                                    <?= $teams[0]->post_title?>
                                </li>
                                <li>VS</li>
                                <li>
                                    <?= $teams[1]->post_title?>
                                    <img class='round-img' src='<?= wp_get_attachment_url( get_post_thumbnail_id($teams[1]->ID) );?>'>
                                </li>
                            </ul>">
                    <time datetime="<?= date("d-m-Y", $match_time); ?>"><?= date("F j, Y", $match_time); ?></time>
                    <div class="text">                     
                        <div class="match-info">
                            <a href="" >
                                <span><?= get_field( "team_short_name", $teams[0]->ID ); ?></span>
                                    VS
                                <span><?= get_field( "team_short_name", $teams[1]->ID ); ?></span>
                            </a>
                        </div>
                        <a href="" class="pix-btn-open"><?= $match_status; ?></a>
                    </div>
                </article>
            <?php } ?>
        </div>
    </div>
    <style type="text/css">
        img.round-img{
            width: 50px;
            height: 50px;
            border-radius: 50px;
            box-shadow: 2px 2px 8px 0px #555555;
        }
        ul.no-style{
            height: 50px;
            width: 290px;
        }
        ul.no-style li{
            list-style: none;
            line-height: 50px;
            height: 0px;
            text-align:center;
        }
        ul.no-style li:first-child{
            text-align:left;
        }
        ul.no-style li:last-child{
            text-align:right;
        }
        .popover{
            max-width: 350px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.news-carousel [data-toggle="popover"]').popover();
        });

    </script>
<?php } ?>
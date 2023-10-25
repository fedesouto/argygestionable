<?php
/*
* Display Logo and contact details
*/
?>

<div class="headerbox">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-5 col-8 align-self-md-center">
        <?php $automobile_hub_logo_settings = get_theme_mod( 'automobile_hub_logo_settings','Different Line');
        if($automobile_hub_logo_settings == 'Different Line'){ ?>
          <div class="logo">
            <?php if( has_custom_logo() ) automobile_hub_the_custom_logo(); ?>
            <?php if(get_theme_mod('automobile_hub_site_title',true) != ''){ ?>
              <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php }?>
            <?php $automobile_hub_description = get_bloginfo( 'description', 'display' );
            if ( $automobile_hub_description || is_customize_preview() ) : ?>
              <?php if(get_theme_mod('automobile_hub_site_tagline','') != ''){ ?>
                <p class="site-description"><?php echo esc_html($automobile_hub_description); ?></p>
              <?php }?>
            <?php endif; ?>
          </div>
        <?php }else if($automobile_hub_logo_settings == 'Same Line'){ ?>
          <div class="logo logo-same-line">
            <div class="row">
              <div class="col-lg-5 col-md-5 align-self-md-center">
                <?php if( has_custom_logo() ) automobile_hub_the_custom_logo(); ?>
              </div>
              <div class="col-lg-7 col-md-7 align-self-md-center">
                <?php if(get_theme_mod('automobile_hub_site_title',true) != ''){ ?>
                  <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php }?>
                <?php $automobile_hub_description = get_bloginfo( 'description', 'display' );
                if ( $automobile_hub_description || is_customize_preview() ) : ?>
                  <?php if(get_theme_mod('automobile_hub_site_tagline','') != ''){ ?>
                    <p class="site-description"><?php echo esc_html($automobile_hub_description); ?></p>
                  <?php }?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php }?>
      </div>
      <div class="col-lg-8 col-md-7 col-4 align-self-md-center">
        <?php get_template_part( 'template-parts/navigation/site', 'nav' ); ?>
      </div>
    </div>
  </div>
</div>

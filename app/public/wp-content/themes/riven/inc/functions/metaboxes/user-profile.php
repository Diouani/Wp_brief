<?php
//custom field for user
add_action( 'show_user_profile', 'riven_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'riven_show_extra_profile_fields' );
function riven_show_extra_profile_fields( $user ) { ?>
    <h3><?php echo esc_html__( 'Extra profile information', 'riven' );?></h3>
    <table class="form-table">
        <tr>
            <th><label for="occupation"><?php echo esc_html__( 'Occupation', 'riven' );?></label></th>

            <td>
                <input type="text" name="occupation" id="occupation" value="<?php echo esc_attr( get_the_author_meta( 'occupation', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php echo esc_html__( 'Please enter your occupation.', 'riven' );?></span>
            </td>
        </tr>
        <tr>
            <th><label for="facebook"><?php echo esc_html__( 'Facebook', 'riven' );?></label></th>

            <td>
                <input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php echo esc_html__( 'Please enter your Facebook Link.', 'riven' );?></span>
            </td>
        </tr>
        <tr>
            <th><label for="google"><?php echo esc_html__( 'Google', 'riven' );?></label></th>
            <td>
                <input type="text" name="google" id="google" value="<?php echo esc_attr( get_the_author_meta( 'google', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php echo esc_html__( 'Please enter your Google Link.', 'riven' );?></span>
            </td>
        </tr>
        <tr>
            <th><label for="twitter"><?php echo esc_html__( 'Twitter', 'riven' );?></label></th>
            <td>
                <input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php echo esc_html__( 'Please enter your Twitter Link.', 'riven' );?></span>
            </td>
        </tr>
        <tr>
            <th><label for="youtube"><?php echo esc_html__( 'Youtube', 'riven' );?></label></th>
            <td>
                <input type="text" name="youtube" id="youtube" value="<?php echo esc_attr( get_the_author_meta( 'youtube', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php echo esc_html__( 'Please enter your Youtube Link.', 'riven' );?></span>
            </td>
        </tr>
    </table>
<?php }
add_action( 'personal_options_update', 'riven_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'riven_save_extra_profile_fields' );

function riven_save_extra_profile_fields( $user_id ) {

    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    update_user_meta( $user_id, 'occupation', $_POST['occupation'] );
    update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
    update_user_meta( $user_id, 'google', $_POST['google'] );
    update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
    update_user_meta( $user_id, 'youtube', $_POST['youtube'] );
}
function riven_author_box() { ?>
    <div class="author_blog">
        <div class="avatar_author">
            <?php echo get_avatar( get_the_author_meta( 'user_email' ), '96' ); ?>
        </div>
        <div class="right_info_author">
            <div class="name_author">
                <?php the_author(); ?>
            </div>
            <?php if ( get_the_author_meta( 'occupation' ) ) : ?>
            <div class="job_author">
                <p><?php the_author_meta( 'occupation' );?></p>
            </div>
            <?php endif;?>
            <div class="desc_author">
                <?php the_author_meta( 'description' ); ?>
            </div>
            <div class="social_author">
                <ul class="social-networks">
                    <?php if ( get_the_author_meta( 'facebook' ) ) : ?>
                    <li><a href="<?php esc_url(the_author_meta( 'facebook' ));?>"  target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <?php endif;?>
                    <?php if ( get_the_author_meta( 'google' ) ) : ?>
                    <li><a href="<?php esc_url(the_author_meta( 'google' ));?>"  target="_blank"><i class="fa fa-google-plus"></i></a></li>
                    <?php endif;?>
                    <?php if ( get_the_author_meta( 'twitter' ) ) : ?>
                    <li><a href="<?php esc_url(the_author_meta( 'twitter' ));?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <?php endif;?>
                    <?php if ( get_the_author_meta( 'youtube' ) ) : ?>
                    <li><a href="<?php esc_url(the_author_meta( 'youtube' ));?>"  target="_blank"><i class="fa fa-youtube-play"></i></a></li>
                    <?php endif;?>
                </ul>
            </div>
        </div>        
    </div>
    <?php
}
?>
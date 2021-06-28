<?php
/*
Plugin Name: Contact-brief
Plugin URI: localhost
Description: Contact Form
Version: Alpha
Author: Youssef Diouani
Author URI: Diouani.com
*/

add_shortcode( 'contactForm', 'shortcode' );


function formDisplay() {
    echo '<form action="" method="post">';
    echo '<p>';
    echo 'Votre Nom <br />';
    echo '<input type="text" name="name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["name"] ) ? esc_attr( $_POST["name"] ) : '' ) . '" size="40" />';
    echo '</p>';
    echo '<p>';
    echo 'Votre Email <br />';
    echo '<input type="email" name="email" value="' . ( isset( $_POST["email"] ) ? esc_attr( $_POST["email"] ) : '' ) . '" size="40" />';
    echo '</p>';
    echo '<p>';
    echo 'Sujet <br />';
    echo '<input type="text" name="subject" pattern="[a-zA-Z ]+" value="' . ( isset( $_POST["subject"] ) ? esc_attr( $_POST["subject"] ) : '' ) . '" size="40" />';
    echo '</p>';
    echo '<p>';
    echo 'Message (requis) <br />';
    echo '<textarea rows="10" cols="35" name="message">' . ( isset( $_POST["message"] ) ? esc_attr( $_POST["message"] ) : '' ) . '</textarea>';
    echo '</p>';
    echo '<p><input type="submit" name="submit" value="Send"/></p>';
    echo '</form>';
}




function sendMail() {

    // if the submit button is clicked, send the email
    if ( isset( $_POST['cf-submitted'] ) ) {

        // sanitize form values
        $name    = sanitize_text_field( $_POST["name"] );
        $email   = sanitize_email( $_POST["email"] );
        $subject = sanitize_text_field( $_POST["subject"] );
        $message = esc_textarea( $_POST["message"] );

        // get the blog administrator's email address
        $to = get_option( 'admin_email' );

        $headers = "From: $name <$email>" . "\r\n";

        // If email has been process for sending, display a success message
        if ( wp_mail( $to, $subject, $message, $headers ) ) {
            echo '<div>';
            echo '<p>Merci de nous avoir contacté , nous allons vous repondre dans les plus brefs delais </p>';
            echo '</div>';
        } else {
            echo 'Error';
        }
    }
}



function shortcode() {
    ob_start();
    sendMail();
    formDisplay();

    return ob_get_clean();
}
   
?>
<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
    return;
}

?>
<?php if (have_comments()) : ?>
    <div class="product-commnets">
        <?php wp_list_comments(apply_filters('woocommerce_product_review_list_args', array('callback' => 'woocommerce_comments', 'style' => 'div',))); ?>
    </div>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) :
        echo '<nav class="woocommerce-pagination">';
        paginate_comments_links(apply_filters('woocommerce_comment_pagination_args', array(
            'prev_text' => '&larr;',
            'next_text' => '&rarr;',
            'type' => 'list',
        )));
        echo '</nav>';
    endif; ?>

<?php else : ?>

    <p class="woocommerce-noreviews"><?php esc_html_e('There are no reviews yet.', 'markite'); ?></p>

<?php endif; ?>

<div class="row mt-20">
    <div class="col-xl-7">
        <?php if (get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->get_id())) : ?>
            <div id="reviews" class="product-review-box">
                <div class="review-form" id="review_form">
                    <?php
                    $commenter = wp_get_current_commenter();

                    $comment_form = array(
                        'title_reply' => '<span>' . esc_html__('Add a Review', 'markite') . '</span>',
                        'title_reply_to' => esc_html__('Leave a Reply to %s', 'markite'),
                        'title_reply_before' => '<span id="reply-title" class="comment-reply-title">',
                        'title_reply_after' => '</span>',
                        'comment_notes_after' => '',
                        'fields' => array(
                            'author' => '<div class="">' . '<label for="author">' . esc_html__('Name', 'markite') . '&nbsp;<span class="required">*</span></label> ' .
                                '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" aria-required="true" required /></div>',
                            'email' => '<div class=""><label for="email">' . esc_html__('Email', 'markite') . '&nbsp;<span class="required">*</span></label> ' .
                                '<input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" aria-required="true" required /></div>',
                        ),
                        'submit_button' => '<div class="rev-btn"><button class="m-btn m-btn-4" type="submit">' . esc_html__('Add your Review', 'markite') . '</button></div>',
                        'logged_in_as' => '',
                        'comment_field' => '',
                    );

                    if ($account_page_url = wc_get_page_permalink('myaccount')) {
                        $comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf(esc_html__('You must be <a href="%s">logged in</a> to post a review.', 'markite'), esc_url($account_page_url)) . '</p>';
                    }

                    if (get_option('woocommerce_enable_review_rating') === 'yes') {
                        $comment_form['comment_field'] = '<div class="markite-rating mb-30"><span>' . esc_html__('Your rating', 'markite') . '</span><select name="rating" id="rating" aria-required="true" required>
                                    <option value="">' . esc_html__('Rate&hellip;', 'markite') . '</option>
                                    <option value="5">' . esc_html__('Perfect', 'markite') . '</option>
                                    <option value="4">' . esc_html__('Good', 'markite') . '</option>
                                    <option value="3">' . esc_html__('Average', 'markite') . '</option>
                                    <option value="2">' . esc_html__('Not that bad', 'markite') . '</option>
                                    <option value="1">' . esc_html__('Very poor', 'markite') . '</option>
                                </select></div>';
                    }

                    $comment_form['comment_field'] .= '<div class=""><label for="message">' . esc_html__('YOUR REVIEW', 'markite') . '</label><textarea id="comment" name="comment" cols="30" rows="10" aria-required="true" required></textarea></div>';

                    comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
                    ?>
                </div>
            </div>
        <?php else : ?>
            <p class="woocommerce-verification-required"><?php esc_html_e('Only logged in customers who have purchased this product may leave a review.', 'markite'); ?></p>
        <?php endif; ?>
        <div class="clear"></div>
        <div class="clear">
    </div>
</div>
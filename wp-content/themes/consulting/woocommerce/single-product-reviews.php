<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
global $product;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews">
	<div id="comments">

		<?php if ( have_comments() ) : ?>

			<ul class="comment-list">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array(
					'avatar_size' => 87,
					'callback' => 'consulting_comment',
				) ) ); ?>
			</ul>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'consulting' ); ?></p>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();

					$comment_form = array(
						'title_reply'          => have_comments() ? esc_html__( 'Add a review', 'consulting' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'consulting' ), get_the_title() ),
						'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'consulting' ),
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' => '<div class="row">' .
							            '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">' .
								            '<div class="input-group comment-form-author">' .
								              '<input class="form-control" name="author" type="text" placeholder="' . esc_attr__( 'Name *', 'consulting' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" />' .
	                          '</div>' .
													'</div>',
							'email'  => '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">'.
							              '<div class="input-group comment-form-email">' .
							                '<input class="form-control" name="email" type="text" placeholder="' . esc_attr__( 'E-mail *', 'consulting' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" />' .
							              '</div>' .
							            '</div>' .
													'</div>',
						),
						'label_submit'  => esc_attr__( 'Submit', 'consulting' ),
						'logged_in_as'  => '',
						'comment_field' => ''
					);

					if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
						$comment_form['must_log_in'] = '<p class="must-log-in">' .  sprintf( wp_kses( __( 'You must be <a href="%s">logged in</a> to post a review.', 'consulting' ), array( 'a' => array() ) ), esc_url( $account_page_url ) ) . '</p>';
					}

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['comment_field'] = '<div class="input-group comment-form-rating"><label for="rating">' . esc_html__( 'Your Rating', 'consulting' ) .'</label><select name="rating" id="rating">
							<option value="">' . esc_html__( 'Rate&hellip;', 'consulting' ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', 'consulting' ) . '</option>
							<option value="4">' . esc_html__( 'Good', 'consulting' ) . '</option>
							<option value="3">' . esc_html__( 'Average', 'consulting' ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', 'consulting' ) . '</option>
							<option value="1">' . esc_html__( 'Very Poor', 'consulting' ) . '</option>
						</select></div>';
					}

					$comment_form['comment_field'] .= '<div class="input-group comment-form-comment">
																							<textarea placeholder="' . _x( 'Your Review', 'noun', 'consulting' ) . ' *" class="form-control" name="comment" rows="9" aria-required="true"></textarea>
																						</div>
																						<button type="submit" class="button size-lg icon_left"><i class="fa fa-chevron-right"></i> ' . esc_html__( 'add review', 'consulting' ) . '</button>';

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'consulting' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>

<?php

/**
 * Single template for 'postdocopps' CPT
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();?>
	<div class="return-link">
		<a href="<?php echo get_site_url() . '/postdocopps/'; ?>">Back to Listing</a>
	</div>
	<div class="table-content">
		<div class="table-responsive-vertical">
		  <table id="table" class="table table-hover table-striped table-mc-amber">
		      <thead>
		        <tr>
		          <th>Name</th>
		          <th>Email</th>
		          <th>Phone</th>
		          <th>Department</th>
		          <th>Brief Description</th>
		          <th>Full Description</th>
		          <th>Application Details</th>
		          <th>Created</th>
		        </tr>
		      </thead>
		      <tbody>
			    <?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
			        <tr>
						<td data-title="Name"><?php the_field( 'postdoc_name' ); ?></td>

						<td data-title="Email"><?php the_field( 'postdoc_email' ); ?></td>

						<td data-title="Phone"><?php the_field( 'postdoc_phone' ); ?></td>

						<td data-title="Department"><?php the_field( 'postdoc_department' ); ?></td>

						<td class="table-col6" data-title="Brief Description"><p><?php the_field( 'postdoc_brief_description' ); ?></p></td>

						<td class="table-col6" data-title="Full Description"><?php the_field( 'postdoc_full_description' ); ?></td>

						<td class="table-col6" data-title="Application Details"><?php the_field( 'postdoc_application_details' ); ?></td>

						<td data-title="Date"><?php the_time( get_option( 'date_format' ) ); get_the_time('', $post->ID); ?></td>
					</tr>
		        <?php } } ?>
		      </tbody>
		    </table>
  		</div>
<?php
get_sidebar();
get_footer();
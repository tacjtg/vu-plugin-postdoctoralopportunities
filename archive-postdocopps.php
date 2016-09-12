<?php

/**
 * Archive template for 'postdocopps' CPT
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();?>
	<div class="table-content">
		<div class="table-responsive-vertical">
		  <table id="table" class="table table-hover table-striped table-mc-amber">
		      <thead>
		        <tr>
		          <th class="table-col1">Name</th>
		          <th class="table-col2">Department</th>
		          <th class="table-col3">Brief Description</th>
		          <th class="table-col4">Created</th>
		        </tr>
		      </thead>
		      <tbody>
			    <?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
			        <tr class="table-linked" onclick="location.href='<?php the_permalink( $post->ID ); ?>'">
			          <td class="table-col1" data-title="Name"><?php the_field( 'postdoc_name' ); ?></td>
			          <td class="table-col2" data-title="Department"><?php the_field( 'postdoc_department' ); ?></td>
			          <td class="table-col3" data-title="Brief Description"><?php the_field( 'postdoc_brief_description' ); ?></td>
			          <td class="table-col4" data-title="Date"><?php the_time( get_option( 'date_format' ) ); get_the_time('', $post->ID); ?></td>
			        </tr>
		        <?php } } ?>
		      </tbody>
		    </table>
  		</div>
<?php
get_sidebar();
get_footer();
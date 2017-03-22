<?php

global $acf_fields_helper;
$acf_fields_helper = new IBio_Fields_Display_Helper();

global $talk_speaker;

function ibio_talks_info(){
	global $talk_speaker;
	
	$talk_speakers = new WP_Query(array(
			'post_type' => 'ibiology_speaker',
			'connected_type' => 'speaker_to_talk',
			'connected_items' => get_queried_object(),
  		'nopaging' => true
		));
	
	$talk_speaker = $talk_speakers->posts;
	
}

function ibio_talks_videos(){
	global $acf_fields_helper;
	$acf_fields_helper->show_field_group(32361);
}

function ibio_related_content(){
	global $acf_fields_helper;
	echo "<h2>Related Conetnt</h2>";
	$acf_fields_helper->show_field_group(32376);
}

function ibio_talks_speaker(){
	global $talk_speaker;
	echo "<h2>Speaker Bio</h2>";
	
	foreach ($talk_speaker as $s){
		$url = get_post_permalink($s->ID);
		echo "<h3><a href='$url'>" . $s->post_title . "</a></h3>" . $s->post_content;
	}	

}

/* -------------------  Page Rendering --------------------------*/

add_action('genesis_entry_header', 'ibio_talks_info', 20);
add_action('genesis_entry_content', 'ibio_talks_videos', 2);
add_action('genesis_entry_content', 'ibio_talks_speaker', 20);
add_action('genesis_entry_content', 'ibio_related_content', 21);

genesis();
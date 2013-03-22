<div class="front-to-back">
	<label><?php _e('Your name:', 'front-to-back'); ?></label><br/>
	<input type="text" id="<?php echo $this->get_field_id('name'); ?>" 
	name="<?php echo $this->get_field_name('name'); ?>" 
	value="<?php echo $instance['name']; ?>" />

<label for="<?php echo $this->get_field_id('title'); ?>">
	<br/>Title:<br/>
	<input 
	id="<?php echo $this->get_field_id('title'); ?>"
	name = "<?php echo $this->get_field_name('title'); ?>"
	value="<?php echo esc_attr($instance['title']); ?>" />
</label>

<label for="<?php echo $this->get_field_id('body'); ?>">
	<br/>Body:<br/>
	<textarea 
	id="<?php echo $this->get_field_id('body'); ?>"
	name="<?php echo $this->get_field_name('body'); ?>"
	>
	<?php echo esc_attr($instance['body']); ?>
	</textarea> 
</label>

</div>
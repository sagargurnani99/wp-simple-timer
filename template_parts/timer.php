<div id="simple-timer">
	<div class="counter-header-section">
		<svg id="Layer_1" style="enable-background:new 0 0 128 128;" version="1.1" viewBox="0 0 128 128" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><circle cx="64" cy="90.358" r="9.824" style="fill:#d4d4d4;"/><circle cx="99.25" cy="90.358" r="9.824" style="fill:#d4d4d4;"/><circle cx="28.75" cy="90.358" r="9.824" style="fill:#d4d4d4;"/></svg>
	</div>
	<div id="countdown-timer-container">
		<div class="countdown-timer-inner">
			<div class="timer-header-title">
				<b><?php echo esc_html($title); ?></b>
			</div>
			<div class="countdown-timer-item">
				<div class="countdown-timer-item-group">
					<div class="timer-item-value">
						<span id="hours">00</span>
					</div>
					<div class="timer-item-group-label">
						<?php _e('Hours'); ?>
					</div>
				</div>
				<div class="countdown-timer-item-group">
					<div class="timer-item-value">
						<span id="minutes">00</span>
					</div>
					<div class="timer-item-group-label">
						<?php _e('Minutes'); ?>
					</div>
				</div>
				<div class="countdown-timer-item-group">
					<div class="timer-item-value">
						<span id="seconds">00</span>
					</div>
					<div class="timer-item-group-label">
						<?php _e('Seconds'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="counter-footer-section"></div>
</div>
<script>
	// Set the date we're counting down to
	var countDownDate = new Date('<?php echo esc_html($scheduledTime); ?>').getTime();
</script>

<?php
class MyFormHelper extends AppHelper {
	public function create($value) {
		$width = round($value / 100, 2) * 100;
		return sprintf(
			'<div class="progress-container">
				<div class="progress-bar" style="width: %s%%"></div>
			</div>', $width);
	}
}
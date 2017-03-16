<?php $view->script( 'settings', 'exitintent:app/bundle/settings.js', [ 'vue', 'editor' ] ); ?>

<div id="settings" class="uk-form uk-form-horizontal" v-cloak>
	<div class="uk-grid pk-grid-large" data-uk-grid-margin>
		<div class="pk-width-sidebar">
			<div class="uk-panel">
				<ul class="uk-nav uk-nav-side pk-nav-large" data-uk-tab="{ connect: '#tab-content' }">
					<li><a><i class="pk-icon-large-settings uk-margin-right"></i> {{ 'General' | trans }}</a></li>
				</ul>
			</div>
		</div>
		<div class="pk-width-content">
			<ul id="tab-content" class="uk-switcher uk-margin">
				<li>
					<div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
						<div data-uk-margin>
							<h2 class="uk-margin-remove">{{ 'General' | trans }}</h2>
						</div>
						<div data-uk-margin>
							<button class="uk-button uk-button-primary" @click.prevent="save">{{ 'Save' | trans }}
							</button>
						</div>
					</div>
					<div class="uk-form-row">
						<label class="uk-form-label">{{ 'HTML' | trans }}</label>
						<div class="uk-form-controls uk-form-controls-text">
							<v-editor type="code" :value.sync="config.html"></v-editor>
						</div>
					</div>
					<div class="uk-form-row">
						<label for="form-sensitivity" class="uk-form-label">{{ 'Sensitivity' | trans }}</label>
						<div class="uk-form-controls">
							<input id="form-sensitivity" class="uk-form-width-small uk-text-right" type="number" name="sensitivity"
							       v-model="config.sensitivity" min="0" number>
						</div>
					</div>
					<div class="uk-form-row">
						<label for="form-aggressive" class="uk-form-label">{{ 'Aggressive' | trans }}</label>
						<div class="uk-form-controls uk-form-controls-text">
							<input id="form-aggressive" type="checkbox" v-model="config.aggressive">
						</div>
					</div>
					<div class="uk-form-row">
						<label for="form-timer" class="uk-form-label">{{ 'Timer' | trans }}</label>
						<div class="uk-form-controls">
							<input id="form-timer" class="uk-form-width-small uk-text-right" type="number" name="timer"
							       v-model="config.timer" min="0" number>
						</div>
					</div>
					<div class="uk-form-row">
						<label for="form-expires" class="uk-form-label">{{ 'Cookie Lifetime' | trans }}</label>
						<div class="uk-form-controls">
							<input id="form-expires" class="uk-form-width-small uk-text-right" type="number" name="expires"
							       v-model="config.expires" min="0" number> {{ 'Days' | trans }}
						</div>
					</div>
					<div class="uk-form-row">
						<label class="uk-form-label">{{ 'Cookie Name' | trans }}</label>
						<div class="uk-form-controls uk-form-controls-text">
							<p class="uk-form-controls-condensed">
								<input type="text" class="uk-form-width-large" v-model="config.cookiename">
							</p>
						</div>
					</div>
					<div class="uk-form-row">
						<label for="form-sitewide" class="uk-form-label">{{ 'Sitewide Cookie' | trans }}</label>
						<div class="uk-form-controls uk-form-controls-text">
							<input id="form-sitewide" type="checkbox" v-model="config.sitewide">
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>
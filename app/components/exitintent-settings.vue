<template>
    <div class="uk-form uk-form-horizontal">
        <h1>{{ 'Exitintent Settings' | trans }}</h1>
        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Pages' | trans }}</label>
            <div class="uk-form-controls uk-form-controls-text">
                <input-tree :active.sync="package.config.nodes"></input-tree>
            </div>
        </div>
        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'HTML' | trans }}</label>
            <div class="uk-form-controls uk-form-controls-text">
                <v-editor type="code" :value.sync="package.config.html"></v-editor>
            </div>
        </div>
        <div class="uk-form-row">
            <label for="form-sensitivity" class="uk-form-label">{{ 'Sensitivity' | trans }}</label>
            <div class="uk-form-controls">
                <input id="form-sensitivity" class="uk-form-width-small uk-text-right" type="number" name="sensitivity"
                       v-model="package.config.sensitivity" min="0" number>
            </div>
        </div>
        <div class="uk-form-row">
            <label for="form-aggressive" class="uk-form-label">{{ 'Aggressive' | trans }}</label>
            <div class="uk-form-controls uk-form-controls-text">
                <input id="form-aggressive" type="checkbox" v-model="package.config.aggressive">
            </div>
        </div>
        <div class="uk-form-row">
            <label for="form-timer" class="uk-form-label">{{ 'Timer' | trans }}</label>
            <div class="uk-form-controls">
                <input id="form-timer" class="uk-form-width-small uk-text-right" type="number" name="timer"
                       v-model="package.config.timer" min="0" number>
            </div>
        </div>
        <div class="uk-form-row">
            <label for="form-expires" class="uk-form-label">{{ 'Cookie Lifetime' | trans }}</label>
            <div class="uk-form-controls">
                <input id="form-expires" class="uk-form-width-small uk-text-right" type="number" name="expires"
                       v-model="package.config.expires" min="0" number> {{ 'Days' | trans }}
            </div>
        </div>
        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Cookie Name' | trans }}</label>
            <div class="uk-form-controls uk-form-controls-text">
                <p class="uk-form-controls-condensed">
                    <input type="text" class="uk-form-width-large" v-model="package.config.cookiename">
                </p>
            </div>
        </div>
        <div class="uk-form-row">
            <label for="form-sitewide" class="uk-form-label">{{ 'Sitewide Cookie' | trans }}</label>
            <div class="uk-form-controls uk-form-controls-text">
                <input id="form-sitewide" type="checkbox" v-model="package.config.sitewide">
            </div>
        </div>
        <div class="uk-form-row uk-margin-top">
            <div class="uk-form-controls">
                <button class="uk-button uk-button-primary" @click="save">{{ 'Save' | trans }}</button>
            </div>
        </div>
    </div>
</template>

<script>

module.exports = {

	settings: true,

	props: ['package'],

	methods: {
		save: function save() {
			this.$http.post ('admin/system/settings/config', {
				name: 'spqr/exitintent',
				config: this.package.config
			}).then (function () {
				this.$notify ('Settings saved.', '');
			}).catch (function (response) {
				this.$notify (response.message, 'danger');
			}).finally (function () {
				this.$parent.close ();
			});
		}
	}
};

window.Extensions.components['exitintent-settings'] = module.exports;
</script>
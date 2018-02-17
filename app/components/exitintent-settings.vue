<template>
    <ul class="uk-tab" v-el:tab>
        <li><a>{{ 'Settings' | trans }}</a></li>
        <li><a>{{ 'Info' | trans }}</a></li>
    </ul>
    <div class="uk-switcher uk-margin" v-el:content>
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
                    <input id="form-sensitivity" class="uk-form-width-small uk-text-right" type="number"
                           name="sensitivity"
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
                    <button class="uk-button uk-button-primary"
                    @click="save">{{ 'Save' | trans }}
                </button>
            </div>
        </div>
    </div>
    <div class="uk-form uk-form-horizontal">
        <h1>{{ 'Exitintent Info' | trans }}</h1>
        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Getting help' | trans }}</label>
            <div class="uk-form-controls uk-form-controls-text">
                <div class="uk-panel uk-panel-box">
                    <p>{{ 'You have problems using this extension? Join the Pagekit community forum.' | trans }}</p>
                    <a class="uk-button uk-width-1-1 uk-button-large" href="https://pagekit-forum.org"
                       target="_blank">Pagekit Forum</a>
                </div>
            </div>
        </div>
        <div class="uk-form-row">
            <label class="uk-form-label">{{ 'Donate' | trans }}</label>
            <div class="uk-form-controls uk-form-controls-text">
                <div class="uk-panel uk-panel-box">
                    <p>{{ 'Do you like my extensions? They are free. Of course I would like to get a donation, so if you want to, please open the donate link. You may find three possibilities to donate: PayPal, Patreon and Coinhive.' | trans }} </p>
                    <a class="uk-button uk-button-large uk-width-1-1 uk-button-primary"
                       href="https://spqr.wtf/support-me" target="_blank">Donate</a>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>

<script>

module.exports = {

	settings: true,

	props: ['package'],

	ready: function () {
		this.tab = UIkit.tab (this.$els.tab, {connect: this.$els.content});
	},

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
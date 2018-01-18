const CopyWebpackPlugin = require ('copy-webpack-plugin');
const path = require ('path');


module.exports = [
	{
		entry: {
			"exitintent-settings": "./app/components/exitintent-settings.vue"
		},
		output: {
			filename: "./app/bundle/[name].js"
		},
		plugins: [
			new CopyWebpackPlugin ([
				{
					from: './node_modules/ouibounce/build',
					to: './app/assets/ouibounce'
				}
			], {
				ignore: [
					'*.txt'
				],
				copyUnmodified: true
			})
		],
		module: {
			loaders: [
				{test: /\.vue$/, loader: "vue"}
			]
		}
	}
];
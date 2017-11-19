module.exports = [
    {
        entry: {
			"exitintent-settings": "./app/components/exitintent-settings.vue"
        },
        output: {
            filename: "./app/bundle/[name].js"
        },
        module: {
            loaders: [
                {test: /\.vue$/, loader: "vue"}
            ]
        }
    }

];
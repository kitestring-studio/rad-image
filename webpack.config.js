const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
	mode: 'production',
	entry: {
		gallery: [ './node_modules/simplelightbox/dist/simple-lightbox.js', './assets/js/simplelightbox-config.js', './node_modules/simplelightbox/dist/simple-lightbox.css' ],
	},
	output: {
		path: path.resolve(__dirname, 'dist'),
		filename: '[name].bundle.js'
	},
	module: {
		rules: [
			{
				test: /\.css$/,
				use: [
					MiniCssExtractPlugin.loader,
					'css-loader'
				]
			}
		]
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: '[name].bundle.css'
		})
	]
};

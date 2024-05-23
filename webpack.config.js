const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
	mode: 'production',
	entry: {},
	output: {
		path: path.resolve(__dirname, 'dist'),
		filename: '[name].bundle.js'
	},
	module: {
		rules: []
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: '[name].bundle.css'
		})
	]
};

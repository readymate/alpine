const path = require('path');
const loaders = require('./loaders');
const plugins = require('./plugins');

module.exports = {
    module: {
        rules: [
            loaders.CSSLoader,
            loaders.JSLoader,
            loaders.ESLintLoader
        ]
    },
    entry: {
        client: './src/js/client/index.js',
        admin: './src/js/admin/index.js',
        gutenberg: './src/js/gutenberg/index.js',
        customizer: './src/js/customizer/index.js',
    },
    output: {
        path: path.resolve('dist'),
        filename: 'js/[name].bundle.js'
    },
    externals: {
        jquery: 'jQuery',
        wp: 'wp'
    },
    plugins: [
        plugins.MiniCssExtractPlugin,
    ],
};

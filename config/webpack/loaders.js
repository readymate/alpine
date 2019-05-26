const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

const CSSLoader = {
    test: /\.css$/,
    exclude: /node_modules/,
    use: [{
            loader: MiniCssExtractPlugin.loader,
            options: {
                publicPath: path.resolve('dist/css')
            }
        },
        {
            loader: 'css-loader',
            options: { importLoaders: 1 },
        },
        {
            loader: 'postcss-loader',
            options: {
                config: {
                    path: path.resolve('config/webpack/postcss.config.js')
                }
            },
        },
    ],
};

const JSLoader = {
    test: /\.js$/,
    exclude: /node_modules/,
    use: {
        loader: 'babel-loader',
        options: {
            presets: ['@babel/preset-env']
        }
    }
};

const ESLintLoader = {
    test: /\.js$/,
    enforce: 'pre',
    exclude: /node_modules/,
    use: {
        loader: 'eslint-loader',
        options: {
            configFile: path.resolve('.eslintrc')
        },
    }
};

module.exports = {
    CSSLoader: CSSLoader,
    JSLoader: JSLoader,
    ESLintLoader: ESLintLoader,
};

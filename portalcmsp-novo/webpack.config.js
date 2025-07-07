const path = require('path');
const webpack = require('webpack');
// include the js minification plugin
const TerserPlugin = require("terser-webpack-plugin");

// include the css extraction and minification plugins
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');

// include the copy
const CopyPlugin = require("copy-webpack-plugin");

module.exports = {
    devtool: 'source-map',
    mode: 'development',
    entry: [
        './assets/scripts/app.js',
        './assets/scss/index.scss'
    ],
    output: {
        filename: './dist/js/app.js',
        path: path.resolve(__dirname)
    },
    module: {
        rules: [
            // perform js babelization on all .js files
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: "babel-loader",
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            },
            {
                test: /\.(sass|scss)$/,
                use: [MiniCssExtractPlugin.loader, 'css-loader?url=false', 'sass-loader']
            }
        ]
    },
    resolve: {
        alias: {
            "TweenLite": path.resolve('node_modules', 'gsap/src/uncompressed/TweenLite.js'),
            "TweenMax": path.resolve('node_modules', 'gsap/src/uncompressed/TweenMax.js'),
            "TimelineLite": path.resolve('node_modules', 'gsap/src/uncompressed/TimelineLite.js'),
            "TimelineMax": path.resolve('node_modules', 'gsap/src/uncompressed/TimelineMax.js'),
            "ScrollMagic": path.resolve('node_modules', 'scrollmagic/scrollmagic/uncompressed/ScrollMagic.js'),
            "animation.gsap": path.resolve('node_modules', 'scrollmagic/scrollmagic/uncompressed/plugins/animation.gsap.js'),
            "debug.addIndicators": path.resolve('node_modules', 'scrollmagic/scrollmagic/uncompressed/plugins/debug.addIndicators.js')
        },
    },
    plugins: [
        // extract css into dedicated file
        new MiniCssExtractPlugin({
            filename: './dist/css/main.min.css'
        }),

        new CopyPlugin({
            patterns: [
                {from: './assets/images', to: './dist/images'}
            ]
        }),
    ],
    optimization: {
        minimize: true,
        minimizer: [
            // enable the js minification plugin
            new TerserPlugin(),
            // enable the css minification plugin
            new CssMinimizerPlugin()
        ]
    }
};
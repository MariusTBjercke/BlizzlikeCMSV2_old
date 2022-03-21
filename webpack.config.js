const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const FixStyleOnlyEntriesPlugin = require('webpack-fix-style-only-entries');
const TerserPlugin = require('terser-webpack-plugin');
const webpack = require('webpack');
const isProduction = process.argv[process.argv.indexOf('--mode') + 1] === 'production';

// Compress output files?
let compressFiles = false;

// Clean/remove all files on build?
let cleanFiles = false;

const webpackConfig = {
    entry: {
        bundle: '/assets/js/index.ts',
        style: '/assets/scss/style.scss',
        wysiwyg: '/assets/scss/wysiwyg.scss'
    },
    output: {
        filename: 'assets/js/[name].min.js',
        path: path.resolve(__dirname, 'html'),
        clean: cleanFiles
    },
    module: {
        rules: [
            {
                test: /\.tsx?$/,
                use: 'ts-loader',
                exclude: /node_modules/,
            },
            {
                test: /\.svg|png|jpg|jpeg|gif$/,
                type: 'asset/resource',
                generator: {
                    filename: 'assets/img/[name][ext]'
                }
            },
            {
                test: /\.s[ac]ss$/i,
                use: [
                    MiniCssExtractPlugin.loader,
                    "css-loader",
                    "sass-loader"
                ],
            },
        ]
    },
    optimization: {
        minimize: isProduction ? true : compressFiles,
        minimizer: [
            new TerserPlugin(),
            new CssMinimizerPlugin(),
        ],
    },
    plugins: [
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            'window.jQuery': 'jquery'
        }),
        new MiniCssExtractPlugin({
            filename: "assets/css/[name].min.css",
        }),
        new FixStyleOnlyEntriesPlugin({
            silent: true,
        }),
    ]
};

module.exports = [webpackConfig];
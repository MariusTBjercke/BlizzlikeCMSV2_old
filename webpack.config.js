const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');
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

const pageNames = ["index", "contact"];

const htmlPages = pageNames.map(name => {
    return new HtmlWebpackPlugin({
        filename: name + '.html',
        template: 'assets/templates/' + name + '.twig',
    });
});

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
                test: /\.twig$/,
                use: [
                    {
                        loader: 'html-loader',
                    },
                    {
                        loader: 'twig-html-loader',
                        options: {
                            data: (context) => {
                                const data = path.join(__dirname, 'assets/data/data.json');
                                context.addDependency(data); // Force Webpack to watch file
                                return context.fs.readJsonSync(data, { throws: false }) || {};
                            }
                        }
                    }
                ]
            },
            {
                test: /\.svg|png|jpg|jpeg|gif$/,
                type: 'asset/resource',
                generator: {
                    filename: 'assets/img/[hash][ext][query]'
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
    ].concat(htmlPages)
};

module.exports = [webpackConfig];
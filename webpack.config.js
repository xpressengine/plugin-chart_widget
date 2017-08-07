var path = require('path');
var webpack = require('webpack');
var CommonsChunkPlugin = require('webpack/lib/optimize/CommonsChunkPlugin');

module.exports = {
  devtool: 'source-map',
  entry: {
    'XeChart': './assets/js/XeChart.js'
  },
  output: {
    path: path.resolve(__dirname, './assets/js/build'),
    filename: '[name].js',
  },
  plugins: [
    new webpack.NoEmitOnErrorsPlugin(),
    new webpack.optimize.UglifyJsPlugin({ mangle: true, warnings: false, sourceMap: false }),
    new webpack.DefinePlugin({
      'process.env': {
        NODE_ENV: JSON.stringify('production'),
      },
    }),
  ],
  module: {
    rules: [
      {
        test: /(\.js|\.jsx)$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            cacheDirectory: true,
            presets: ['env'],
          },
        },
      },
    ],
  },
  resolve: {
    extensions: ['.js'],
  },
  externals: {
    window: 'window',
  },
};;

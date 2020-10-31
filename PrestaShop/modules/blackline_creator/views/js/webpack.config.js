const path = require('path');

module.exports = {
  mode: "development",
  entry: "./src/creator.js",
  stats: "normal",
  watch: true,
  watchOptions: {
    aggregateTimeout: 200,
    poll: 100,
    ignored: /node_modules/
  },
  output: {
    path:path.resolve(__dirname, "dist"),
    filename: "[name].js",
  },
  module: {
    rules: [
      {
        test: /\.m?js$/,
        include: [
          path.resolve(__dirname, "src")
        ],
        exclude: [
          path.resolve(__dirname, "src/demo-files")
        ],
        loader: "babel-loader",
        options: {
          presets: ['@babel/preset-env']
        },
      },
    ],
  },
  resolve: {
    modules: ["node_modules",path.resolve(__dirname, "src")],
    extensions: [".js"],
  },
  performance: {
    hints: "warning",
    maxAssetSize: 200000,
    maxEntrypointSize: 400000,
  },
  devtool: "source-map",
  optimization: {
    chunkIds: "size",
    moduleIds: "size",
    mangleExports: "size",
    minimize: true,
  },
}
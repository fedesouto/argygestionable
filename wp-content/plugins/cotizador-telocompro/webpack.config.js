module.exports = {
  entry: { backoffice: "./src/index.js", frontend: "./src/index.frontend.js" },
  output: {
    path: __dirname,
    filename: "./dist/[name].bundle.js",
  },
  module: {
    loaders: [
      {
        test: /.js$/,
        loader: "babel-loader",
        exclude: /node_modules/,
        options: {
          presets: [["env", "react"]],
          plugins: ["transform-class-properties"],
        },
      },
    ],
  },
};

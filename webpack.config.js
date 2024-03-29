const currentTask = process.env.npm_lifecycle_event;
const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");
const ManifestPlugin = require("webpack-manifest-plugin");
const fse = require("fs-extra");

const postCSSPlugins = [
  require("postcss-import"),
  require("postcss-mixins"),
  require("postcss-simple-vars"),
  require("postcss-nested"),
  require("postcss-hexrgba"),
  require("postcss-color-function"),
  require("autoprefixer"),
];

class RunAfterCompile {
  apply(compiler) {
    compiler.hooks.done.tap("Update functions.php", function () {
      // update functions php here
      const manifest = fse.readJsonSync("./bundled-assets/manifest.json");

      fse.readFile("./functions.php", "utf8", function (err, data) {
        if (err) {
          console.log(err);
        }

        const scriptsRegEx = new RegExp("/bundled-assets/scripts.+?'", "g");
        const vendorsRegEx = new RegExp("/bundled-assets/vendors.+?'", "g");
        const cssRegEx = new RegExp("/bundled-assets/styles.+?'", "g");

        let result = data
          .replace(scriptsRegEx, `/bundled-assets/${manifest["scripts.js"]}'`)
          .replace(
            vendorsRegEx,
            `/bundled-assets/${manifest["vendors~scripts.js"]}'`
          )
          .replace(cssRegEx, `/bundled-assets/${manifest["scripts.css"]}'`);

        fse.writeFile("./functions.php", result, "utf8", function (err) {
          if (err) return console.log(err);
        });
      });
    });
  }
}

let cssConfig = {
  test: /\.css$/i,
  use: [
    "css-loader?url=false",
    { loader: "postcss-loader", options: { plugins: postCSSPlugins } },
  ],
};

let config = {
  entry: {
    scripts: "./js/scripts.js",
  },
  plugins: [],
  module: {
    rules: [
      cssConfig,
      {
        test: /\.js$/,
        exclude: /(node_modules)/,
        use: {
          loader: "babel-loader",
          options: {
            presets: [
              "@babel/preset-react",
              ["@babel/preset-env", { targets: { node: "12" } }],
            ],
          },
        },
      },
    ],
  },
};

if (currentTask == "devFast") {
  config.devtool = "source-map";
  cssConfig.use.unshift("style-loader");
  config.output = {
    filename: "bundled.js",
    publicPath: "http://localhost:3000/",
  };
  config.devServer = {
    before: function (app, server) {

      //server._watch(["./**/*.php", "./**/*.js"])
      server._watch(["./**/*.php", "!./functions.php"]);
    },
    public: "http://localhost:3000",
    publicPath: "http://localhost:3000/",
    disableHostCheck: true,
    contentBase: path.join(__dirname),
    contentBasePublicPath: "http://localhost:3000/",
    hot: false,
    port: 3000,
    headers: {
      "Access-Control-Allow-Origin": "*",
    },
  };
  config.mode = "development";
}

if (currentTask == "build" || currentTask == "buildWatch") {
  cssConfig.use.unshift(MiniCssExtractPlugin.loader);
  postCSSPlugins.push(require("cssnano"));
  config.output = {
    publicPath: "/wp-content/themes/bpbp/bundled-assets/",
    filename: "[name].[chunkhash].js",
    chunkFilename: "[name].[chunkhash].js",
    path: path.resolve(__dirname, "bundled-assets"),
  };
  config.mode = "production";
  config.optimization = {
    splitChunks: { chunks: "all" },
  };
  config.plugins.push(
    new CleanWebpackPlugin(),
    new MiniCssExtractPlugin({ filename: "styles.[chunkhash].css" }),
    new ManifestPlugin({ publicPath: "" }),
    new RunAfterCompile()
  );
}

module.exports = config;

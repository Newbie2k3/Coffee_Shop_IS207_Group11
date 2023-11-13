const mix = require("laravel-mix");
const glob = require("glob");
const path = require("path");

mix.options({
    resourceRoot: process.env.ASSET_URL || undefined,
    processCssUrls: false,
    postCss: [require("autoprefixer")],
});

/*
 |--------------------------------------------------------------------------
 | Assets
 |--------------------------------------------------------------------------
*/
function mixAssetsDir(query, cb) {
    const SRC = "resources/assets/";
    const DEST = "public/assets/";

    try {
        const files = glob.sync(SRC + query);
        files.forEach((f) => {
            f = f.replace(/[\\\/]+/g, "/");
            const destPath = f.replace(SRC, DEST);

            cb(f, destPath);
        });

        console.log(`Successfully processed ${files.length} files.`);
    } catch (error) {
        console.error("Error:", error.message);
    }
}

/*
  |--------------------------------------------------------------------------
  | Configure sass
  |--------------------------------------------------------------------------
*/
const sassOptions = {
    precision: 5,
};

// Core stylesheets
mixAssetsDir("sass/**/!(_)*.scss", (src, dest) =>
    mix.sass(
        src,
        dest
            .replace(/(\\|\/)sass(\\|\/)/, "$1css$2")
            .replace(/\.scss$/, ".css"),
        { sassOptions }
    )
);

// Core javascripts
mixAssetsDir("js/**/*.js", (src, dest) => mix.js(src, dest));

/*
 |--------------------------------------------------------------------------
 | Browsersync Reloading
 |--------------------------------------------------------------------------
 |
 | BrowserSync can automatically monitor your files for changes, and inject your changes into the browser without requiring a manual refresh.
 | You may enable support for this by calling the mix.browserSync() method:
 | Make Sure to run `php artisan serve` and `yarn watch` command to run Browser Sync functionality
 | Refer official documentation for more information: https://laravel.com/docs/10.x/mix#browsersync-reloading
*/

mix.browserSync("http://127.0.0.1:8000/");

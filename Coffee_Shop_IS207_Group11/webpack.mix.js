const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/assets/js").sass(
    "resources/sass/app.scss",
    "public/assets/css"
);

/*
 |--------------------------------------------------------------------------
 | Assets
 |--------------------------------------------------------------------------
 */

function mixAssetsDir(query, cb) {
    (glob.sync("resources/assets/" + query) || []).forEach((f) => {
        f = f.replace(/[\\\/]+/g, "/");
        cb(f, f.replace("resources/assets/", "public/assets/"));
    });
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
mixAssetsDir("vendor/scss/**/!(_)*.scss", (src, dest) =>
    mix.sass(
        src,
        dest
            .replace(/(\\|\/)scss(\\|\/)/, "$1css$2")
            .replace(/\.scss$/, ".css"),
        { sassOptions }
    )
);

// Core javascripts
mixAssetsDir("vendor/js/**/*.js", (src, dest) => mix.js(src, dest));

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

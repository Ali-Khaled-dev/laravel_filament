const mix = require("laravel-mix");

mix.js("resources/scripts/main.ts", "public/js").postCss(
    "resources/css/app.css",
    "public/css",
    [require("tailwindcss")]
);

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs';
import path from 'path';

function getFiles(directory, extension) {
  const directoryPath = path.join(__dirname, directory);

  return fs.readdirSync(directoryPath).filter((file) => file.endsWith(`.${extension}`));
}

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/assets/css/pages/home.css',
                'resources/assets/css/pages/product-detail.css',
                ...getFiles('resources/assets/js', 'js').map((file) => `resources/assets/js/${file}`),
            ],
            refresh: true,
        }),
    ],
});

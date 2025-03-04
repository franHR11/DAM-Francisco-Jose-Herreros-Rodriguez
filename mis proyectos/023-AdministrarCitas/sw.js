const nombrecache = 'apv-v1';

const archivos =[
    './',
    './index.html',
    './js/app.js',
    './js/app2.js',
    './dist/output.css',
    './manifest.json',
    './sw.js'
];
// cuando se instala el Service Worker
self.addEventListener('install', function(event) {
    console.log('Instalando Service Worker');
    event.waitUntil(
        caches.open(nombrecache).then(function(cache) {
            console.log('Abriendo cache');
            return cache.addAll(archivos);
        })
    );
});
//  activado cuando se actualiza el Service Worker
self.addEventListener('activate', function(event) {
    console.log('Activando Service Worker');
    console.log(event);
});
// evento fetch
self.addEventListener('fetch', function(event) {
    console.log('Fetching:', event.request.url);
    event.respondWith(
        fetch(event.request).catch(function(error) {
            console.log('Fetch Error:', error);
        })
    );
});
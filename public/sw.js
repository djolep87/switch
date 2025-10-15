const preLoad = function () {
  return caches.open('offline').then(function (cache) {
    // caching index and important routes
    return cache.addAll(filesToCache);
  });
};

self.addEventListener('install', function (event) {
  event.waitUntil(preLoad());
});

const filesToCache = [
  '/',
  '/offline.html',
  '/manifest.json',
  '/logo.png',
  '/assets/css/bootstrap.min.css',
  '/assets/css/app.css',
  '/assets/css/icons.css',
  '/assets/js/bootstrap.bundle.min.js',
  '/assets/js/app.js',
  '/images/icons/icon-192x192.png',
  '/images/icons/icon-512x512.png',
];

const checkResponse = function (request) {
  return new Promise(function (fulfill, reject) {
    fetch(request).then(function (response) {
      if (response.status !== 404) {
        fulfill(response);
      } else {
        reject();
      }
    }, reject);
  });
};

const addToCache = function (request) {
  // Only cache http(s) requests
  if (!request.url.startsWith('http')) {
    return Promise.resolve();
  }
  return caches.open('offline').then(function (cache) {
    return fetch(request).then(function (response) {
      return cache.put(request, response);
    });
  });
};

const returnFromCache = function (request) {
  return caches.open('offline').then(function (cache) {
    return cache.match(request).then(function (matching) {
      if (!matching || matching.status === 404) {
        return cache.match('offline.html');
      } else {
        return matching;
      }
    });
  });
};

self.addEventListener('fetch', function (event) {
  event.respondWith(
    checkResponse(event.request).catch(function () {
      return returnFromCache(event.request);
    })
  );
  if (!event.request.url.startsWith('http')) {
    event.waitUntil(addToCache(event.request));
  }
});

// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: "AIzaSyA6qs7rT_iiIYvWrJAVHYBH51PdDQ-howY",
    authDomain: "laravel-notification-9c99f.firebaseapp.com",
    databaseURL: "https://laravel-notification-9c99f-default-rtdb.firebaseio.com",
    projectId: "laravel-notification-9c99f",
    storageBucket: "laravel-notification-9c99f.appspot.com",
    messagingSenderId: "286769532458",
    appId: "1:286769532458:web:e55429f7bece4f01377d53",
    measurementId: "G-SDML4HDMDZ"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };
    return self.registration.showNotification(
        title,
        options,
    );
});
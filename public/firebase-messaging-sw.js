/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/6.3.4/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/6.3.4/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyDq86Bkx3Y2zaZbAQCNSc6FeeJ_8A_fwzo",
    authDomain: "najlaboutique2021.firebaseapp.com",
    databaseURL: "https://najlaboutique2021.firebaseio.com",
    projectId: "najlaboutique2021",
    storageBucket: "najlaboutique2021.appspot.com",
    messagingSenderId: "134240189270",
    appId: "1:134240189270:web:b2caa55ba1151926e634f7",
    measurementId: "G-WVYRCNK7DK"
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    // Customize notification here
    const notificationTitle = 'Background Message Title';
    const notificationOptions = {
        body: 'Background Message body.',
        icon: '/firebase-logo.png'
    };

    return self.registration.showNotification(notificationTitle,
        notificationOptions);
});
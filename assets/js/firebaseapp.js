/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Initialize Firebase
var config = {
    apiKey: "AIzaSyCiWk8UluHYqp328Js3jHD3Vz9fKNsyx90",
    authDomain: "gaeloginendpoint.firebaseapp.com",
    databaseURL: "https://gaeloginendpoint.firebaseio.com",
    storageBucket: "gaeloginendpoint.appspot.com",
    messagingSenderId: "811880962924"
};
firebase.initializeApp(config);


// Retrieve Firebase Messaging object.
const messaging = firebase.messaging();
messaging.requestPermission()
        .then(function () {
            console.log('Notification permission granted.');
            return messaging.getToken();
        })

        .catch(function (err) {
            console.log('Unable to get permission to notify.', err);
        });
messaging.getToken()
        .then(function (currentToken) {
            console.log(currentToken);
            if (currentToken) {
                //sendTokenToServer(currentToken);
                //updateUIForPushEnabled(currentToken);
            } else {
                // Show permission request.
                console.log('No Instance ID token available. Request permission to generate one.');
                // Show permission UI.
                //updateUIForPushPermissionRequired();
                //setTokenSentToServer(false);
            }
        })
        .catch(function (err) {
            console.log('An error occurred while retrieving token. ', err);
            //showToken('Error retrieving Instance ID token. ', err);
            setTokenSentToServer(false);
        });
messaging.onTokenRefresh(function () {
    messaging.getToken()
            .then(function (refreshedToken) {
                console.log('Token refreshed.');
                // Indicate that the new Instance ID token has not yet been sent to the
                // app server.
                setTokenSentToServer(false);
                // Send Instance ID token to app server.
                sendTokenToServer(refreshedToken);
                // ...
            })
            .catch(function (err) {
                console.log('Unable to retrieve refreshed token ', err);
                showToken('Unable to retrieve refreshed token ', err);
            });
});

messaging.onMessage(function (payload) {
    console.log('On message', payload);
});

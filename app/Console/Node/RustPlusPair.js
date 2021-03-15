const args = process.argv.slice(2);

if(args.length < 4) {
    throw new Error('Required params: ip, port, playerid, playerToken');
}

// self destruct
setTimeout(() => {
    throw new Error('Timed out');
}, 1000 * 60);

const axios = require('axios');
const express = require('express');
const { v4: uuidv4 } = require('uuid');
const { register, listen } = require('push-receiver');

const app = express();
const port = 3000;
const server = app.listen(port);

var expoPushToken = null;
var steamAuthToken = args[3];

async function run() {

    console.log("Registering with FCM");
    const credentials = await register('976529667804');

    console.log("Fetching Expo Push Token");
    axios.post('https://exp.host/--/api/v2/push/getExpoPushToken', {
        deviceId: uuidv4(),
        experienceId: '@facepunch/RustCompanion',
        appId: 'com.facepunch.rust.companion',
        deviceToken: credentials.fcm.token,
        type: 'fcm',
        development: false,
    }).then(async (response) => {

        expoPushToken = response.data.data.expoPushToken;
        console.log("Received Expo Push Token: " + expoPushToken);

        if(steamAuthToken){

            console.log("Steam Account Connected.");

            // register with Rust Companion API
            console.log("Registering with Rust Companion API");
            axios.post('https://companion-rust.facepunch.com:443/api/push/register', {
                AuthToken: steamAuthToken,
                DeviceId: 'rustplus.js',
                PushKind: 0,
                PushToken: expoPushToken,
            }).then((response) => {
                console.log("Successfully registered with Rust Companion API.");
                console.log("When you Pair with Servers or Smart Devices in game, notifications will appear here.");
            }).catch((error) => {
                console.log("Failed to register with Rust Companion API");
                console.log(error);
            });

        } else {
            console.log('token missing from request!');
        }

       

        console.log("Listening for FCM Notifications");
        await listen(credentials, ({ notification, persistentId }) => {

            // parse notification body
            const body = JSON.parse(notification.data.body);

            // log notification body
            console.log(notification.data.body);
            shutdown();

        });

    }).catch((error) => {
        console.log("Failed to fetch Expo Push Token");
        console.log(error);
    });

}

process.on('SIGTERM', shutdown);
process.on('SIGINT', shutdown);

async function shutdown() {

    // unregister with Rust Companion API
    if(steamAuthToken){
        console.log("Unregistering from Rust Companion API");
        await axios.delete('https://companion-rust.facepunch.com:443/api/push/unregister', {
            data: {
                AuthToken: steamAuthToken,
                PushToken: expoPushToken,
                DeviceId: 'rustplus.js',
            },
        }).then((response) => {
            console.log("Successfully unregistered from Rust Companion API");
        }).catch((error) => {
            console.log(error);
        });
    }

    // stop http server
    server.close(() => {
        process.exit(0);
    });

}

run();

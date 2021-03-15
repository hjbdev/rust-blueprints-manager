const args = process.argv.slice(2);
const fs = require('fs');

if(args.length < 4) {
    throw new Error('Required params: ip, port, playerid, playerToken');
}

const RustPlus = require('@liamcottle/rustplus.js');

// ip port playerid playerToken



var rustplus = new RustPlus(args[0], args[1], args[2], args[3]);

// wait until connected before sending commands
rustplus.on('connected', () => {
    rustplus.getMap((message) => {

        console.log(message);
        // save jpg image of map to file
        fs.writeFileSync('map.jpg', message.response.map.jpgImage);

        // disconnect from rust server
        rustplus.disconnect();

    });
});

// connect to rust server
rustplus.connect();
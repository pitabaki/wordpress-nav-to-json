const fs = require("fs"),
    path = require("path"),
    watch = require("node-watch"),
    { exec } = require('child_process');

let watchPath = path.join(__dirname, "/prod/");

let executeWhenChangesMade = () => {
    exec("gulp god", (err, stdout, stderr) => {
        if ( err ) {
            console.error(err);
            return;
        }
        console.log(stdout);
        console.log("gulp god complete");
    });
};


console.log("Watching for changes at " + watchPath);
//console.log("Watching for changes at " + watchPath);

watch( watchPath, { recursive: true }, (evt, name) => {
    console.log('%s changed.', name);
    executeWhenChangesMade();
});


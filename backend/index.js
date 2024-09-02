const express = require('express')
const path = require('path');
const app = express()
const port = 5050

app.get('/', function(req, res) {
    res.sendFile(path.join(__dirname, '../frontend/log.html'));
    // res.sendFile(__dirname + '/' + 'log.html');
});

app.listen(port, () => {
  console.log(`Example app listening on port http://localhost:${port}`)
})
const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql')

const app = express()
const http = require('http');
const server = http.createServer(app);
const port = process.env.PORT || 5000

app.use(bodyParser.urlencoded({ extended: false }))

app.use(bodyParser.json())

//MySQL
const db = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: 'mundo',
})

db.connect((err) => {
    if (err) {
        throw err;
    }
    console.log("Connection done")
})

app.get('/', (req, res) => {
    res.send('<h1>Hello world</h1>');
  });

// Listen on enviroment port or 5000
app.listen(port, () => console.log('Listen on port ', port, ' '))
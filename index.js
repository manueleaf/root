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
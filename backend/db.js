const sqlite3 = require('sqlite3').verbose();
const db = new sqlite3.Database('../itprojects.db');

const addPerson = (name, password, type_user) => {
    return new Promise((resolve, reject) => {
        db.run('INSERT INTO users (name, password, type_user) VALUES (?, ?, ?)', [name, password, type_user], function (err) {
            if (err) reject(err);
        });
    });
};

const getProjects = () => {
    return new Promise((resolve, reject) => {
        db.all('SELECT * FROM projects',  function (err, rows) {
            if (err) {
                reject(err);
            }
            else {
                resolve(rows);
            }
        });
    });
};

const getCom = () => {
    return new Promise((resolve, reject) => {
        db.all('SELECT * FROM COM',  function (err, rows) {
            if (err) {
                reject(err);
            }
            else {
                resolve(rows);
            }
        });
    });
};

const getEmp = () => {
    return new Promise((resolve, reject) => {
        db.all('SELECT * FROM emp',  function (err, rows) {
            if (err) {
                reject(err);
            }
            else {
                resolve(rows);
            }
        });
    });
};

const getCustomer = () => {
    return new Promise((resolve, reject) => {
        db.all('SELECT * FROM customer',  function (err, rows) {
            if (err) {
                reject(err);
            }
            else {
                resolve(rows);
            }
        });
    });
};

const getPerson = (name, password) => {
    return new Promise((resolve, reject) => {
        db.all('SELECT * FROM users WHERE name = ? AND password = ?', [name, password], (err, rows) => {
            if(err) {
                console.log(err);
                reject(err);
            }
            else{
                if(rows.length > 0) {
                    resolve(rows[0]);
                }
                else {
                    resolve(null);
                    // reject(err);
                }
            }
          });
    });
};

module.exports = {
    addPerson, getPerson, getProjects, getCom, getEmp, getCustomer
};
const sqlite3 = require('sqlite3').verbose();
const db = new sqlite3.Database('./itprojects.db');

const addPerson = (name, password, type_user) => {
    return new Promise((resolve, reject) => {
        db.run('INSERT INTO users (name, password, type_user) VALUES (?, ?, ?)', [name, password, type_user], function (err) {
            if (err) reject(err);
        });
    });
};

const getPerson = (name, password) => {
    return new Promise((resolve, reject) => {
        db.all('SELECT * FROM users WHERE name = ? AND password = ?)', [name, password], (err, rows) => {
            if (err) {
              throw err;
            }

            let i = 0;
            while(rows[i] != null) {
                console.log(rows[i].name);
                i++;
            }

            // rows.forEach((row) => {
            //   console.log(row.name);
            // });
          });
    });
};

module.exports = {
    addPerson
};
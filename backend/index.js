const express = require('express')
const path = require('path');
const db = require('./db.js');
const app = express()
const port = 5050
app.use(express.json());


app.get('/', function(req, res) {
    res.sendFile(path.join(__dirname, '../frontend/log.html'));
});

app.use(express.static(path.join(__dirname, '../frontend')));

// __dirname + "/../frontend/log.html"
// app.get('/styles/style.css', function(req, res) {
//     res.sendFile(path.join(__dirname, '../frontend/styles/style.css'));
// });

// app.get('/script.js', function(req, res) {
//     res.sendFile(path.join(__dirname, '../frontend/script.js'));
// });

app.post('/users/add', async (req, res) => {
    try {
        const { name, password, user_type } = req.body;

        const newTask = await db.addPerson( name, password, user_type);
        res.status(200).json(newTask);
    } catch (error) {
        res.status(500).json({ error: 'Failed to add task' });
    }
});

app.post('/users/get', async (req, res) => {
    try {
        const { name, pass } = req.body;
        console.log(name, pass);
        
        const user = await db.getPerson(name, pass);
        if(user == null) {
            res.status(400);
        }
        else {
            res.status(200).json(user);
        }
    } catch (error) {
        res.status(500).json({ error: 'Failed to add task' });
    }
});


app.get('/project/get', async (req, res) => {
    try{
        let projects = await db.getProjects();
        if(projects.length == 0) {
            res.status(400);
        }
        else {
            res.status(200).json(projects);
        }
    }
    catch(error) {
        res.status(500).json({ error: 'Failed to add task' });
    }
})

app.listen(port, () => {
  console.log(`Example app listening on port http://localhost:${port}`)
})

app.get('/com/get', async (req, res) => {
    try{
        let coms = await db.getCom();
        if(coms.length == 0) {
            res.status(400);
        }
        else {
            res.status(200).json(coms);
        }
    }
    catch(error) {
        res.status(500).json({ error: 'Failed to add task' });
    }
})

app.get('/emp/get', async (req, res) => {
    try{
        let emps = await db.getEmp();
        if(emps.length == 0) {
            res.status(400);
        }
        else {
            res.status(200).json(emps);
        }
    }
    catch(error) {
        res.status(500).json({ error: 'Failed to add task' });
    }
})

app.get('/customer/get', async (req, res) => {
    try{
        let customers = await db.getCustomer();
        if(customers.length == 0) {
            res.status(400);
        }
        else {
            res.status(200).json(customers);
        }
    }
    catch(error) {
        res.status(500).json({ error: 'Failed to add task' });
    }
})
let express = require('express');
let app = express();
let bodyParser = require('body-parser');
let mysql = require('mysql');

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

// homepage route
app.get('/', (req, res) => {
    return res.send({ 
        error: false, 
        message: 'Welcome to RESTful CRUD API',
        written_by: 'Anucha',
        published_on: 'https://anucha.dev'
    })
})

let dbCon = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'datalist'
})
dbCon.connect();

app.get('/lists', (req, res) => {
    dbCon.query('SELECT * FROM todolist', (error, results, fields) => {
        if (error) throw error;

        let message = ""
        if (results === undefined || results.length == 0) {
            message = "list table is empty";
        } else {
            message = "Successfully retrieved all list";
        }
        return res.send({ error: false, data: results, message: message});
    })
})

app.post('/list', (req, res) => {
    let list = req.body.list;
    let statuslist = req.body.statuslist;


    if (!list || !statuslist) {
        return res.status(400).send({ error: true, message: "Please provide list and statuslis."});
    } else {
        dbCon.query('INSERT INTO todolist (list,statuslist) VALUES(?, ?)', [list, statuslist], (error, results, fields) => {
            if (error) throw error;
            return res.send({ error: false, data: results, message: "list successfully added"})
        })
    }
});


app.get('/list/:id', (req, res) => {
    let id = req.params.id;

    if (!id) {
        return res.status(400).send({ error: true, message: "Please provide list id"});
    } else {
        dbCon.query("SELECT * FROM todolist WHERE id = ?", id, (error, results, fields) => {
            if (error) throw error;

            let message = "";
            if (results === undefined || results.length == 0) {
                message = "list not found";
            } else {
                message = "Successfully retrieved list data";
            }

            return res.send({ error: false, data: results[0], message: message })
        })
    }
})


app.put('/liste', (req, res) => {
    let id = req.body.id;
    let list = req.body.list;
    let statuslist = req.body.statuslist;


    if (!id || !list || !statuslist) {
        return res.status(400).send({ error: true, message: 'Please provide book id, list and statuslist'});
    } else {
        dbCon.query('UPDATE todolist SET list = ?, statuslist = ? WHERE id = ?', [list, statuslist, id], (error, results, fields) => {
            if (error) throw error;

            let message = "";
            if (results.changedRows === 0) {
                message = "Book not found or data are same";
            } else {
                message = "Book successfully updated";
            }

            return res.send({ error: false, data: results, message: message })
        })
    }
})


app.delete('/listd', (req, res) => {
    let id = req.body.id;

    if (!id) {
        return res.status(400).send({ error: true, message: "Please provide list id"});
    } else {
        dbCon.query('DELETE FROM todolist WHERE id = ?', [id], (error, results, fields) => {
            if (error) throw error;

            let message = "";
            if (results.affectedRows === 0) {
                message = "list not found";
            } else {
                message = "list successfully deleted";
            }

            return res.send({ error: false, data: results, message: message })
        })
    }
})

app.listen(3000, () => {
    console.log('port 3000');
})

module.exports = app;
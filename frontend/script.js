const elem = document.getElementById("signup");
const login = document.getElementById("login");
const form = document.getElementById("form");
const regForm = document.getElementById("formRegist");

// elem.addEventListener('click', async (e) => {
//     e.preventDefault();

// let name = "Oscar";
// let password = "dasha12345";
// let user_type = "admin1";

//     await fetch('/users/add', {
//         method: 'POST', // GET, PUT, DELETE
//         headers: {
//             'Content-Type': 'application/json'
//         },
//         body: JSON.stringify({ name, password, user_type })
//     });

// });

regForm.addEventListener('submit', async (event) => {
    event.preventDefault();
    const loginInput = document.querySelector('input[name="login"]').value;
    const passwordInput = document.querySelector('input[name="password"]').value;
    const passwordInputRepeat = document.querySelector('input[name="passwordRepeat"]').value;

    if (passwordInput !== passwordInputRepeat && login.includes(' ') !== true) {
        let result = await fetch('/users/add', {
            method: 'POST', // GET, PUT, DELETE
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ "name": loginInput, "password": passwordInput, "user_type": "user" })
        });
        if(result.status === 200) {
            document.querySelector('input[name="login"]').textContent = "";
            document.querySelector('input[name="password"]').textContent = "";
            document.querySelector('input[name="passwordRepeat"]').textContent = "";
            
            window.location.href = "log.html";
        }
    };
});

form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const loginInput = document.querySelector('input[name="login"]');
    const passwordInput = document.querySelector('input[name="password"]');

    const loginValue = loginInput.value;
    const passwordValue = passwordInput.value;

    if (loginValue != "" && passwordValue != "") {
        let result = await fetch('/users/get', {
            method: 'POST', // GET, PUT, DELETE
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "name": loginValue,
                "pass": passwordValue
            })
        });
        if (result.status == 200) {
            window.location.href = "main.html"
        }
    }
});


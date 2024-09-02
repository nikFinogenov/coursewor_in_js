const elem = document.getElementById("signup");
const login = document.getElementById("login");


elem.addEventListener('click', async (e) => {
    e.preventDefault();

    let name = "Oscar";
    let password = "dasha12345";
    let user_type = "admin";

    await fetch('/users/add', {
        method: 'POST', // GET, PUT, DELETE
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ name, password, user_type })
    });

});

login.addEventListener('submit', async (e) => {
    e.preventDefault();
    const loginInput = document.querySelector('input[name="login"]');
    const passwordInput = document.querySelector('input[name="password"]');
    
    const loginValue = loginInput.value;
    const passwordValue = passwordInput.value;
    console.log(loginValue);
    if(loginValue != "" && passwordValue != "") {
        await fetch('/users/get', {
            method: 'POST', // GET, PUT, DELETE
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ loginValue, passwordValue })
        });
    }
});


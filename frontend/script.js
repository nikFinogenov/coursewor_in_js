const elem = document.getElementById("signup");
const login = document.getElementById("login");
const form = document.getElementById("form");


elem.addEventListener('click', async (e) => {
    e.preventDefault();

    let name = "Oscar";
    let password = "dasha12345";
    let user_type = "admin1";

    await fetch('/users/add', {
        method: 'POST', // GET, PUT, DELETE
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ name, password, user_type })
    });

});



form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const loginInput = document.querySelector('input[name="login"]');
    const passwordInput = document.querySelector('input[name="password"]');
    
    const loginValue = loginInput.value;
    const passwordValue = passwordInput.value;

    if(loginValue != "" && passwordValue != "") {
        let result = await fetch('/users/get', {
            method: 'POST', // GET, PUT, DELETE
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ 
                "name" : loginValue,
                "pass" : passwordValue
            })
        });
        if(result.status == 200) {
            window.location.href = "main.html"
        }
    }
});


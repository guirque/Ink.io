async function login_with_credentials()
{
    let username_or_email = document.getElementById('username_or_email').value,
    password = document.getElementById('password').value;

    // https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch
    let res = await fetch('/api/login.php', {
        method: "POST",
        body: new URLSearchParams({
            username_or_email,
            password
        }),
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        }
    })

    let positiveAlert = document.getElementById('pos-alert'),
    passwordAlert = document.getElementById('psw-alert');

    if(res.status == 200)    
    {
        new bootstrap.Collapse(positiveAlert, {show: true});
        //new bootstrap.Collapse(passwordAlert, {hide: true});
        setTimeout(()=>{
            location.href = "/";
        }, 3000);
    }
    else
    {
        new bootstrap.Collapse(passwordAlert, {show: true});

    }
}

async function login_with_cookie()
{
    let res = await fetch('/api/login_with_cookie.php', {
        method: "POST"
    })
}

document.getElementById('submit-button').addEventListener('click', (e)=>
    {
        e.preventDefault();
        login_with_credentials();
    })
document.getElementById('logout-btn').addEventListener('click', async ()=>
    {
        await fetch(`/api/logout.php`, {
            method: "GET",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        });
        location.href = '/';
    })
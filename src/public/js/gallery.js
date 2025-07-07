async function getDrawings()
{

    // https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch
    let res = await fetch('/api/get_recent_drawings.php', {
        method: "GET",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        }
    })

    res = await res.json();
    return res;
}

async function renderDrawings()
{
    let drawings = await getDrawings();
    
    let i = 0, last_column = null;
    for(let drawing of drawings)
    {
        console.log(drawing);
        if(i % 3 == 0)
        {
            // Adding new row
            let newRow = document.createElement('div');
            newRow.classList.add('row', 'row-cols-3');
            document.getElementById('gallery').appendChild(newRow);
            last_column = newRow;
        }

        // Adding new column with card
        let newCol = document.createElement('div');
        newCol.classList.add('col');
        let newCard = document.createElement('div');
        newCard.classList.add('card');

        newCard.innerHTML = `
            <!-- User info -->
            <div class="card-header hstack gap-2 align-items-center drawing-header">
                <img src="./img/icon.png" class="drawing-profile-img" alt="User photo" style="width:40px;">
                <h3 class="drawing-author"> User </h3>
            </div>

            <!-- Drawing itself -->
            <img class="card-img-top drawing-img" src="./img/drawing-placeholder.png" alt="a drawing"></img>

            <!-- Drawing info -->
            <div class="card-body">
                <div class="card-text drawing-description">
                    Thought it would be a fun idea to post this drawing I made a brief while ago.
                </div>
            </div>
        `;

        // Filling in with user data
        let header = newCard.querySelector('.drawing-header'),
        drawingImg = newCard.querySelector('.drawing-img'),
        cardDesc = newCard.querySelector('.drawing-description');

        header.querySelector('.drawing-profile-img').setAttribute('src', `./photos/user_profile/${drawing['Profile_Picture']}`);
        header.querySelector('.drawing-author').textContent = drawing['Author'];
        drawingImg.setAttribute('src', `./photos/user_drawing/${drawing['Image']}`);
        cardDesc.textContent = drawing['Description'];

        // Adding card to row
        newCol.appendChild(newCard);
        last_column.append(newCol);

        i++;
    }
}

renderDrawings();
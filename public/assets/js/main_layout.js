// Main layout functions and dynamic activities



// SEARCH PAGE APPEAR OR DISAPPEAR FUNCTION 


let searchBar = document.querySelector('.search-bar');

let searchPageContentCon = document.querySelector('.content-container');

let searchBarLoader = document.querySelector('.search-page > img')

searchBar.addEventListener('focus', openOrCloseSearchPage);

searchBar.addEventListener('input', (e)=>{ openOrCloseSearchPage(event=e, input=searchBar.value) });

window.addEventListener('click', openOrCloseSearchPage)

function openOrCloseSearchPage(event, input = 'test') {

    // searchPageContentCon.innerHTML = '';

    let searchPage = document.querySelector('.search-page');

    if(event.type == 'focus' || event.type == 'input') {

        searchPage.style.display = 'flex';

        searchBarLoader.style.display = 'inline-block';

        searchPageContentCon.innerHTML = '';

        const baseUrl = `http://127.0.0.1:8000/products/search`;
        const params = {
            search : input,
            limit : 10
        }

        getCatagoryContent(
            baseUrl, 
            params,
            'input'
        );

    }else if(event.target.className != 'search-bar' && event.target.className != 'search-page') {
        searchPage.style.display = 'none';
    } 
}

// FOR MENU

let menuCatagoryContent = document.querySelector('.catagory-content1 > .content');

let menuCatagoryLoader = document.querySelector('.catagory-content1 > img');


function loadCatagoryContent(catagory) {

    menuCatagoryContent.innerHTML = '';
    
    // searchBarLoader.style.display = 'inline-block';

    const baseUrl = `http://127.0.0.1:8000/products/search`;
    const params = {
        search : catagory,
        limit : 10
    }

    getCatagoryContent(
        baseUrl,
        params,
        'span'
    );

}


// FOR MENU

function getCatagoryContent(baseUrl, params, caller = 'input') {

    let queryString = new URLSearchParams(params).toString();

    const finnalUrl = `${baseUrl}?${queryString}`

    fetch(finnalUrl, {
        method: 'GET', 
    })
    .then(response => {
        if (!response.ok) {
            console.log(response.body)
            throw new Error('Network response was not ok');
        }
        return response.json(); 
    })
    .then(data => {
        if(caller == 'input') {
            searchBarLoader.style.display = 'none';
        }else {
            menuCatagoryLoader.style.display = 'none';
        }
        if(data.length == 0 && caller == 'input') {
            searchPageContentCon.innerText = 'Not match !'
        }else {
            data.forEach(item => {
                // creating a new div elenment with it content elenment
                let newDiv = document.createElement('div');
                newDiv.className = 'search-page-content';
                let newImg = document.createElement('img');
                newImg.src = "http://127.0.0.1:8000/" + item.Product_image;           // set the loaded product image
                let newSpan = document.createElement('span');
                newSpan.innerText = item.Product_name;     // set the loaded product name
                let newP = document.createElement('p');
                newP.innerText = item.Product_details;     // set the loaded product details
                // creating a new div elenment with it content elenment

                // creating a list of new div content element to avoiding from code copying
                let newDivContent = [newImg, newSpan, newP]
                // creating a list of new div content element to avoiding from code copying

                newDiv.addEventListener('click', ()=>{
                    setTheUrl(id = item.Product_id)
                })
                // puttin each element in new div element
                newDivContent.forEach(item =>{
                    newDiv.appendChild(item);
                })
                // puttin each element in new div element
                

                // checking if the caller was the input bar so child will append into search page else menu bar
                if(caller == 'input') {
                    searchPageContentCon.appendChild(newDiv)
                }else {
                    menuCatagoryContent.appendChild(newDiv);
                }
            })
        }
        
    })
    .catch((error) => {
        alert(`Sorry there was somthing wrong with sending requist to server with content : ${error}`)
    });
}

// SEARCH PAGE APPEAR OR DISAPPEAR FUNCTION 
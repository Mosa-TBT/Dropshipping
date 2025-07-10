
// Main image changer

let mainImage = document.getElementById('main-image');

function changeImage(largeSrc) {
    mainImage.src = largeSrc;
}

// Main image changer

function sentIdToServer(id) {

    let AddBtn = document.querySelector('.add-btn');
    let AddBtnInnerText = document.querySelector('.add-btn > span');
    let AddBtnLoader = document.querySelector('.add-btn > img');

    AddBtnInnerText.style.display = 'none';
    AddBtnLoader.style.display = 'inline-block';

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const data = {
        productId: id,
        quantity: 1,
    };
    
    fetch(`http://127.0.0.1:8000/product/${data.productId}`, {
        method: 'POST', 
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN' : csrfToken,
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        console.log(response)
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); 
    })
    .then(data => {
        if(data.is_added == true) {
            AddBtnLoader.style.display = 'none';
            AddBtnInnerText.style.display = 'inline';
            AddBtnInnerText.innerText = 'Added to cart';
            AddBtn.disabled = true;
            setTimeout(()=>{
                AddBtnInnerText.innerHTML = 'Add to cart';
                AddBtn.disabled = false;
            }, 5000);
        } else {
            alert('Oops Somthing went wronge !');
            AddBtnLoader.style.display = 'none';
            AddBtnInnerText.style.display = 'inline';
        }
    })
    .catch((error) => {
        alert(`Sorry an error with { ${error} } content occored when attempting to connect to server`);
        AddBtnLoader.style.display = 'none';
        AddBtnInnerText.style.display = 'inline';
    });
}


function setTheUrl(id) {
        window.location.assign(`http://127.0.0.1:8000/product/${id}`);
}
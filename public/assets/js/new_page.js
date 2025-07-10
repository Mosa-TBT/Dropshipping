function sentIdToServer(id, callerBtn) {

    let addBtn = callerBtn;
    let addBtnChilds = [...callerBtn.children];

    let addBtnInnerText;
    let addBtnLoader;

    addBtnChilds.forEach(child => {
        if(child.nodeName == 'SPAN') {
            addBtnInnerText = child;
        }else if(child.nodeName == 'IMG') {
            addBtnLoader = child
        }
    })

    addBtnInnerText.style.display = 'none';
    addBtnLoader.style.display = 'inline-block';

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
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); 
    })
    .then(data => {
        if(data.is_added == true) {
            addBtnLoader.style.display = 'none';
            addBtnInnerText.style.display = 'inline';
            addBtnInnerText.innerText = 'Added to cart';
            addBtn.style.backgroundColor = 'green';
            addBtn.disabled = true;
            setTimeout(()=>{
                addBtnInnerText.innerHTML = 'Add to cart';
                addBtn.style.backgroundColor = '#6A3093';
                addBtn.disabled = false;
            }, 5000);
        } else {
            alert('Oops Somthing went wronge !');
            addBtnLoader.style.display = 'none';
            addBtnInnerText.style.display = 'inline';
        }
    })
    .catch((error) => {
        alert(`Sorry an error with { ${error} } content occored when attempting to connect to server`);
        addBtnLoader.style.display = 'none';
        addBtnInnerText.style.display = 'inline';
    });
}
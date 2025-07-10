

class NewElement {

    constructor(tag, innerText, styles, classes) {

        this.tag = tag;
        this.innerText  = innerText || '';
        this.styles = styles || {};
        this.classes = classes || [];
        this.createElement();

    }

    createElement() 
    {

        let newElement = document.createElement(this.tag);

        newElement.innerText = this.innerText;

        for(const key in this.styles) {

            try {

                newElement.style.setProperty(key, this.styles[key]); 

            } catch (error) {

                alert(error);

            }

        }

        for(const key in this.classes) {

            try {

                newElement.classList.add(this.classes[key]); 

            } catch (error) {

                alert(error);

            }

        }

        return newElement;

    }

}



class MessageBox extends NewElement{

    messageBox;

    constructor(text, bg, color, btnBg, btnColor, btnText) {
        super('div')
        this.text = text || '';
        this.bg = bg || 'transparent';
        this.color = color || 'transparent';
        this.btnColor = btnColor || 'black';
        this.btnBg = btnBg || '#fff';
        this.btnText = btnText || 'OK';
        this.messageBox = null;
        this.createMessageBox()
    }


    createMessageBox() {

        this.messageBox = new NewElement('div', '',  {
            'z-index' : 1000,
            'display': 'flex',
            'align-items': 'center',
            'justify-content': 'space-around',
            'text-align': 'center',
            'position': 'fixed',
            'left': '50%',
            'transform': 'translateX(-50%)',
            'top': '-70px',
            'width': '300px',
            'height': '50px',
            'background-color': this.bg,
            'color': this.color,
            'border-radius': '20px',
            'padding': '10px',
            'transition': 'all 0.5s ease-in-out',
        }, ['message-box']).createElement()
        
        let messageText = new NewElement('p', this.text).createElement();
        
        let messageBoxBtn = new NewElement('button', this.btnText , {
            'padding': '5px',
            'background-color': this.btnBg,
            'border': '1px solid black',
            'border-radius':'5px',
            'color': this.btnColor,
        }).createElement();

        this.messageBox.appendChild(messageText);
        this.messageBox.appendChild(messageBoxBtn);
        messageBoxBtn.addEventListener('click', ()=>{this.appearOrDisappearMessage(this.messageBox)});
    }

    createConfirmationBox() {

        this.messageBox = new NewElement('div', '',  {
            'z-index' : 1000,
            'display': 'flex',
            'align-items': 'center',
            'justify-content': 'space-around',
            'text-align': 'center',
            'position': 'fixed',
            'left': '50%',
            'transform': 'translateX(-50%)',
            'top': '-70px',
            'width': '300px',
            'height': '50px',
            'background-color': this.bg,
            'color': this.color,
            'border-radius': '20px',
            'padding': '10px',
            'transition': 'all 0.5s ease-in-out',
        }, ['message-box']).createElement()
        
        let messageText = new NewElement('p', this.text).createElement();
        
        let messageBoxOkBtn = new NewElement('button', this.btnText , {
            'padding': '5px',
            'background-color': this.btnBg,
            'border': '1px solid black',
            'border-radius':'5px',
            'color': this.btnColor,
        }).createElement();

        let messageBoxCancelBtn = new NewElement('button', 'Cancel' , {
            'padding': '5px',
            'background-color': this.btnBg,
            'border': '1px solid black',
            'border-radius':'5px',
            'color': this.btnColor,
        }).createElement();

        this.messageBox.appendChild(messageText);
        this.messageBox.appendChild(messageBoxOkBtn);
        this.messageBox.appendChild(messageBoxCancelBtn);

        messageBoxOkBtn.addEventListener('click', ()=>{this.appearOrDisappearMessage(this.messageBox); return true});
        messageBoxCancelBtn.addEventListener('click', ()=>{this.appearOrDisappearMessage(this.messageBox); return false});

    }

    appearOrDisappearMessage(messageBox = this.messageBox) {

        if(messageBox.getBoundingClientRect().top != 10) {
    
            document.querySelector('body').appendChild(messageBox)
    
            setTimeout(()=>{
    
                messageBox.style.top = '10px';
    
            }, 500)
    
            // set a timeout to disappear the message box atomaticlly after 5 seconds 
            setTimeout(()=>{
    
                if (document.querySelector('.message-box') != null) {
    
                    this.appearOrDisappearMessage();
    
                }
    
            }, 5000)
    
        }else {
    
            messageBox.style.top = '-70px';
    
            setTimeout(()=>{
    
                document.querySelector('body').removeChild(messageBox);
    
            }, 500)
    
        }
    
    }
    

}

// ISSUES IF EXIST WILL BE WRITE HERE 

// 1 Code should clearly orgnized  ->   index.js

// 2 NewElement and MessageBox classes should place in a separate file  ->   index.js

// 3 Constans should place in a specific file  ->   index.js

// 4 Constans should place in a specific file  ->   index.js

// 5 Slider should change to new slider from some website   ->  common.js

// 6 All css files from each view should be changed to bootstrup 3

// 7 There is too much fechs in each file it should too get some changes

// ISSUES IF EXIST WILL BE WRITE HERE


const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Navbar shoping icon

let shoppingIcon = document.querySelector('.shoping_icon');

shoppingIcon.addEventListener('click', (e)=>{

    e.preventDefault();
    location = 'shopping_cart';

});

// Navbar shoping icon

// Menu bar ;   // Note : Should not be moved to main_layout.js file

let lastScrollTop = 0;
let menuBar = document.querySelector('.menu-bar');

window.addEventListener('scroll', ()=>{

    let scrollTop = window.pageYOffset ||
    document.documentElement.scrollTop;

    if(scrollTop > lastScrollTop) {

        menuBar.style.marginTop = '80px'

    }else {

        menuBar.style.marginTop = '120px'

    }

    lastScrollTop = scrollTop;
})

// Menu bar 

// setUrl function 

function setTheUrl(id) {

    window.location.assign(`http://127.0.0.1:8000/product/${id}`);

}

function setThisUrl(name, id) {

    window.location.assign(`http://127.0.0.1:8000/catagories/${name}/?id=${id}`);

}



// setUrl function 

function sentIdToServer(id) {

    let AddBtn = document.querySelector('.add-btn');
    let AddBtnInnerText = document.querySelector('.add-btn > span');
    let AddBtnLoader = document.querySelector('.add-btn > img');

    AddBtnInnerText.style.display = 'none';
    AddBtnLoader.style.display = 'inline-block';

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

            AddBtnLoader.style.display = 'none';
            AddBtnInnerText.style.display = 'inline';
            AddBtnInnerText.innerText = 'Added to cart';
            AddBtn.style.backgroundColor = 'green';
            AddBtn.disabled = true;

            setTimeout(()=>{

                AddBtnInnerText.innerHTML = 'Add to cart';
                AddBtn.style.backgroundColor = '#A044FF';
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


// Stories page opener and closer function

let storiesPage = document.querySelector('.story-page');
let storiesPageContent = document.querySelector('.story-page-content');
let storiesPageProductImg = document.querySelector(".story-page > .story-page-content > .product-img");
let overlay = document.querySelector('.overlay');
let addToCartBtn = document.querySelector('.add-to-cart');


function openOrCloseStoryProductPage(id=null, image=null, openMode=false) {

    if(openMode == true && id != null && image != null ) {

        storiesPage.style.display = 'block';

        setTimeout(()=>{
            storiesPage.style.height = '500px';
        },500);

        overlay.style.display = 'block';

        setTimeout(()=>{
            storiesPageContent.style.display = 'block';
        }, 1000)

        storiesPageProductImg.src = image;

        addToCartBtn.productId = id;


        
    }else if(openMode == false && id == null && image == null ) {

        storiesPageContent.style.display = 'none';

        storiesPage.style.height = '0px';

        setTimeout(()=>{

            storiesPage.style.display = 'none';

        },500);

        storiesPageProductImg.src = image;

        addToCartBtn.productId = id;

        // This time out is nacassery cuse if we close the overlay without a timeout there will occour some conflict between openning and closing the open story and the story that we want to open imediatlly !!!
        setTimeout(() => {

            overlay.style.display = 'none';

        }, 600);

    }else {

        // if openMode were true but cuse some probluem id or image remain as null
        
    }

}


// Stories page opener and closer function


function viewALLBtnFunc(productCatagory) {

    window.location.assign(`http://127.0.0.1:8000/new-page/${productCatagory}`);

}


// Varify user email

let subscribeBtnTxt = document.querySelector('.subscribe-btn > span');
let subscribeBtnLoader = document.querySelector('.subscribe-btn > img');


function varifyEmail(isLoggedIn) {

    let subscribeBtnTxt = document.querySelector('.subscribe-btn > span');
    let subscribeBtnLoader = document.querySelector('.subscribe-btn > img');

    subscribeBtnTxt.style.display = 'none';
    subscribeBtnLoader.style.display = 'inline-block';

    if(isLoggedIn) {

        showMessageBox(message = 'You should first sign in !!!');

    }else {

        let email = document.querySelector('.email_for_sub').value;

        const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        let result = regex.test(email);

        if(result) {

            let data = {'email' : email};

            fetch(`http://127.0.0.1:8000/send_email`, {

                method: 'POST', 
                headers: {

                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN' : csrfToken,

                },
                body: JSON.stringify(data)

            })
            .then(response => {

                if (!response.ok) {

                    throw new Error('Network response was not ok ');

                }
                return response.json(); 

            })
            .then(data => {

                if(data.email_sent == true) {

                    showMessageBox(message = 'We just sent an varification code to your email  ');

                    let varifyPage = document.querySelector('.varify_page');
                    varifyPage.style.display = 'block';

                    varificationCodeTimer();

                    function waitForVariying() {

                        return new Promise((resolve) => {

                            const button = document.querySelector('.varify_email_btn');

                            button.addEventListener('click', () => {

                                const inputValue = document.querySelector('.inserted_code').value;
                                resolve(inputValue);

                            });

                        });
                    }
            
                    async function main(time) {

                        const inputValue = await waitForVariying();

                        console.log(time);

                        let data = {'email' : email, 'inserted_code' : inputValue, 'email_was_sent_at' : time}

                        fetch(`http://127.0.0.1:8000/varify_email`, {

                            method: 'POST', 
                            headers: {

                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN' : csrfToken,

                            },
                            body: JSON.stringify(data)

                        })
                        .then(response => {

                            if (!response.ok) {

                                throw new Error('Network response was not ok ');

                            }
                            return response.json(); 

                        })
                        .then(data => {

                            let varifyPage = document.querySelector('.varify_page');

                            if(data.varifyied == true) {

                                varifyPage.style.display = 'none';

                                saveSubscriber(email);

                            }else {

                                varifyPage.style.display = 'none';   // temprory cuse it should not change to none in this case insteat it should remain but still user should be able to close the page using a close button
                                showMessageBox(message = `Email not varifyed`);

                            }

                        })
                        .catch((error) => {

                            varifyPage.style.display = 'none';
            
                            showMessageBox(message = `Sorry an error with this message occured : ${error}`);
            
                        });
                                    
                    }
            
                    main(time = data.time);

                }else {

                    showMessageBox(message = 'Somthing went wrong :( ');

                }
            })
            .catch((error) => {

                showMessageBox(message = `Sorry an error with this message occured : ${error}`);

            });
        }else {

            showMessageBox(message = 'Email is not valid !!!');

        }

    }

    subscribeBtnTxt.style.display = 'inline';
    subscribeBtnLoader.style.display = 'none';

}



// Varify user email


// save subscriber

function saveSubscriber(email) {

    let data = {'email': email}

    fetch(`http://127.0.0.1:8000/save_new_subscriber`, {

        method: 'POST', 
        headers: {

            'Content-Type': 'application/json',
            'X-CSRF-TOKEN' : csrfToken,

        },
        body: JSON.stringify(data)

    })
    .then(response => {

        if (!response.ok) {

            throw new Error('Network response was not ok ');

        }
        return response.json(); 

    })
    .then(data => {

        if(data.is_added == true) {

            showMessageBox(message = 'Thanks your email saved for new offers :)  ');

        }else {

            showMessageBox(message = 'You are already a subscriber :)  ');

        }
    })
    .catch((error) => {

        showMessageBox(message = `Sorry an error with this message occured : ${error}`);

    });

}


// save subscriber


// Varification page timer

function varificationCodeTimer() {

    let timeLeft = 30;
    const timerElement = document.getElementById('timer');
    
    const timer = setInterval(() => {

        timeLeft--;
        timerElement.textContent = `Remaining time : ${timeLeft}`;
    
        if (timeLeft <= 0) {

            clearInterval(timer);
            timerElement.textContent = 'Timer has done !';
            document.querySelector('button').disabled = true;

        }

    }, 1000);

}

// Varification page timer


// show message box     // Its nacassery for clirity of code !!! 

function showMessageBox(message) {


    let messageBox = new MessageBox
    (
        text = message,
        bg ='#A044FF',
        color ='#fff',
        btnBg = '#6A3093',
        btnColor = '#fff',
        btnText = 'OK'
    );

    messageBox.appearOrDisappearMessage();

}

// show message box     // Its nacassery for clirity of code !!! 


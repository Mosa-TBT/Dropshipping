

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

  constructor(text, bg, color, btnBg, btnColor, btnText, btnType) {
      super('div')
      this.text = text || '';
      this.bg = bg || 'transparent';
      this.color = color || 'transparent';
      this.btnColor = btnColor || 'black';
      this.btnBg = btnBg || '#fff';
      this.btnText = btnText || 'OK';
      this.btnType = btnType || 'messageBox'
      this.messageBox = null;
      if(btnType == "confirmationBox" || btnType == "confirmationbox") {
        this.createConfirmationBox();
      }else {
        this.createMessageBox();
      }
      
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
      }, ['confirmation-box']).createElement()
      
      let messageText = new NewElement('p', this.text).createElement();
      
      this.messageBoxOkBtn = new NewElement('button', this.btnText , {
          'padding': '5px',
          'background-color': this.btnBg,
          'border': '1px solid black',
          'border-radius':'5px',
          'color': this.btnColor,
          'margin-right' : '2px'
      }).createElement();

      this.messageBoxCancelBtn = new NewElement('button', 'Cancel' , {
          'padding': '5px',
          'background-color': this.btnBg,
          'border': '1px solid black',
          'border-radius':'5px',
          'color': this.btnColor,
      }).createElement();

      this.messageBox.appendChild(messageText);
      this.messageBox.appendChild(this.messageBoxOkBtn);
      this.messageBox.appendChild(this.messageBoxCancelBtn);

  }

  appearOrDisappearMessage(messageBox = this.messageBox) {

      if(messageBox.getBoundingClientRect().top != 10) {
  
          document.querySelector('body').appendChild(messageBox)
  
          setTimeout(()=>{
  
              messageBox.style.top = '10px';
  
          }, 500)
  
          // set a timeout to disappear the box if its type was message box atomaticlly after 5 seconds 
          if(this.btnType == 'messageBox') {

            setTimeout(()=>{
  
                if (document.querySelector('.message-box') != null) {
    
                    this.appearOrDisappearMessage();
    
                }
    
            }, 5000)

          // the function should return a promise if the btn type was confirmation box so the programm can hold for a while so user can choice to tab any btn's !!!
          }else {

            return new Promise((resolve) => {

              this.messageBoxOkBtn.addEventListener('click', ()=>{

                resolve(true);
                this.appearOrDisappearMessage();

              });

              this.messageBoxCancelBtn.addEventListener('click', ()=>{

                resolve(false);
                this.appearOrDisappearMessage();

              });

              // If user not response the confirmation box should assume that the response is false and it will disappear its self after 15 secends !!!
              setTimeout(()=>{

                resolve(false);
                this.appearOrDisappearMessage();

              }, 15000);

            });

          }
  
      }else {
  
          messageBox.style.top = '-70px';
  
          setTimeout(()=>{
  
              document.querySelector('body').removeChild(messageBox);
  
          }, 500)
  
      }
      
  }
  
}


// Hundle delete btn performance

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function hundleDeleteBtnPer(event, id) {

  event.preventDefault();  

  const data = {

      productId: id,

  };
  
  fetch(`http://127.0.0.1:8000/shopping_cart/delete_from_cart/${data.productId}`, {

      method: 'DELETE', 

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

    location.reload()

  })
  .catch((error) => {

    let messageBox = new MessageBox

    (
        text = `Sorry an error with this message occored : ${error} !`,
        bg ='#A044FF',
        color ='#fff',
        btnBg = '#6A3093',
        btnColor = '#fff',
        btnText = 'OK',
        btnType = 'confirmationBox'
    );

  messageBox.appearOrDisappearMessage();

  });
}

// Hundle delete btn performance


// DELETING ALL GOATS FROM SHOPPING CART

let commodity = document.querySelector('.commodity');

async function delAllFromShoppingCart() {

  // Checking if the shopping cart is empty !!!
  if(commodity.children.length == 0) {

    let messageBox = new MessageBox
    (

      text = `Shopping cart is empty :)`,
      bg ='#A044FF',
      color ='#fff',
      btnBg = '#6A3093',
      btnColor = '#fff',
      btnText = 'OK',

    );

    messageBox.appearOrDisappearMessage();

    return;

  }


  let confirm = new MessageBox

    (
        text = 'Are you sure you wanna to empty all the shopping cart ?',
        bg ='#A044FF',
        color ='#fff',
        btnBg = '#6A3093',
        btnColor = '#fff',
        btnText = 'OK',
        btnType = 'confirmationBox'
    );

  let res = await confirm.appearOrDisappearMessage();

  if(res == true) {

    fetch('http://127.0.0.1:8000/shopping_cart/delete_all', {

      method: 'DELETE',

      headers: {

        'Content-Type': 'application/json',
        'X-CSRF-TOKEN' : csrfToken,

      },

    })
    .then(response => {

      if(!response.ok) {

        throw new Error('Network response was not ok !');
      }

      return response.json();

    })
    .then(data =>{

      location.reload();

    })
    .catch(error =>{

      let messageBox = new MessageBox
      (

        text = `Somthing went wrong => error message : ${error}`,
        bg ='#A044FF',
        color ='#fff',
        btnBg = '#6A3093',
        btnColor = '#fff',
        btnText = 'OK',

      );

      messageBox.appearOrDisappearMessage();

    })

  }else {

    return 

  }
}

// DELETING ALL GOATS FROM SHOPPING CART

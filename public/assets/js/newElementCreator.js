
// This function will create a new element    NOTE: there is a bug in this function which when we do not put a value to innerText when we create an element with it it will not put styles into element :)


export function createElement
(
    tag,
    innerText = '', 
    styles = {},
    classes = [],
) 
{

    let newElement = document.createElement(tag);

    newElement.innerText = innerText;

    for(const key in styles) {

        try {

            newElement.style.setProperty(key, styles[key]); 

        } catch (error) {

            console.log(error);

        }

    }

    for(const key in classes) {

        try {

            newElement.classList.add(key); 

        } catch (error) {

            console.log(error);

        }

    }

    return newElement;

}
// This fill contains common functions between catagory page and main page


// Slider

let slides = [...document.querySelectorAll('.slide')];
let backBtn = document.querySelector('.back');
let nextBtn = document.querySelector('.next');

let counter = 1;

function doSlider(backBtn = false){

    let currentSlide = document.querySelector('.current-slide');

    if(backBtn == false) {
        currentSlide.classList.remove('current-slide');
        currentSlide.classList.add('previos-slide');
        if(document.querySelector('.last-slide') == null) {
            currentSlide.classList.add('last-slide');
        } else {
            let lastSlide = document.querySelector('.last-slide');
            lastSlide.classList.remove('last-slide');
            currentSlide.classList.add('last-slide');
        }
    } else {
        currentSlide.classList.remove('current-slide');
        currentSlide.classList.add('none');
    }

    setTimeout(()=>{
        if(backBtn == false) {
            currentSlide.classList.remove('previos-slide');
            currentSlide.classList.add('none');
            currentSlide.classList.add('display-none');
        } else {
            currentSlide.classList.add('display-none');
        }
        setTimeout(()=>{
            currentSlide.classList.remove('display-none');
        }, 1000)
    },500)

    if(backBtn == false) {
        slides[counter].classList.add('current-slide');
        slides[counter].classList.remove('none');
    }else {
        let lastSlide = document.querySelector('.last-slide');
        let indexOfLastSlide = slides.indexOf(lastSlide);
        lastSlide.classList.remove('last-slide');
        if(indexOfLastSlide != 0) {
            slides[indexOfLastSlide - 1].classList.add('last-slide');
        }else {
            slides[slides.length - 1].classList.add('last-slide');
        }
        lastSlide.classList.add('display-none');
        lastSlide.classList.add('previos-slide');
        lastSlide.classList.remove('none');
        setTimeout(()=>{
            lastSlide.classList.remove('display-none');
        }, 100)
        setTimeout(()=>{
            lastSlide.classList.add('current-slide');
            lastSlide.classList.remove('previos-slide');
        }, 100)
    }


    if(backBtn == false) {
        if(counter >= slides.length - 1){
            counter = 0;
        }else{
            counter ++;
        }
    }else {
        if(counter > 0) {
            counter --;
        }else if(counter == 0){
            counter = slides.length - 1;
        }
    }
}

setInterval(doSlider, 5000);

backBtn.addEventListener('click', ()=>{
    doSlider(backBtn = false)
})
nextBtn.addEventListener('click', ()=>{
    doSlider(backBtn = true);
})

// Slider 



// Amazing offers scrollers 


let mainContainer = document.querySelector('.offers');
let previosAmazBtn = document.querySelector('.perv-amaz-offer');
let nextAmazBtn = document.querySelector('.next-amaz-offer');


previosAmazBtn.addEventListener('click', ()=>{ doScrollForAmazOffers('to-left') });
nextAmazBtn.addEventListener('click', ()=>{ doScrollForAmazOffers('to-right') });


function doScrollForAmazOffers(state) {

    if(state == 'to-left') {

        if(mainContainer.scrollLeft >= 50) {

            mainContainer.scrollLeft -= 100;

        }

    }else {

        if(mainContainer.scrollLeft < mainContainer.scrollWidth) {

            mainContainer.scrollLeft += 100;

        }

    }


}


// Amazing offers scrollers 


// TIMER FUNCTIONALITY

const hour = document.querySelector('.hour');
const min = document.querySelector('.min');
const sec = document.querySelector('.sec');

const targetDate = new Date("2024-12-06T00:00:00").getTime();  // Y-M-D    NOTE: IF THE NUMBER CONSIST JUST SINGLE DIGIT IT SHOULD GOT CHANGE TO SOMTHING LIKE 01

const timerContainer = document.querySelector(".timer-container");

const interval = setInterval(() => {

    const now = new Date().getTime();

    const distance = targetDate - now;


    // CALCULATING THE REMAINING DAY, HOUR, MINUTE AND SECONDS TO TARGET TIME

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // CHECK IF TIMER ENDS SO IT SHOULD STOP THE INTERVAL AND LET THE USER TO KNOW IT BY SHOWING SOME MESSAGE !
    if (distance < 0) {
        clearInterval(interval);
        // SETTING THE TIMER CONTAINER TO WHITE FOR A BETTER VIEW FOR USER 
        timerContainer.style.color = '#fff';
        timerContainer.innerHTML = "Timer has done !!!";
    }else {
        // SHOWING THE REMAINING TIME IN THE WEB PAGE
        // day.innerHTML = days;    // DAYS IF WE WANNA TO SET IT IN WEB PAGE !
        hour.innerHTML = hours >= 10 ? hours : `0${hours}`;
        min.innerHTML = minutes >= 10 ? minutes : `0${minutes}`;
        sec.innerHTML = seconds >= 10 ? seconds : `0${seconds}`;
    }

}, 1000);

// TIMER FUNCTIONALITY



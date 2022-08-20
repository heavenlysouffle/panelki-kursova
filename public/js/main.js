// Burger handler
(function (){
    const burgerItem = document.querySelector('.burger');
    const menu = document.querySelector('.header-nav-bar');
    const menuCloseItem = document.querySelector('.header-nav-close');
    const menuLinks = document.querySelectorAll('.header-link');
    burgerItem.addEventListener('click', () => {
        menu.classList.add('header-nav-bar-active');
    });
    menuCloseItem.addEventListener('click', () => {
        menu.classList.remove('header-nav-bar-active');
    });
    if (window.innerWidth <= 850) {
        for (let i = 0; i < menuLinks.length; i += 1) {
            menuLinks[i].addEventListener('click', () => {
                menu.classList.remove('header-nav-bar-active');
            });
        }
    }
}());

// References to DOM Elements
const prevBtn = document.querySelector("#previous-button");
const nextBtn = document.querySelector("#next-button");
const book = document.querySelector("#book");

const paper1 = document.querySelector("#p1");
const paper2 = document.querySelector("#p2");
const paper3 = document.querySelector("#p3");
const paper4 = document.querySelector("#p4");


// Event Listener
prevBtn.addEventListener("click", goPrevPage);
nextBtn.addEventListener("click", goNextPage);

// Business Logic
let currentLocation = 1;
let numOfPapers = 4;
let maxLocation = numOfPapers - 1;

paper1.classList.add("flipped");
paper1.style.zIndex = "1";

function goNextPage() {
    if(currentLocation < maxLocation) {
        switch(currentLocation) {
            case 1:
                paper2.classList.add("flipped");
                paper2.style.zIndex = "5";
                break;
            case 2:
                paper3.classList.add("flipped");
                paper3.style.zIndex = "6";
                break;
            case 3:
                paper4.classList.add("flipped");
                paper4.style.zIndex = "7";
                break;
            default:
                throw new Error("unknown state");
        }
        currentLocation++;
    }
}

function goPrevPage() {
    if(currentLocation > 1) {
        switch(currentLocation) {
            case 1:
                paper1.classList.remove("flipped");
                paper1.style.zIndex = "7";
                break;
            case 2:
                paper2.classList.remove("flipped");
                paper2.style.zIndex = "6";
                break;
            case 3:
                paper3.classList.remove("flipped");
                paper3.style.zIndex = "5";
                break;
            default:
                throw new Error("unknown state");
        }
        currentLocation--;
    }
}

function myFunction() {
    let myDiv = document.getElementById('cart');
    if (myDiv.className === "cart") {
        myDiv.classList.remove("cart");
        myDiv.classList.add("cart-active");
    } else {
        myDiv.classList.remove("cart-active");
        myDiv.classList.add("cart");
    }

}

// Card cloning testing
const bankCard = document.querySelector(".bankCard");
let expandBtns = document.getElementsByClassName("bankExpandButton");

// TODO bankCard object
class BankCard{
    constructor(){
        this.card = bankCard.cloneNode(true);
    }
}



function createNewCard(money,accountNumber,expiration,ccCode){
    newCard = new BankCard();
    document.querySelector("#bankAccount").appendChild(newCard.card);
}

createNewCard();

Array.from(expandBtns).forEach(x => x.addEventListener("click",function(){
    this.style.color = "red";
    let options = this.nextElementSibling;
    options.classList.toggle("reduced");
}));

createNewCard();


console.log(expandBtns)

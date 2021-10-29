
// BankCard object
class BankCard{
    constructor(money,accountNumber,expiration,ccCode){
        this.money = money;
        this.accountNumber = accountNumber;
        this.expiration = expiration;
        this.ccCode = ccCode;
    }
    create(parentNode){
        const CARD = document.createElement("article");
        CARD.classList.add("bg-light", "col-10", "my-2", "p-2", "shadow", "bankCard" ,"d-flex" ,"flex-column")
        CARD.innerHTML = `  
        <div class=" bg-primary text-white shadow p-2 d-flex flex-column">
          <table class="d-block">
            <tr>
              <th>
                solde :
              </th>
            </tr>
            <tr>
              <td class="balanceTotal">
                ${this.money} €
              </td>
            </tr>
            <tr>
              <th>
                Numéro Carte :
              </th>
            </tr>
            <tr>
              <td class="cardNumber">
                ${this.accountNumber}
              </td>
            </tr>
            <tr>
              <th>
                Expiration :
              </th>
              <th>
                CCV
              </th>
            </tr>
            <tr>
              <td class="expiration">
                ${this.expiration}
              </td>
              <td class="cccode">
                ${this.ccCode}
              </td>
            </tr>
          </table>
        </div>`
        parentNode.appendChild(CARD);
    }
    expand(){

    }
}

// Testing
const CARDS = [];
for (let i = 0; i < 3; i++)
{
    let newCard = new BankCard(250,"145 230 540 FR 20","12/25","123");
    CARDS.push(newCard)
;}
CARDS.forEach(x => x.create(document.querySelector("main")));

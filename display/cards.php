<?php
class Card
{
    protected string $_name;
    protected string $_cardNum;
    protected string $_owner;
    protected string $_date_creation;
    protected int $_amount;
    protected bool $_isNotDetail;
    protected string $_lastOp;
    protected int $_id;

    public function __construct(bool $isNotDetail = false, int $id, string $name, string $cardNum, string $owner, int $amount, string $last_op, string $date_creation)
    {
        $this->_id = $id;
        $this->_name = $name;
        $this->_cardNum = $cardNum;
        $this->_owner = $owner;
        $this->_amount = $amount;
        $this->_isNotDetail = $isNotDetail;
        $this->_lastOp = $last_op;
        $this->_date_creation = $date_creation;
    }
    function show_card()
    {
        echo "<article id='card' class='p-3 rounded card_container d-flex flex-column";
        echo $this->_amount < 0 ? ' bg-danger text-white' : '';
        echo "'>";
        if (!$this->_isNotDetail) { ?>
            <button id='deleteBtn' class='btn btn-close align-self-end btn-danger' onclick="showAlert()" value=<?php echo $this->_amount; ?>> </button>
            <p id="alertMsg" class="text-danger d-none"> ATTENTION ! Supprimer un compte est une action définitive êtes vous sûr ?</p>
<?php
            echo "<a id='deleteLink' class='btn btn-danger btn-close align-self-end d-none' href='model/delete_account_prg.php?id=$this->_id'> </a>";
        }
        echo
        "<h2>$this->_name</h2>
            <p>$this->_amount €</p>
            <div> 
                <strong>$this->_owner</strong>
                <br>
                $this->_cardNum
                <br>
                <p><strong>Dernière opération : </strong>$this->_lastOp</p> 
            </div>";
        if ($this->_isNotDetail) {
            echo "<a class='btn btn-light' href='details.php?id=$this->_id'> Details </a>";
        } else {
            echo "<p><strong>Date création du compte : </strong>$this->_date_creation</p>";
        }
        echo "</article>";
    }
}
?>
<script>
    function showAlert() {

        let errMsg = document.createElement("p");
        errMsg.innerText = "Un compte ne peut être supprimé que si il ne possède pas de solde ou de découvert.";
        let btn = document.getElementById("deleteBtn");
        let link = document.getElementById("deleteLink");
        let msg = document.getElementById("alertMsg");

        if (btn.value != 0) {
            btn.setAttribute("disabled", "");
            document.getElementById("card").prepend(errMsg);
        } else {
            btn.classList.add("d-none");
            link.classList.remove("d-none");
            msg.classList.remove("d-none");
        }
    }
</script>
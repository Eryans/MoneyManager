<?php

// TODO : Rewrite in a way we don't need the isNotDetail bool anymore
class Card
{
    private string $_name;
    private string $_cardNum;
    private string $_owner;
    private string $_type;
    private string $_date_creation;
    private int $_amount;
    private bool $_isNotDetail;
    private string $_lastOp;
    private int $_id;


    public function __construct(?array $data = array())
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
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
            echo "<a id='deleteLink' class='btn btn-danger btn-close align-self-end d-none' href='delete_account_prg.php?id=$this->_id'> </a>";
        }
        echo
        "<span>
            <h2>$this->_name</h2>
            <h3>";
        if (!empty($this->_type)) {
            echo "Type : " . $this->_type;
        }
        echo "</h3>
        </span>
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

    /**
     * @return string
     */
    public function get_name(): string
    {
        return $this->_name;
    }

    /**
     * @param string $_name
     */
    public function set_name(string $_name): void
    {
        $this->_name = $_name;
    }

    /**
     * @return string
     */
    public function get_cardNum(): string
    {
        return $this->_cardNum;
    }

    /**
     * @param string $_cardNum
     */
    public function set_cardNum(string $_cardNum): void
    {
        $this->_cardNum = $_cardNum;
    }

    /**
     * @return string
     */
    public function get_owner(): string
    {
        return $this->_owner;
    }

    /**
     * @param string $_owner
     */
    public function set_owner(string $_owner): void
    {
        $this->_owner = $_owner;
    }

    /**
     * @return string
     */
    public function get_type(): string
    {
        return $this->_type;
    }

    /**
     * @param string $_type
     */
    public function set_type(string $_type): void
    {
        $this->_type = $_type;
    }

    /**
     * @return string
     */
    public function get_date_creation(): string
    {
        return $this->_date_creation;
    }

    /**
     * @param string $_date_creation
     */
    public function set_date_creation(string $_date_creation): void
    {
        $this->_date_creation = $_date_creation;
    }

    /**
     * @return int
     */
    public function get_amount(): int
    {
        return $this->_amount;
    }

    /**
     * @param int $_amount
     */
    public function set_amount(int $_amount): void
    {
        $this->_amount = $_amount;
    }

    /**
     * @return bool
     */
    public function get_isNotDetail(): bool
    {
        return $this->_isNotDetail;
    }

    /**
     * @param bool $_isNotDetail
     */
    public function set_isNotDetail(bool $_isNotDetail): void
    {
        $this->_isNotDetail = $_isNotDetail;
    }

    /**
     * @return string
     */
    public function get_lastOp(): string
    {
        return $this->_lastOp;
    }

    /**
     * @param string $_lastOp
     */
    public function set_lastOp(string $_lastOp): void
    {
        $this->_lastOp = $_lastOp;
    }

    /**
     * @return int
     */
    public function get_id(): int
    {
        return $this->_id;
    }

    /**
     * @param int $_id
     */
    public function set_id(int $_id): void
    {
        $this->_id = $_id;
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
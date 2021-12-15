<?php 
class Card{
    private string $name;
    private string $cardNum;
    private string $owner;
    private string $date_creation;
    private int $amount;
    private bool $isNotDetail;
    private string $lastOp;

    public function __construct(bool $isNotDetail=false ,string $name, string $cardNum, string $owner, int $amount,string $last_op,string $date_creation)
    {
        $this -> name = $name;
        $this -> cardNum = $cardNum;
        $this -> owner = $owner;
        $this -> amount = $amount;
        $this -> isNotDetail = $isNotDetail;
        $this -> lastOp = $last_op;
        $this -> date_creation = $date_creation;
    }
    function show_card(){
        echo 
        "<article class='p-3 rounded'>
            <h2>$this->name</h2>
            <p>$this->amount €</p>
            <div> <strong>$this->owner</strong> $this->cardNum </div>";
            if ($this->isNotDetail){
            echo "<a class='btn btn-light' href='details.php?name=$this->name&number=$this->cardNum&owner=$this->owner&amount=$this->amount&lastOp=$this->lastOp&date_creation=$this->date_creation'> Details </a>";
            } else {
                echo "<p><strong>Date création du compte : </strong>$this->date_creation</p>";
                echo "<p><strong>Dernière opération : </strong>$this->lastOp</p>";
            } 
        echo 
        "</article>";
    }
}
?>
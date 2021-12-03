<?php 
class Card{
    private string $name;
    private string $cardNum;
    private string $owner;
    private int $amount;
    private bool $isNotDetail;
    private string $lastOp;

    public function __construct(bool $isNotDetail=false ,string $name, string $cardNum, string $owner, int $amount,string $last_op)
    {
        $this -> name = $name;
        $this -> cardNum = $cardNum;
        $this -> owner = $owner;
        $this -> amount = $amount;
        $this -> isNotDetail = $isNotDetail;
        $this -> lastOp = $last_op;
    }
    function show_card(){
        echo 
        "<article>
            <h2>$this->name</h2>
            <p>$this->amount €</p>
            <div> $this->owner $this->cardNum </div>";
            if ($this->isNotDetail){
            echo "<a class='btn btn-light' href='details.php?name=$this->name&number=$this->cardNum&owner=$this->owner&amount=$this->amount&lastOp=$this->lastOp'> Details </a>";
            } else {
                echo "<p><strong>Dernière opération : </strong>$this->lastOp</p>";
            } 
        echo 
        "</article>";
    }
}
?>
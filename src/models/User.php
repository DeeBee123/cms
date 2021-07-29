<?php 
namespace Models;
use Doctrine\ORM\Mapping as ORM;
/**
  * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User {
     /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /**
     * @ORM\Column(type="string")
     */
    private $level;


    public function getId(){
        return $this->id;
    }
    public function getLevel()
    {
        return $this->level;
    }


    public function setLevel($level)
    {
        $this->level = $level;
    }

 


}

?>
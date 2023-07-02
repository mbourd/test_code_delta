<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as MyAssert;

/**
 * Entity User
 *
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    // /**
    //  * @ORM\Id()
    //  * @ORM\GeneratedValue()
    //  * @ORM\Column(type="integer")
    //  */
    // private $id;

    // /**
    //  * @ORM\Column(type="string", length=50)
    //  * @Assert\Length(
    //  *      min = 2,
    //  *      max = 50,
    //  *      minMessage = "The user name must contain at least {{ limit }} characters",
    //  *      maxMessage = "The user name must not exceed {{ limit }} characters",
    //  *      allowEmptyString = false
    //  * )
    //  * @MyAssert\UserNameStartWithUppercase
    //  */
    // OR using config/validator/user.yaml only
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 120,
     *      minMessage = "validator.user.age.minMessage",
     *      maxMessage = "validator.user.age.maxMessage",
     *      notInRangeMessage = "validator.user.age.notInRangeMessage"
     * )
     */
    private $age;

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    /**
     * Getter name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Setter name
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Getter age
     */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * Setter age
     */
    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }
}

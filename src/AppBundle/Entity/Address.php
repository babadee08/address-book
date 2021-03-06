<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="address")
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Length(
     *     min=2,
     *     max=50,
     *     minMessage="Your first name must be at least {{ limit }} characters",
     *     maxMessage="Your first name cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
     * @Assert\Length(
     *     min=2,
     *     max=50,
     *     minMessage="Your Last name must be at least {{ limit }} characters",
     *     maxMessage="Your Last name cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="string")
     */
    private $lastName;

    /**
     * @Assert\Length(
     *     min=2,
     *     max=255,
     *     minMessage="Your Street address must be at least {{ limit }} characters",
     *     maxMessage="Your Street address cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="string")
     */
    private $street;

    /**
     * @Assert\Length(
     *     min=2,
     *     max=10,
     *     minMessage="Your Zip code must be at least {{ limit }} characters",
     *     maxMessage="Your Zip code cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="string")
     */
    private $zip;

    /**
     * @Assert\Length(
     *     min=2,
     *     max=255,
     *     minMessage="Your City name must be at least {{ limit }} characters",
     *     maxMessage="Your City name cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="string")
     */
    private $city;

    /**
     * @Assert\Country()
     * @ORM\Column(type="string")
     */
    private $country;

    /**
     * @Assert\Length(
     *     min=6,
     *     max=15,
     *     minMessage="Your Phone number must be at least {{ limit }} digits",
     *     maxMessage="Your Phone number cannot be longer than {{ limit }} digits"
     * )
     * @ORM\Column(type="string")
     */
    private $phoneNumber;

    /**
     * @Assert\Date()
     * @ORM\Column(type="date")
     */
    private $birthday;

    /**
     * @Assert\Email()
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @Assert\Image()
     * @ORM\Column(type="string", nullable=true)
     */
    private $photo;

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param mixed $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @Assert\Date()
     * @return mixed
     */
    public function getBirthday()
    {
        if (!is_null($this->birthday)) {
            return $this->birthday;
        }
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


}
<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string")
     */
    private $street;

    /**
     * @ORM\Column(type="string")
     */
    private $zip;

    /**
     * @ORM\Column(type="string")
     */
    private $city;

    /**
     * @ORM\Column(type="string")
     */
    private $country;

    /**
     * @ORM\Column(type="string")
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="date")
     */
    private $birthday;

    /**
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     */
    private $photo;
}
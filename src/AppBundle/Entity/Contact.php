<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\NotBlank
     *
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=40)
     */
    private $firstName;

    /**
     * @Assert\NotBlank()
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=40)
     */
    private $lastName;

    /**
     * @Assert\NotBlank()
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=100)
     */
    private $street;

    /**
     * @Assert\NotBlank()
     * @var int
     *
     * @ORM\Column(name="streetNumber", type="integer")
     */
    private $streetNumber;

    /**
     * @Assert\NotBlank()
     * @var int
     *
     * @ORM\Column(name="zip", type="integer")
     */
    private $zip;

    /**
     * @Assert\NotBlank()
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @Assert\NotBlank()
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=50)
     */
    private $country;

    /**
     * @Assert\NotBlank()
     * @var string
     *
     * @ORM\Column(name="phoneNumber", type="string", length=40)
     */
    private $phoneNumber;

    /**
     * @Assert\NotBlank
     * @Assert\Type(type="\DateTime")
     *
     * @var \DateTime
     *
     * @ORM\Column(name="birthDay", type="datetime")
     */
    private $birthDay;

    /**
     * @Assert\Email()
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255, nullable=true)
     */
    private $picture;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Contact
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Contact
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return Contact
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set streetNumber
     *
     * @param integer $streetNumber
     *
     * @return Contact
     */
    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    /**
     * Get number
     *
     * @return int
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * Set zip
     *
     * @param integer $zip
     *
     * @return Contact
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return int
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Contact
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Contact
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return Contact
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set birthDay
     *
     * @param \DateTime $birthDay
     *
     * @return Contact
     */
    public function setBirthDay($birthDay)
    {
        $this->birthDay = $birthDay;

        return $this;
    }

    /**
     * Get birthDay
     *
     * @return \DateTime
     */
    public function getBirthDay()
    {
        return $this->birthDay;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return Contact
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }
}


<?php


namespace app\DTO;

class UserDTO
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $first_name;
    /**
     * @var string
     */
    private $last_name;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;

    /**
     * @var boolean
     */

    private $is_admin;
    /**
     * @var boolean
     */
    private $is_active;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     * @throws \Exception
     */
    public function setFirstName(string $first_name): void
    {
        if (strlen($first_name) < 2 || strlen($first_name) > 50) {
            throw  new \Exception('First Name must be from 2 to 50 symbols length');
        }
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     * @throws \Exception
     */
    public function setLastName(string $last_name): void
    {
        if (strlen($last_name) < 2 || strlen($last_name) > 50) {
            throw new \Exception('Last Name must be from 2 to 50 symbols length');
        }
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @throws \Exception
     */
    public function setEmail(string $email): void
    {
        $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";

        if (!preg_match($pattern, $email)) {
            throw new \Exception('Invalid Email address');
        }
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @throws \Exception
     */
    public function setPassword(string $password): void
    {
        if (strlen($password) < 4) {
            throw new \Exception('Password must be at least 4 symbols');
        }
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @return bool
     */
    public function isIsAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * @param bool $is_admin
     */
    public function setIsAdmin(bool $is_admin): void
    {
        $this->is_admin = $is_admin;
    }

    /**
     * @return bool
     */
    public function isIsActive(): bool
    {
        return $this->is_active;
    }

    /**
     * @param bool $is_active
     */
    public function setIsActive(bool $is_active): void
    {
        $this->is_active = $is_active;
    }
}
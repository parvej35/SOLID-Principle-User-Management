<?php

// This class is responsible for representing user data. (Single Responsibility Principle)
// It has a unique identifier, name, and email properties.

class User {
    private string $id;
    private string $name;
    private string $email;
    private DateTime $createdAt;
    private ?DateTime $updatedAt = null;

    public function __construct(string $name, string $email) {
        try {
            $this->id = uniqid();
            $this->name = $name;
            $this->email = $email;
//            $this->createdAt = new DateTime();
//            $this->updatedAt = new DateTime();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getId(): string {
        try {
            return $this->id;
        } catch (Exception $e) {
            return '';
        }
    }

    public function getName(): string {
        try{
            return $this->name;
        } catch (Exception $e) {
            return '';
        }
    }

    public function setName(string $name): void {
        try {
            $this->name = $name;
        } catch (Exception $e) {
            $this->name = '';
        }
    }

    public function getEmail(): string {
        try {
            return $this->email;
        } catch (Exception $e) {
            return '';
        }
    }

    public function setEmail(string $email): void {
        try {
            $this->email = $email;
        } catch (Exception $e) {
            $this->email = '';
        }
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime {
        try {
            return $this->createdAt;
        } catch (Exception $e) {
            return new DateTime();
        }
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): void {
        try {
            $this->createdAt = $createdAt;
        } catch (Exception $e) {
            $this->createdAt = new DateTime();
        }
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): ?DateTime {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt(DateTime $updatedAt): void {
        try {
            $this->updatedAt = $updatedAt;
        } catch (Exception $e) {
            $this->updatedAt = null;
        }
    }
}

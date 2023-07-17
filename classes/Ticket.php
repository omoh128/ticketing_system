<?php

class Ticket {
    private $id;
    private $subject;
    private $description;
    private $status;
    private $user;

    public function __construct($id, $subject, $description, $user) {
        $this->id = $id;
        $this->subject = $subject;
        $this->description = $description;
        $this->status = 'Open'; // Default status is Open
        $this->user = $user;
    }

    public function getId() {
        return $this->id;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getUser() {
        return $this->user;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}

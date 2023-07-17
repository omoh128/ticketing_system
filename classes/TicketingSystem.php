<?php

class TicketingSystem {
    private $tickets = [];

    public function createTicket($id, $subject, $description, $user) {
        $ticket = new Ticket($id, $subject, $description, $user);
        $this->tickets[] = $ticket;
        return $ticket;
    }

    public function getTickets() {
        return $this->tickets;
    }

    public function findTicketById($id) {
        foreach ($this->tickets as $ticket) {
            if ($ticket->getId() === $id) {
                return $ticket;
            }
        }
        return null;
    }

    public function getOpenTickets() {
        $openTickets = [];
        foreach ($this->tickets as $ticket) {
            if ($ticket->getStatus() === 'Open') {
                $openTickets[] = $ticket;
            }
        }
        return $openTickets;
    }
}




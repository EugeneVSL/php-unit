<?php

class Mailer {

    public function sendMessage($email, $message)
    {

        sleep(3);
        echo "Send $message to $email";

        return true;
    }

}
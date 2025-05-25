<?php

namespace AuthPower\Helpers;

class Mailer
{
    public static function send($to, $subject, $message)
    {
        $headers = "From: authpower@app.local\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        return mail($to, $subject, $message, $headers);
    }
}

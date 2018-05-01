<?php

class EReservationException extends LogicException {
    function __construct($roomNumber, Reservation $reservation)
    {
        $this->message = " <b style ='color:#ff0000'>Room </b>". "<b style ='color:#ff0000'>$roomNumber</b>"
            ."  <b style ='color:#ff0000'>is already occupied for period from </b>"
            . "<b style ='color:#ff0000'>{$reservation->getStartDate()->format("d-m-y")}</b>"
            . " <b style ='color:#ff0000'>to</b> "
            . "<b style ='color:#ff0000'>{$reservation->getEndDate()->format("d-m-y") }</b>". PHP_EOL
            ."<br>";
    }
}

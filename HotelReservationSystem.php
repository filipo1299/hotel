<?php
function __autoload($className)
{
    include_once("./" . $className . ".php");
}
$firstGuest = new Guest("Filip", "Maciejewski", 12548789);
$secondGuest = new Guest("Andrzej", "Boryna", 2165418);
$thirdGuest = new Guest("Emily", "Packman", 89466466);
$firstReservation = new Reservation("19-10-2018", "21-10-2018", $firstGuest);
$secondReservation = new Reservation("20-10-2018", "25-10-2018", $secondGuest);
$thirdReservation = new Reservation("18-10-2018", "26-10-2018", $thirdGuest);
$fourReservation = new Reservation("01-10-2018", "17-10-2018", $thirdGuest);
$rooms[201] = new SingleRoom(201, 40);
BookManager::bookRoom($rooms[201], $firstReservation);
BookManager::bookRoom($rooms[201], $fourReservation);
$rooms[305] = new SingleRoom(305, 60);
BookManager::bookRoom($rooms[305], $firstReservation);
BookManager::bookRoom($rooms[305], $secondReservation);
$rooms[401] = new SingleRoom(401, 40);
$rooms[412] = new Bedroom(412, 70);
$rooms[302] = new Bedroom(302, 80);
$rooms[202] = new Bedroom(202, 70);
$rooms[410] = new Bedroom(410, 80);
$rooms[501] = new Apartment(501, 200);
BookManager::bookRoom($rooms[501], $secondReservation);
$rooms[502] = new Apartment(502, 300);
$rooms[601] = new Apartment(601, 350);
echo PHP_EOL;
echo "Bedrooms and apartments with a price less or equal to 250.00"."<br>";
echo PHP_EOL;
$filteredRooms = array_filter($rooms, "getBedroomsAndApartmentsByPrice");
function getBedroomsAndApartmentsByPrice(Room $room)
{
    if (($room instanceof Bedroom) || ($room instanceof Apartment)) {
        if ($room->getPrice() <= 250) {
            return true;
        }
    }
    return false;
}
foreach ($filteredRooms as $room) {
    echo "{$room->getRoomNumber()} - {$room->getRoomType()} - {$room->getPrice()}" . PHP_EOL;
}
echo PHP_EOL . "<br>"."All rooms with a balcony"."<br>";
echo PHP_EOL;
$filteredRoomsWithBalcony = array_filter($rooms, "getAllRoomsWithBalcony");
function getAllRoomsWithBalcony(Room $room)
{
    if ($room->hasBalcony()) {
        return true;
    }
    return false;
}
foreach ($filteredRoomsWithBalcony as $room) {
    echo "{$room->getRoomNumber()} - {$room->getRoomType()} - {$room->hasBalcony()}" . PHP_EOL;
}
echo PHP_EOL ."<br>" ."All room numbers of rooms which have a bathtub"."<br>";
echo PHP_EOL;
$filteredRoomsWithBathtub = array_filter($rooms, "getAllRoomsWithBathtub");
$roomNumbers = array_map("returnRoomNumbers", $filteredRoomsWithBathtub);
function getAllRoomsWithBathtub(Room $room)
{
    if ($room->hasExtra(Extra::BATHTUB)) {
        return true;
    }
    return false;
}
function returnRoomNumbers($room)
{
    return $room->getRoomNumber();
}
foreach ($roomNumbers as $roomNumber) {
    echo $roomNumber . PHP_EOL;
}
echo PHP_EOL . "<br>"."All apartments which are not booked in a given time period"."<br>";
echo PHP_EOL;
$allApartments = array_filter($rooms, "isApartment");
$allEmptyApartmentsForPeriod = array_filter($allApartments, "isEmpty");
function isApartment($room)
{
    return $room instanceof Apartment;
}
function isEmpty(Room $room)
{
    $Guest = new Guest("G", "R", 89466466);
    $reservation = new Reservation("19-10-2014", "21-10-2014", $Guest);
    try {
        $room->checkForValidReservation($reservation);
        return true;
    } catch (EReservationException $ex) {
        return false;
    }
}
foreach ($allEmptyApartmentsForPeriod as $apartment) {
    echo $apartment->getRoomNumber() . PHP_EOL;
}
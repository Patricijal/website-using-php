<?php
// nuskaitome konfigūracijų failą
include 'config.php';
// sukuriamas prisijungimas
$db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

function confirmUserPass($username, $password) {
		global $db;
        /* tikrinama ar user yra db */
        $query = "SELECT password FROM users WHERE username = '$username'";
		$result=$db->query($query);
        /* tikrinama ar slatazodis teisingas */
		$result=$result->fetch_assoc();
        if (md5($password) == $result['password']) {
            return 0; //user vardas ir slaptazodis patvirtinti
        } else {
            return 2; //slaptazodzio klaida
        }
    }
/*Prideda aktyvu naudotoja*/
function addActiveUser($username, $time) {
	global $db;
        $query = "UPDATE users SET timestamp = '$time' WHERE username = '$username'";
        $db->query($query);
        $query = "REPLACE INTO active_users VALUES ('$username', '$time')";
        $db->query($query);
}
// prideda aktyvu svecia 
    function addActiveGuest($ip, $time) {
		global $db;
        $query = "REPLACE INTO active_guests VALUES ('$ip', '$time')";
        $db->query($query);
    }
//salina aktyvu svecia
function removeActiveGuest($ip) {
		global $db;
        $query = "DELETE FROM active_guests WHERE ip = '$ip'";
        $db->query($query);
    }
//salina neaktyvų naudotoja
function removeInactiveUsers() {
	global $db;
        $timeout = time() - 1 * 60;
        $query = "DELETE FROM active_users WHERE timestamp < $timeout";
        $db->query($query);
    }
/* tikrinam ar email duombazeje*/
function isEmailInDB($email) {
    global $db;
    $query = "SELECT * FROM users WHERE email='$email'";
    $result=$db->query($query);
    if (!$result || ($result->num_rows < 1)) {
        return 0; // user su tokiu email nerastas
    } else return 1; // rasti duomenys
}
/* jei naudotojas jau buvo pateikes uzklausa,
ja pasaliname*/
function deleteIfRequestExsists($email) {
    global $db;
    $query = "DELETE FROM pswreset WHERE email='$email'";
    $db->query($query);
}
/* sugeneruotas reiksmes issaugome duomenu bazeje*/
function insertTokenDB($email, $selector, $token, $expires) {
    global $db;
    $query = "INSERT INTO pswreset (email, selector, token, expires)
    VALUES ('$email','$selector','$token','$expires')";
    $db->query($query);
}
/*isrenkam duuomenis is pswreset lenteles sutikrinimui */
function selectResetData($selector, $currentdate){
    global $db;
    $query = "SELECT * FROM pswreset WHERE selector='$selector' AND expires>='$currentdate'";
    $result = $db->query($query);
    return $result;
}
/*randam naudotojo duomenis */
function findUser($email){
    global $db;
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = $db->query($query);
    return $result;
}
/*slaptazodzio pakeitimas ir uzklausos duomenu istrynimas */
function resetPasw($email, $psw){
    global $db;
    $query = "UPDATE users SET password='$psw' WHERE email='$email'";
    $db->query($query);
}
function deleteToken($email){
    global $db;
    $query = "DELETE FROM pswreset WHERE email='$email'";
    $db->query($query);
}
?>

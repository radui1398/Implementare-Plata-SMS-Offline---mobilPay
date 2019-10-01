<?php
include 'mobilPay/ConfirmSMS.php';

$smsController = new ConfirmSMS();

/*
 * Oferim dreptul de acces doar pentru mobilPay. (Vezi documentatia)
 */
$smsController->allow(array("217.156.103.68", "217.156.103.69"));

/*
 * Redirectam orice alt request catre <url>
 */
$smsController->redirectTo('<url>');

/*
 * Asteptam un request. Daca acesta nu are IP-ul in lista de IP-uri permise
 * atunci redirectam catre URL-ul specificat pentru redirect.
 */
$smsController->waitForRequest();

/*
 * Request-ul are drept de acces
 *
 * Functii utile inainte de a trimite mesajul:
 * $smsController->getMessage();  -  Mesajul trimis prin sms (shortcode-ul setat in admin panel)
 * $smsController->getDestination();  -  Semnatura numarului scurt la care mesajul a fost trimis.
 *                                       (Vezi documentatia pentru a afla cum identifici operatorul
 *                                       de telefonie mobila in functie de acest numar)
 * $smsController->getMsgID();  -  Identificator unic oferit de catre SMSC.
 * $smsController->getSender();  -  Numarul de telefon ce a trimis mesajul.
 * $smsController->getTimestamp();  -  Format: YYYYMMDDhhmmss
 */

/*
 *  Configuram raspunsul catre mobilPay
 */

/*
 * 1 - charge
 * 0 - free
 */
$smsController->setOperation(1);

/*
 * Daca acest cod de eroare nu este 0, clientul nu va primi mesajul setat.
 * El va primi un mesaj de la mobilPay prin care este informat ca a intervenit o eroare.
 */
$smsController->setErrorCode(0);

/*
 * Acesta este mesajul primit de client daca nu a intervenit nici o eroare.
 */
$smsController->reply('Ai cumpărat '. $_GET['md'] .' monede de dragon. Folosește codul '. $random_code .' pentru a revendica monedele.');
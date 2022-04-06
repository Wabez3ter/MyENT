<?php

/*$url_file='https://proseconsult.umontpellier.fr/jsp/custom/modules/plannings/direct_cal.jsp?data=58c99062bab31d256bee14356aca3f2423c0f022cb9660eba051b2653be722c4a5f10b982f9b914f8b3df9a16d82f493dc5c094f7d1a811b903031bde802c7f56c5ce5d7b8d9b880fb6990772f87c6e42988e4003796ffd7b370c710463ddfae894802120d56b2a4b539216dabc9724c7a8ae2f6a1bf0cab0beb54246d4caa04,1';

require_once('EDT/SG_iCal.php');
$ical = new SG_iCal($url_file);
echo '<pre>';
foreach( $ical->getEvents() as $event ) {
    //print_r( $event );
    print(date('d/m/Y h:i:s', $event->getStart()));
    print($event->getSummary());
}*/

include('BDSystem.php');

refreshEDT();

?>
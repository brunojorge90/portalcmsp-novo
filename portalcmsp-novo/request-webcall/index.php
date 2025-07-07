<?php
// Certifique-se de que os valores recebidos via GET estão definidos para evitar erros
// Cabeçalho para download do arquivo .ics
header('Content-Type: text/calendar');
header('Content-Disposition: attachment; filename="evento.ics"');
// Escapar os valores usando urlencode ou rawurlencode
$start = $_GET['start'];
$end = $_GET['end'];
$summary = $_GET['summary'];
$location = $_GET['location'];
?>
BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//Camara//<?php echo $summary?>//EN
CALSCALE:GREGORIAN
BEGIN:VEVENT
UID:20231215T090000Z-123456@example.com
DTSTAMP:<?php echo $start."\n"?>
DTSTART:<?php echo $start."\n"?>
DTEND:<?php echo $end."\n"?>
SUMMARY:<?php echo $summary."\n"?>
DESCRIPTION:<?php echo $summary."\n"?>
LOCATION:<?php echo $location."\n"?>
ORGANIZER:mailto:camara@esaopaulo.sp.leg.br
ATTENDEE:mailto:camara@esaopaulo.sp.leg.br
ATTENDEE:mailto:camara@esaopaulo.sp.leg.br
END:VEVENT
END:VCALENDAR
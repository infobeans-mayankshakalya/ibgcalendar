<?php
require_once '../../src/Google_Client.php';
require_once '../../src/contrib/Google_CalendarService.php';
require_once '../../src/contrib/Google_Oauth2Service.php';
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
//unset($_SESSION);
$client = new Google_Client();
$client->setApplicationName("Hankyy");
$client->setScopes("https://www.googleapis.com/auth/calendar.readonly","https://www.googleapis.com/auth/calendar","https://www.googleapis.com/auth/userinfo.email","https://www.googleapis.com/auth/userinfo.profile");

// Visit https://code.google.com/apis/console?api=calendar to generate your
// client id, client secret, and to register your redirect uri.
// $client->setClientId('insert_your_oauth2_client_id');
// $client->setClientSecret('insert_your_oauth2_client_secret');
 $client->setRedirectUri('https://ibgcalendar.herokuapp.com/spark/examples/calendar/simple.php');
// $client->setDeveloperKey('insert_your_developer_key');


$cal = new Google_CalendarService($client);
$oauth2 = new Google_Oauth2Service($client); 
$channel = new Google_Service_Calendar_Channel($client);





if (isset($_GET['logout'])) {
  unset($_SESSION['token']);
}

if (isset($_GET['code'])) {
  //var_dump($_GET['code']);
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken(); 
  //var_dump($_SESSION['token']); 
	
//die;

  header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}

if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}

if ($client->getAccessToken()) {
    
     /*$freebusy = new Google_FreeBusyRequest();
            $freebusy->setTimeMin('2016-06-08T18:15:00+05:30');
            $freebusy->setTimeMax('2016-06-08T18:45:00+05:30');
                $freebusy->setTimeZone('Asia/Calcutta');
                $freebusy->setGroupExpansionMax(10);
                $freebusy->setCalendarExpansionMax(10);
                $mycalendars = array( array("id"=>"infobeans.com_3531353131353438363037@resource.calendar.google.com"));
                //var_dump($mycalendars); die;
                $freebusy->setItems($mycalendars);
                var_dump($freebusy);
                try {
		$createdReq = $cal->freebusy->query($freebusy);
                $result = json_encode($createdReq); //die('111');
                var_dump($createdReq);
                echo "1111";
                //var_dump($createdReq['calendars']['infobeans.com_2d36353439353835313637@resource.calendar.google.com']['busy'][0]);
                foreach($createdReq['calendars'] as $key => $value)
                {
                    foreach($createdReq['calendars'][$value] as $key1 => $value1)
                    {
                       var_dump($value1);
                    }    
                }    
                } catch (Exception $e) {
                         echo $e->getMessage();
                }
                die('111');*/
    
    /*try {
        $optParams = array(
                'orderBy' => 'startTime',
                'singleEvents' => TRUE,
                'timeMin' => '2016-06-07T15:30:00+05:30',
                'timeMax' => '2016-06-07T23:59:00+05:30',
        );    
    //$event = $cal->events->get('infobeans.com_3531353131353438363037@resource.calendar.google.com','dgq1lkko94u20bd30uvjdgdre4'); 
    //$optParams = array('timeMin' => '2016-06-07T15:30:00+05:30','startTime' => '2016-06-07T23:29:00+05:30', 'singleEvents' => true  );
    $event = $cal->events->listEvents('infobeans.com_3531353131353438363037@resource.calendar.google.com',$optParams); 
    echo $event['items'][0]['start']['dateTime']; echo "<br>";
    echo $event['items'][0]['end']['dateTime']; echo "<br>";
    echo $start = strtotime($event['items'][0]['start']['dateTime']); echo "<br>";
    echo $end = strtotime($event['items'][0]['end']['dateTime']);echo "<br>";
    echo $cur_time = '1465259400';  echo "<br>";
    
    
    if ($cur_time > $end && $cur_time < $start )
    {
        $stat="open";
    }
    else
    {
        var_dump($event['items'][0]['creator']); 
    } 
    
    
  
        die;
    foreach($event['items'] as $key => $value)
    {
        $displayName = $value['creator']['displayName'];
        
        
    }    
    var_dump($event); die('xxxxxxx');
    $google_event = Google_Event();
    var_dump($google_event);
    
    var_dump($google_event->getCreator($event));
    
    } catch (Exception $e) {
       echo $e->getMessage();
   } die('xxxx');
  $freebusy = new Google_FreeBusyRequest();
                $freebusy->setTimeMin('2016-06-07T22:00:00+05:30');
                $freebusy->setTimeMax('2016-06-07T23:30:00+05:30');
                $freebusy->setTimeZone('Asia/Calcutta');
                $freebusy->setGroupExpansionMax(10);
                $freebusy->setCalendarExpansionMax(10);
                $mycalendars = array( array("id"=>"infobeans.com_2d36353439353835313637@resource.calendar.google.com"), array("id"=>"infobeans.com_3439353333333132383132@resource.calendar.google.com"),array("id"=> "infobeans.com_3531353131353438363037@resource.calendar.google.com"));
                //var_dump($mycalendars); die;
                $freebusy->setItems($mycalendars);
                var_dump($freebusy);
                try {
		$createdReq = $cal->freebusy->query($freebusy);
                $result = json_encode($createdReq); //die('111');
                //var_dump($createdReq['calendars']['infobeans.com_3531353131353438363037@resource.calendar.google.com']['busy']);
                //echo "1111";
                //var_dump($createdReq['calendars']['infobeans.com_2d36353439353835313637@resource.calendar.google.com']['busy'][0]);
                foreach($createdReq['calendars'] as $key => $value)
                {
                    foreach($createdReq['calendars'][$value] as $key1 => $value1)
                    {
                       var_dump($value1);
                    }    
                }    
                } catch (Exception $e) {
                         echo $e->getMessage();
                }
                die('111');
                
	#echo "<li>here";
	/*$gogole_event = new Google_Event(); 
	$gogole_event->setSummary('test event');
	$gogole_event->setLocation('infobeans.com_2d36353439353835313637@resource.calendar.google.com');

	$gogole_event->setDescription('test event created by vipin');
	//$gogole_event->setTimeZone('Asia/Calcutta');

	$start = new Google_EventDateTime();
	$start->setDateTime('2016-06-04T18:00:00+05:30');
	$gogole_event->setStart($start);


	$end = new Google_EventDateTime();
	$end->setDateTime('2016-06-04T19:00:00+05:30');
	$gogole_event->setEnd($end); 
	*/
	#$timeZone = new Google_EventDateTime();
	#$timeZone->setTimeZone('Asia/Calcutta');
	//$gogole_event->setStart('2016-06-04T19:00:00+05:30');die('111');
	//$gogole_event->setEnd('2016-06-04T20:00:00+05:30'); 
	#$array = array('vipin.sharma@infobeans.com','infobeans.com_2d36353439353835313637@resource.calendar.google.com','vipin.shm@gmail.com');
	#$gogole_event->setAttendees($array);
        
	/*$attendee1 = new Google_EventAttendee();
	$attendee2 = new Google_EventAttendee();
	$attendee1->setEmail("vipin.sharma@infobeans.com");
	$attendee2->setEmail("infobeans.com_2d36353439353835313637@resource.calendar.google.com");
	$attendees = array($attendee1,$attendee2);
        $gogole_event->attendees = $attendees;

	try {
		$gogole_event = $cal->events->insert('vipin.sharma@infobeans.com', $gogole_event );
            } catch (Exception $e) {
                     echo $e->getMessage();
            }
        
	var_dump($gogole_event); //die('vipin');

		/*
	$event = new Google_Service_Calendar_Event(array(
                'summary' => 'How new google calendar event for service account by google calendar api',
                'location' => 'Indore',
                'description' => 'This is a sample script for create event on google calendar which is not share with you.',
                'sendNotifications'   => true,
                'start' => array(
                  'dateTime' => '2016-06-04T16:30:00+05:30',
                  'timeZone' => 'Asia/Calcutta',
                ),
                'end' => array(
                  'dateTime' => '2016-06-04T17:00:00+05:30',
                  'timeZone' => 'Asia/Calcutta',
                ),
                'recurrence' => array(
                  'RRULE:FREQ=DAILY;COUNT=3'
                ),
                'attendees' => array(
                  array('email' => 'infobeans.com_2d3639393330383831343438@resource.calendar.google.com'),
                  array('email' => 'vipin.sharma@infobeans.com'),
                ),
                'reminders' => array(
                  'useDefault' => FALSE,
                  'overrides' => array(
                    array('method' => 'email', 'minutes' => 15),
                    array('method' => 'popup', 'minutes' => 10),
                  ),
                ),
              ));
		var_dump($event);
		#var_dump($cal->events->insert('infobeans.com_2d36353439353835313637@resource.calendar.google.com'));

		#$events = $cal->events->listEvents('infobeans.com_2d36353439353835313637@resource.calendar.google.com"');
		#$event = $cal->events->insert($calendarId, $event);
		#var_dump(json_encode($event));

*/
    $channelID = "Infobeans-Caledar-".  date('His',  time()); 
$channel->setId($channelID);
$channel->setType('web_hook');
$channel->setAddress('https://ibgcalendar.herokuapp.com/index.php');


try {
    
    $watchEvent = $cal->events->watch('infobeans.com_3531353131353438363037@resource.calendar.google.com', $channel);
    var_dump($watchEvent);
    var_dump($channel);
} catch (Exception $e) {
       echo $e->getMessage();
}

die('vipin');
 


$_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
 //echo $authUrl; die;
  print "<a class='login' href='$authUrl'>Connect Me!</a>";
}

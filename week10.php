<?php
// · Errors & Exceptions

// o Bekijk je php.ini en pas de settings aan van display_errors en error_reporting. Neem ook de bijbehorende tekst door
// o Pas de trigger_error functie toe om je eigen error te genereren
// o Bekijk je error-logfiles om te kijken of je eigen error in de logfile is weggeschreven
$size  = -1;

if($size < 0)
	trigger_error("\$size cannot be a negative number");

// o Maak je eigen error handler functie en pas deze toe met set_error_handler
function customErrorHandler($errLevel, $msg)
{
	echo "*****************************************************<br>";
	echo "<b>Error Level:</b> $errLevel<br>
		<b>Error Message:</b> $msg<br>";
	echo "*****************************************************<br>";
	die();
}
// set_error_handler("customErrorHandler"); 

// echo($threeHeadedMonkeys);
// o Maak een try-catch statement waarbij zowel de Exception als de Error class meldingen worden opgevangen


function sightings($sighting){

	if($sighting == "Three headed monkey")
	{
		throw new Exception("Three headed monkeys don't exist");
	}
	if($sighting == "Bigfoot")
	{
		throw new BigFootSighting("Bigfoot doesn't exist");
	}
}

try
{
	// sightings("Three headed monkey");
	sightings("Bigfoot");
}
catch(BigFootSighting $b)
{
	echo "<br>Exception: " . $b->getMessage();
	echo "<br>Class: " . get_class($b);
}
catch(Exception $e)
{
	echo "<br>Exception: " . $e->getMessage();
	echo "<br>Class: " . get_class($e);
}


// o Maak je eigen Exception class en pas deze ook toe in de try/catch van hierboven
// o Voeg aan je Exception class toe dat deze in een log-file wegschrijf op welke regel van welk bestand de exceptions voorkomt. Zet ook de melding van de error in de log-file.
class BigFootSighting extends Exception
{
	public function __construct($message = null, $code = 0)
	{
	  parent::__construct($message, $code);
	  error_log($this->getTraceAsString(), 3,
	      'php_error.log'); 
	}
}
// sightings("Bigfoot");

// · Security

// o Bekijk je php.ini en kijk wat de waarden zijn van session.use_only_cookies, session.cookie_httponly en allow_url_include

// o Controleer of jouw sessies gebruik maken van een sessie-id
// ini_set('session.use_strict_mode', 1);
// $sid = md5('adwhopwad');
// session_id($sid);
// session_start();
// var_dump(session_id() === $sid);// always false

session_start();

echo "<br>Session ID: ". session_id();
// o Experimenteer met de session_regenerate_id functie

session_regenerate_id();
echo "<br>Session ID: ". session_id();

// o Experimenteer met alle functies om security fouten te voorkomen, bijv htmlspecialchar en strip_tags
echo "<br>";
$str = "<b>bold text</b>, 'quoted text' <i>italicized text</i> '\"";
echo htmlspecialchars($str, ENT_COMPAT);
echo "<br>";

echo strip_tags("The <b>bold</b> man stripped the poor girl <p>naked</p>, <i>every</i> <label>piece of cloth</label> was removed.", "<b>");
echo "<br>";

// o Experimenter met crypt(), md5() en sha1()

echo crypt("blah", "CRYPT_BLOWFISH");
echo "<br>";
echo crypt("blah", "CRYPT_STD_DES");
echo "<br>";
echo md5("blah");
echo "<br>";
echo sha1("blah");
echo "<br>";

// o Doorloop je eigen casus-opdracht en/of overige opdrachten en toon aan of je vatbaar bent voor de top 10 OWASP security fouten.

// o Doorloop deze website que oefeningen: https://www.certifiedsecure.com/frontpage 

?>
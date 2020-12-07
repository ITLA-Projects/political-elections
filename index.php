<?php

/**
 * STRUCTURE OF THE PROJECT - MIGUEL ANGEL - 2018-6717
 */

//load database
require_once 'libs/database.php';
require_once 'libs/utilities.php';

//time zone
date_default_timezone_set("America/Santo_Domingo");

//load models
require_once 'models/adminUser.php';
require_once 'models/candidate.php';
require_once 'models/citizen.php';
require_once 'models/election.php';
require_once 'models/electoralPosition.php';
require_once 'models/politicalParty.php';
require_once 'models/result.php';

//load libs & repos
require_once 'libs/IRepository.php';
require_once 'libs/repository.php';
//remember custom repositories
require_once 'repositories/electoralPositionRepository.php';
require_once 'repositories/candidateRepository.php';
require_once 'repositories/politicalPartyRepository.php';
require_once 'repositories/resultRepository.php';
require_once 'repositories/electionRepository.php';
require_once 'repositories/citizenRepository.php';

//mailer
require_once 'libs/mail/Exception.php';
require_once 'libs/mail/PHPMailer.php';
require_once 'libs/mail/SMTP.php';

require_once 'libs/auth.php';
require_once 'libs/controller.php';
require_once 'libs/view.php';
require_once 'libs/model.php';
require_once 'libs/app.php';
require_once 'libs/EmailHandler.php';

//load config
require_once 'config/config.php';

//load session
session_start();

//load app
$app = new App();

?>
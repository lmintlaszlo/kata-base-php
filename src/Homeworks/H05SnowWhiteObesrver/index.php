<?php

require_once 'ObserverAbstract.php';
require_once 'SubjectAbstract.php';

require_once 'Observer/Bashful.php';
require_once 'Observer/Doc.php';
require_once 'Observer/Dopey.php';
require_once 'Observer/Grumpy.php';
require_once 'Observer/Happy.php';
require_once 'Observer/Sleepy.php';
require_once 'Observer/Sneezy.php';

require_once 'Subject/SnowWhite.php';

$snowWhite = new SnowWhite();

// Attach observers
$snowWhite->attach(new Doc());
$snowWhite->attach(new Happy());
$snowWhite->attach(new Bashful());
$snowWhite->attach(new Sleepy());
$snowWhite->attach(new Sneezy());
$snowWhite->attach(new Grumpy());
$snowWhite->attach(new Dopey());

// Do actions
$snowWhite->sitDown();
$snowWhite->combHair();
$snowWhite->stripDown();
$snowWhite->standUp();

echo PHP_EOL . PHP_EOL;
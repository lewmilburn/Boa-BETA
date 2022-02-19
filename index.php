<?php
require __DIR__.'/Boa/Boa.php';

new Boa\App();

$email = new Boa\Email\PHPMail();
$email->sendMail('benmackley10@gmail.com', 'lewismilburn@icloud.com', 'Hello', 'hello you dumb fucker');
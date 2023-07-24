> This is an archive of my initial version of Boa (A kinda beta-test of it). Boa has now released and has a new home at https://github.com/pixelsetdev/boa. If you'd like to use Boa, please use the new version. This repository is probably outdated and not secure for production use.

# Boa
Boa is the simple, fast and reliable PHP Framework. It's a lightweight PHP Library that's focused on being easy to learn and use, safe and secure, and incredibly reliable.
Boa is only 34kB in size, making it one of the smallest PHP Libraries in existence.

## What is Boa for?
Boa is designed to make your everyday PHP tasks faster, more secure, and more standardized.
For example, if your PHP application had multiple calls to a database, and you discovered a vulnerability, you'd have to patch them all - and risk missing one out.
But with Boa, we patch it once and your application receives the same patch everywhere.
Your code is standardized and the same across the board, you don't have to waste time setting up the basics, and you don't have to worry about security or speed.

## Securing your Boa App - Database Escaping
You MUST escape your data BEFORE you query it. The query function DOES NOT escape it for you. Use the Escape() function in the Boa\Database\SQL module.
```
require 'Boa/Boa.php';

$App = new Boa\Boa();

$SQL = new Boa\Database\SQL();

$CleanData = $SQL->Escape($DirtyData);
```

## Issue Tracker & Suggestions
Submit: https://feedback.lmwn.co.uk/software-feedback/?product=Boa

Known issues: https://feedback.lmwn.co.uk/boa/reports

Existing Suggestions: https://feedback.lmwn.co.uk/boa/suggestions

## System Requirements
- PHP 8.0 or higher.

## Projects that use Boa
- Pixelset (LMWNWeb/Pixelset)
- WhatAccomm? (whataccomm.com)
- Feedback (LMWNWeb/Feedback)

## Software included in Boa
- bramus/router (https://github.com/bramus/router) - MIT License

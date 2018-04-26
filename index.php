<?php

use Fideles\Fideles;

require 'vendor/autoload.php';

$fideles = new Fideles(__DIR__ . '/data/MahasiswaAktif_15.xlsx');
dd(Fideles::VERSION());

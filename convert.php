#!/usr/bin/env php
<?php

$f = '_normalize.scss';

chdir(__DIR__);

shell_exec('sass-convert normalize.css '.$f);

$scss = file_get_contents($f);
$scss = preg_replace('%/\*.*?\*/%s', '', $scss);
$scss = preg_replace('/^[ \t]*$\n/m', '', $scss);
$scss = preg_replace('/;[ \t]*\n^[ \t]*\}$/m', '; }', $scss);
$scss = preg_replace('/^(\s*)/m', '$1$1', $scss);
$scss = preg_replace('/\}$\n^([a-z])/m', "}\n\n\$1", $scss);

file_put_contents($f, $scss);

shell_exec('sass --check '.$f);

#!/usr/bin/env php
<?php

require __DIR__ . '/bootstrap/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$status = $kernel->handle(
    $input = new Symfony\Component\Console\Input\ArrayInput([
        'command' => 'db:seed',
        '--force' => true,
    ]),
    $output = new Symfony\Component\Console\Output\BufferedOutput()
);

echo $output->fetch();

$kernel->terminate($input, $status);

exit($status);

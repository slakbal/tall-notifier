<?php

it('has console/command/install page', function () {
    $artisan = $this->artisan('tall-notifier:install');
    // $artisan->expectsOutput("Livewire Notifier is installed");
    $artisan->assertExitCode(1);
});

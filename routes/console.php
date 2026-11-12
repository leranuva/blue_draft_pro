<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Models\QuoteAttachment;
use Illuminate\Support\Facades\Storage;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('admin:provision {email}', function () {
    $email = strtolower(trim($this->argument('email')));
    $password = $this->secret('New administrator password');
    $validator = Validator::make(compact('email', 'password'), [
        'email' => ['required', 'email', 'max:255'],
        'password' => ['required', Password::min(16)],
    ]);

    if ($validator->fails()) {
        $this->error($validator->errors()->first());

        return 1;
    }

    $user = User::firstOrNew(['email' => $email]);
    $user->name ??= $this->ask('Administrator name');
    $user->forceFill(['password' => $password, 'is_admin' => true, 'remember_token' => null])->save();
    $this->info('Administrator provisioned.');

    return 0;
})->purpose('Provision or rotate the password of an explicitly approved administrator');

Artisan::command('quotes:privatize-attachments', function () {
    $public = Storage::disk('public');
    $private = Storage::disk('quote_attachments');
    $missing = 0;

    foreach ($public->allFiles('quotes') as $path) {
        $stream = $public->readStream($path);
        if (!is_resource($stream)) {
            throw new RuntimeException('Unable to read a public quote attachment.');
        }

        try {
            $private->put($path, $stream);
        } finally {
            fclose($stream);
        }

        if (!$public->delete($path)) {
            throw new RuntimeException('Unable to remove a public quote attachment.');
        }
    }

    foreach (QuoteAttachment::query()->lazyById() as $attachment) {
        if (!$private->exists($attachment->file_path)) {
            $missing++;
            $this->error("Attachment {$attachment->id} is missing from private storage.");
        }
    }

    return $missing === 0 ? 0 : 1;
})->purpose('Move existing quote attachments to private storage');

Schedule::command('quotes:mark-abandoned')->daily();
Schedule::command('leads:check-followups')->hourly();
Schedule::command('report:monthly', ['--email'])->monthlyOn(1, '06:00');

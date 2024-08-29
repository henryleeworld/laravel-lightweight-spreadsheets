<?php

namespace App\Http\Controllers;

use App\Models\User;
use File;
use Glhd\Linen\Facades\Linen;

class UsersController extends Controller 
{
    public function import() 
    {
        // set_time_limit(300);
        foreach (Linen::read(storage_path('files/users.sample.xlsx')) as $row) {
            echo __('[') . __('ID') . __(']') . __(': ') .  $row['id'] . ' ' . '-' . ' ' . __('[') . __('Name') . __(']') . __(': ')  .  $row['name'] . ' ' . '-' . ' ' . __('[') . __('Email') . __(']') . __(': ')  . $row['email'] . PHP_EOL;
        }
        echo __('Imported successfully.') . PHP_EOL;
    }

    public function export() 
    {
        $directoryPath = storage_path('files');
        if (!File::isDirectory($directoryPath)) {
            File::makeDirectory($directoryPath);
        }
        Linen::write(User::all(), $directoryPath . '/'. 'users.' . now()->timestamp . '.xlsx');
        echo __('Exported successfully.') . PHP_EOL;
    }
}

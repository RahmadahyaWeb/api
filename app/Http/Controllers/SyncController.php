<?php

namespace App\Http\Controllers;

use App\Models\Sync;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SyncController extends Controller
{
    public function sync()
    {
        $sync = new Sync;

        $login = $sync->login();

        if (!$login) {
            abort(500, 'Connection failed');
        }

        $syncTable = $sync->syncTable($login['token']);

        foreach ($syncTable['data'] as $table => $data) {
            foreach ($data as $row) {
                DB::table($table)->insert(
                    (array) $row
                );
            }
        }

        echo "sync berhasil";
    }
}

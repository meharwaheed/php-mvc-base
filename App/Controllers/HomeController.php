<?php

namespace App\Controllers;

use App\Models\User;

class HomeController extends MainController
{
    public function viewHomePage($id, $race): void
    {
        $data = [
           'data' => User::all(),
            'id' => $id,
            'race' => $race,
        ];
        $this->sendResponse($data);
    }
}
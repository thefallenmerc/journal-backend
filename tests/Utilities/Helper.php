<?php


use Illuminate\Support\Facades\DB;
use Laravel\Passport\ClientRepository;

if (!function_exists('make')) {
    function make($model, $overrides =  [], $count = 1)
    {
        if ($count < 2) {
            return factory($model)->make($overrides);
        } else {
            return factory($model, $count)->make($overrides);
        }
    }
}

if (!function_exists('create')) {
    function create($model, $overrides = [], $count = 1)
    {
        if ($count < 2) {
            return factory($model)->create($overrides);
        } else {
            return factory($model, $count)->create($overrides);
        }
    }
}

if (!function_exists('generateHeaders')) {
    function generateHeaders(\App\User $user = null, $token = null)
    {
        $headers = [
            'Accept' => "application/json"
        ];

        if ($user != null) {
            $headers['Authorization'] = "Bearer {$user->createToken('testtoken')->accessToken}";
        }

        if ($token !== null) {
            $headers['Authorization'] = "Bearer {$token}";
        }

        return $headers;
    }
}

if(!function_exists('setUpPassport')) {
    function setUpPassport()
    {
        $clientRepository = new ClientRepository();
        $client = $clientRepository->createPersonalAccessClient(null, 'Testing Token', url('/'));
        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->id,
            'created_at' => new \DateTime,
            'updated_at' => new \DateTime
        ]);
    }
}

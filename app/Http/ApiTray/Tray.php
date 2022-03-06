<?php

namespace App\Http\ApiTray;

use App\Http\Services\CreateRefreshTokenServices;
use App\Models\Other;
use Illuminate\Support\Facades\Http;

class Tray
{

    public function post(string $url, array $data): string
    {
        try {
            $token = $this->retryTokenDatabase();
            $token = $token['access_token'];
            $response = Http::post(env('CONSUMER_TRAY_URI') . $url . '?access_token=' . $token, $data);
            return $response;
        } catch (\Exception $exception) {
            return responseHTTP(500, $exception->getMessage());
        }
    }

    public function get(string $url, string $params = ''): array
    {
        try {
            $token = $this->retryTokenDatabase();
            $token = $token['access_token'];
            $response = Http::get(env('CONSUMER_TRAY_URI') . '/' . $url . '?access_token=' . $token . $params);
            $response = json_decode($response, true);
            if (isset($response['code']) and $response['code'] === 401 and $response['error_code'] === 1000) {
                (new CreateRefreshTokenServices($this))->get();
            }
            return $response;
        } catch (\Exception $exception) {
            return responseHTTP(500, $exception->getMessage());
        }
    }

    public function delete(string $url, string $params = ''): array
    {
        try {
            $token = $this->retryTokenDatabase();
            $token = $token['access_token'];
            $response = Http::delete(env('CONSUMER_TRAY_URI') . '/' . $url . '?access_token=' . $token . $params);
            $response = json_decode($response, true);
            if (isset($response['code']) and $response['code'] === 401 and $response['error_code'] === 1000) {
                (new CreateRefreshTokenServices($this))->get();
            }
            return $response;
        } catch (\Exception $exception) {
            return responseHTTP(500, $exception->getMessage());
        }
    }

    public function update(string $url, array $data): string
    {
        try {
            $token = $this->retryTokenDatabase();
            $token = $token['access_token'];
            $response = Http::put(env('CONSUMER_TRAY_URI') . $url . '?access_token=' . $token, $data);
            return $response;
        } catch (\Exception $exception) {
            return responseHTTP(500, $exception->getMessage());
        }
    }

    public function updateToken(): void
    {
        $data['value'] = $this->get('auth?', $this->refreshToken());
        Other::updateOrCreate(['field' => 'tray'], $data);
    }

    public function getToken(): array
    {
        return [
            'consumer_key' => env('CONSUMER_TRAY_KEY'),
            'consumer_secret' => env('CONSUMER_TRAY_SECRET'),
            'code' => env('CONSUMER_TRAY_CODE'),
        ];
    }

    public function refreshToken(): string
    {
        $token = $this->retryTokenDatabase();
        if (isset($token['refresh_token'])) {
            return 'refresh_token=' . $token['refresh_token'];
        }
        exit;
    }

    public function retryTokenDatabase(): array
    {
        return json_decode(Other::getTokenTray()->value, true);
    }
}

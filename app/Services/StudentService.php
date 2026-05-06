<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class StudentService
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim(env('API_BASE_URL'), '/') . '/students';
    }

    public function getAll(): array
    {
        $response = Http::acceptJson()->get($this->baseUrl);

        if (! $response->successful()) {
            return [];
        }

        $data = $response->json();

        return is_array($data) ? $data : [];
    }

    public function getById(int $id): ?array
    {
        $response = Http::acceptJson()->get($this->baseUrl . '/' . $id);

        if (! $response->successful()) {
            return null;
        }

        $data = $response->json();

        return is_array($data) ? $data : null;
    }

    public function create(array $data): bool
    {
        $response = Http::acceptJson()->post($this->baseUrl, $data);

        return $response->successful();
    }

    public function update(int $id, array $data): bool
    {
        $response = Http::acceptJson()->put($this->baseUrl . '/' . $id, $data);

        return $response->successful();
    }

    public function delete(int $id): bool
    {
        $response = Http::acceptJson()->delete($this->baseUrl . '/' . $id);

        return $response->successful();
    }
}
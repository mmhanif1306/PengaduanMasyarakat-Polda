<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class WilayahController extends Controller
{
    private $baseUrl = 'https://emsifa.github.io/api-wilayah-indonesia/api';
    private $timeout = 10;
    private $cacheTime = 3600; // 1 hour

    /**
     * Get all provinces
     */
    public function getProvinces()
    {
        try {
            $cacheKey = 'wilayah_provinces';
            
            return Cache::remember($cacheKey, $this->cacheTime, function () {
                Log::info('Fetching provinces from API');
                
                $response = Http::timeout($this->timeout)
                    ->get($this->baseUrl . '/provinces.json');
                
                if ($response->successful()) {
                    $data = $response->json();
                    Log::info('Provinces fetched successfully', ['count' => count($data)]);
                    return response()->json($data);
                }
                
                throw new \Exception('Failed to fetch provinces: ' . $response->status());
            });
        } catch (\Exception $e) {
            Log::error('Error fetching provinces', ['error' => $e->getMessage()]);
            
            // Return fallback data
            return response()->json([
                ['id' => '11', 'name' => 'ACEH'],
                ['id' => '12', 'name' => 'SUMATERA UTARA'],
                ['id' => '13', 'name' => 'SUMATERA BARAT'],
                ['id' => '14', 'name' => 'RIAU'],
                ['id' => '15', 'name' => 'JAMBI'],
                ['id' => '16', 'name' => 'SUMATERA SELATAN'],
                ['id' => '17', 'name' => 'BENGKULU'],
                ['id' => '18', 'name' => 'LAMPUNG'],
                ['id' => '19', 'name' => 'KEPULAUAN BANGKA BELITUNG'],
                ['id' => '21', 'name' => 'KEPULAUAN RIAU'],
                ['id' => '31', 'name' => 'DKI JAKARTA'],
                ['id' => '32', 'name' => 'JAWA BARAT'],
                ['id' => '33', 'name' => 'JAWA TENGAH'],
                ['id' => '34', 'name' => 'DI YOGYAKARTA'],
                ['id' => '35', 'name' => 'JAWA TIMUR'],
                ['id' => '36', 'name' => 'BANTEN'],
                ['id' => '51', 'name' => 'BALI'],
                ['id' => '52', 'name' => 'NUSA TENGGARA BARAT'],
                ['id' => '53', 'name' => 'NUSA TENGGARA TIMUR'],
                ['id' => '61', 'name' => 'KALIMANTAN BARAT'],
                ['id' => '62', 'name' => 'KALIMANTAN TENGAH'],
                ['id' => '63', 'name' => 'KALIMANTAN SELATAN'],
                ['id' => '64', 'name' => 'KALIMANTAN TIMUR'],
                ['id' => '65', 'name' => 'KALIMANTAN UTARA'],
                ['id' => '71', 'name' => 'SULAWESI UTARA'],
                ['id' => '72', 'name' => 'SULAWESI TENGAH'],
                ['id' => '73', 'name' => 'SULAWESI SELATAN'],
                ['id' => '74', 'name' => 'SULAWESI TENGGARA'],
                ['id' => '75', 'name' => 'GORONTALO'],
                ['id' => '76', 'name' => 'SULAWESI BARAT'],
                ['id' => '81', 'name' => 'MALUKU'],
                ['id' => '82', 'name' => 'MALUKU UTARA'],
                ['id' => '91', 'name' => 'PAPUA BARAT'],
                ['id' => '94', 'name' => 'PAPUA']
            ]);
        }
    }

    /**
     * Get cities/regencies by province ID
     */
    public function getCities($provinceId)
    {
        try {
            $cacheKey = "wilayah_cities_{$provinceId}";
            
            return Cache::remember($cacheKey, $this->cacheTime, function () use ($provinceId) {
                Log::info('Fetching cities for province', ['province_id' => $provinceId]);
                
                $response = Http::timeout($this->timeout)
                    ->get($this->baseUrl . "/regencies/{$provinceId}.json");
                
                if ($response->successful()) {
                    $data = $response->json();
                    Log::info('Cities fetched successfully', ['count' => count($data)]);
                    return response()->json($data);
                }
                
                throw new \Exception('Failed to fetch cities: ' . $response->status());
            });
        } catch (\Exception $e) {
            Log::error('Error fetching cities', ['province_id' => $provinceId, 'error' => $e->getMessage()]);
            
            // Return empty array as fallback
            return response()->json([]);
        }
    }

    /**
     * Get districts by city/regency ID
     */
    public function getDistricts($cityId)
    {
        try {
            $cacheKey = "wilayah_districts_{$cityId}";
            
            return Cache::remember($cacheKey, $this->cacheTime, function () use ($cityId) {
                Log::info('Fetching districts for city', ['city_id' => $cityId]);
                
                $response = Http::timeout($this->timeout)
                    ->get($this->baseUrl . "/districts/{$cityId}.json");
                
                if ($response->successful()) {
                    $data = $response->json();
                    Log::info('Districts fetched successfully', ['count' => count($data)]);
                    return response()->json($data);
                }
                
                throw new \Exception('Failed to fetch districts: ' . $response->status());
            });
        } catch (\Exception $e) {
            Log::error('Error fetching districts', ['city_id' => $cityId, 'error' => $e->getMessage()]);
            
            // Return empty array as fallback
            return response()->json([]);
        }
    }

    /**
     * Get villages by district ID
     */
    public function getVillages($districtId)
    {
        try {
            $cacheKey = "wilayah_villages_{$districtId}";
            
            return Cache::remember($cacheKey, $this->cacheTime, function () use ($districtId) {
                Log::info('Fetching villages for district', ['district_id' => $districtId]);
                
                $response = Http::timeout($this->timeout)
                    ->get($this->baseUrl . "/villages/{$districtId}.json");
                
                if ($response->successful()) {
                    $data = $response->json();
                    Log::info('Villages fetched successfully', ['count' => count($data)]);
                    return response()->json($data);
                }
                
                throw new \Exception('Failed to fetch villages: ' . $response->status());
            });
        } catch (\Exception $e) {
            Log::error('Error fetching villages', ['district_id' => $districtId, 'error' => $e->getMessage()]);
            
            // Return empty array as fallback
            return response()->json([]);
        }
    }

    /**
     * Clear wilayah cache
     */
    public function clearCache()
    {
        try {
            $keys = [
                'wilayah_provinces',
                // We can't clear all city/district/village caches easily without knowing all IDs
                // But we can implement a more sophisticated cache clearing if needed
            ];
            
            foreach ($keys as $key) {
                Cache::forget($key);
            }
            
            return response()->json(['message' => 'Cache cleared successfully']);
        } catch (\Exception $e) {
            Log::error('Error clearing cache', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to clear cache'], 500);
        }
    }
}
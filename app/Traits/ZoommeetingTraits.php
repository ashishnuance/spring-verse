<?php 
namespace App\Traits;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Log;

/**
 * trait ZoomMeetingTrait
 */
trait ZoommeetingTraits
{

    private function retrieveZoomUrl()
    {
        return env('ZOOM_API_URL', '');
    }

    public function zoomGet(string $path, array $query = [],$token='')
    {
        $url = $this->retrieveZoomUrl();
        $request = $this->zoomRequest($token);
        return $request->get($url . $path, $query);
    }

    public function zoomPost(string $path, array $body = [],$token='')
    {
        $url = $this->retrieveZoomUrl();
        $request = $this->zoomRequest($token);
        return $request->post($url . $path, $body);
    }

    private function zoomRequest($token)
    {
        
        return Http::withHeaders([
            'authorization' => 'Bearer ' . $token,
            'content-type' => 'application/json',
        ]);
    }

    public function toZoomTimeFormat(string $dateTime)
    {
        try {
            $date = new \DateTime($dateTime);
            return $date->format('Y-m-d\TH:i:s');
        } catch(\Exception $e) {
            Log::error('ZoomJWT->toZoomTimeFormat : ' . $e->getMessage());
            return '';
        }
    }

    public function toUnixTimeStamp(string $dateTime, string $timezone)
    {
        try {
            $date = new \DateTime($dateTime, new \DateTimeZone($timezone));
            return $date->getTimestamp();
        } catch (\Exception $e) {
            Log::error('ZoomJWT->toUnixTimeStamp : ' . $e->getMessage());
            return '';
        }
    }

}
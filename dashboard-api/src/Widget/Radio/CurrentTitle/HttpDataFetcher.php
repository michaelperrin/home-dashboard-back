<?php

namespace Dashboard\Widget\Radio\CurrentTitle;

class HttpDataFetcher
{
    public function fetchData($url)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $url);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception(sprintf('Could not retrieve current title data (URL: %s)', $url));
        }

        return $response->getBody();
    }
}

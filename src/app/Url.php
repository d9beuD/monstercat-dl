<?php

namespace MonstercatDl;

/**
 * Get contents from URL with the ability to return a response code
 */
class Url
{
    private $responseCode;

    /**
     * Parse headers after a request
     * @param  Array $headers The headers to parse
     * @return Array          The formated headers
     */
    private function parseHeaders(Array $headers): Array
    {
        $head = [];

        foreach($headers as $k => $v) {
            $t = explode(':', $v, 2);
            if (isset($t[1])) {
                $head[trim($t[0])] = trim($t[1]);
            } else {
                $head[] = $v;
                if( preg_match("#HTTP/[0-9\.]+\s+([0-9]+)#", $v, $out)) {
                    $head['response_code'] = intval($out[1]);
                }
            }
        }

        return $head;
    }

    /**
     * Get contents from URL
     * @param  string $url The URL
     * @return string      The content
     */
    public function get(string $url): string
    {
        $contents = file_get_contents($url);
        $headers = $this->parseHeaders($http_response_header);
        $this->responseCode = $headers['response_code'];

        return $contents;
    }

    public function responseCode(): int
    {
        return $this->responseCode;
    }
}

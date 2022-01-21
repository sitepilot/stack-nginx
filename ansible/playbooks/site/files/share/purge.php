<?php

class Purge
{
    public function __construct()
    {
        $url = $_GET['url'] ?? ($_POST['url'] ?? null);

        if (!$url) {
            return;
        }

        $path = $this->get_cache_path_for_url($url);

        if (file_exists($path)) {
            if (is_dir($path)) {
                $this->remove_dir($path);
            } else {
                unlink($path);
            }
        }

        echo "Purged!";
    }

    function remove_dir($path): void
    {
        $files = glob($path . '/*');

        foreach ($files as $file) {
            is_dir($file) ? $this->remove_dir($file) : unlink($file);
        }

        rmdir($path);
    }

    private function get_cache_path_for_url($url): string
    {
        if ($url == 'all') {
            $cache_path = '';
        } else {
            $parsed_url = parse_url(rtrim($url, "/") . '/');
            $cache_key  = md5($parsed_url['scheme'] . 'GET' . $parsed_url['host'] . $parsed_url['path']);
            $cache_path = substr($cache_key, -1) . '/' . substr($cache_key, -3, 2) . '/' . $cache_key;
        }

        return $_SERVER['SITEPILOT_CACHE_PATH'] . "/$cache_path";
    }
}

new Purge;

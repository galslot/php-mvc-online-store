<?php

namespace core;

class Cache
{
    use TSingleton;

    private function __construct()
    {
        if(!is_dir(CACHE)){
            if (!mkdir(CACHE, PERMISSION_VAR, true)) {
                die('Не удалось создать директорию для CACHE.');
            }
        }
    }

    public function setCache($key, $data, $expire = 14400): bool
    {
        $content['data'] = $data;
        $content['end_time'] = time() + $expire;
        $file = $this->getPath($key);

        if(file_put_contents($file, serialize($content))) {
            return true;
        }
        return false;
    }

    public function getCache($key)
    {
        $file = $this->getPath($key);

        if(file_exists($file)) {
            $content = unserialize(file_get_contents($file));
            if(time() <= $content['end_time']) {
                return $content['data'];
            }
            unlink($file);
        }
        return false;
    }

    public function deleteCache($key): bool
    {
        $file = $this->getPath($key);
        if(!file_exists($file)) {
            return false;
        }
        unlink($file);
        return true;
    }

    private function getPath($key): string
    {
        return CACHE. "/". md5($key).".txt";
    }

}

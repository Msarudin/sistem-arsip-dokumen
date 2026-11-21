<?php

namespace App\Libraries;

use Aws\S3\S3Client;

class CloudStorage
{
    protected $s3;
    protected $bucket;

    public function __construct()
    {
        $this->bucket = env('S3_BUCKET');

        $this->s3 = new S3Client([
            'region'                  => 'auto',
            'endpoint'                => 'https://fly.storage.tigris.dev',
            'version'                 => 'latest',
            'use_path_style_endpoint' => false,
            'http'                    => [
                'verify' => false,
            ],
            'credentials' => [
                'key'    => env('S3_ACCESS_KEY'),
                'secret' => env('S3_SECRET_KEY'),
            ],
        ]);
    }

    public function upload($file, $folder = 'arsip')
    {
        $key = $folder . '/' . $file->getRandomName();

        try {
            $this->s3->putObject([
                'Bucket'      => $this->bucket,
                'Key'         => $key,
                'SourceFile'  => $file->getTempName(),
                'ContentType' => $file->getMimeType(),
            ]);

            return $key;
        } catch (\Throwable $e) {
            log_message('error', 'Cloud Upload Error: ' . $e->getMessage());
            return false;
        }
    }

    public function getUrl($key, $durasi = '+60 minutes')
    {
        if (empty($key)) return '#';

        $cmd = $this->s3->getCommand('GetObject', [
            'Bucket' => $this->bucket,
            'Key'    => $key,
        ]);

        $request = $this->s3->createPresignedRequest($cmd, $durasi);
        return (string) $request->getUri();
    }

    public function getDownloadUrl($key, $namaFile = 'dokumen', $durasi = '+60 minutes')
    {
        if (empty($key)) return '#';

        $cmd = $this->s3->getCommand('GetObject', [
            'Bucket'                     => $this->bucket,
            'Key'                        => $key,
            'ResponseContentDisposition' => 'attachment; filename="' . $namaFile . '"',
        ]);

        $request = $this->s3->createPresignedRequest($cmd, $durasi);
        return (string) $request->getUri();
    }

    public function delete($key)
    {
        if (empty($key)) return false;

        try {
            $this->s3->deleteObject([
                'Bucket' => $this->bucket,
                'Key'    => $key,
            ]);
            return true;
        } catch (\Throwable $e) {
            log_message('error', 'Cloud Delete Error: ' . $e->getMessage());
            return false;
        }
    }
}

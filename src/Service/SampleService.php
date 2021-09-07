<?php


namespace App\Service;


use Symfony\Component\Filesystem\Filesystem;

class SampleService
{

    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function parse(string $source){
        return "Test Service " . $source;
    }
}

<?php
/**
 * Copyright © 2010-2018 Epicor Software Corporation: All Rights Reserved
 */

namespace Dev\LogData\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateFileCommand extends Command
{


    /**
     * @var \Magento\Framework\Url\Encoder
     */
    private $encoder;
    /**
     * @var \Magento\Framework\Url\DecoderInterface
     */
    private $decoder;

    public function __construct(
        \Magento\Framework\Url\EncoderInterface $encoder,
        \Magento\Framework\Url\DecoderInterface $decoder,
        string $name = null
    ) {
        parent::__construct($name);

        $this->encoder = $encoder;
        $this->decoder = $decoder;
    }

    protected function configure()
    {
        $this->setName('dev:create:file');
        $this->setDescription('Creates a test file');

        parent::configure();
    }

    private function decodeUrl($url)
    {
        $base64Decoded = base64_decode($url);
        var_dump($base64Decoded);
        $decoder = $this->decoder->decode($base64Decoded);
        var_dump($decoder);
        $unserialized =  unserialize($decoder);

        var_dump($unserialized);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $urls = file_get_contents('/var/www/html/ECC2/var/urls.txt');
        $urlArray = explode(',', $urls);
        var_dump($urlArray);
        foreach ($urlArray as $url) {
            $this->decodeUrl($url);
        }

        $fileData = [
            [
                'web_file_id' => '67',
                'erp_file_id' => '',
                'filename' => 'additional doug line.txt'
            ],
            ['web_file_id' => '68',
                'erp_file_id' => '',
                'filename' => 'additional doug att.txt']
        ];

        foreach ($fileData as $testData) {
            $ser = serialize($testData);
            $urlEncoded = $this->encoder->encode($ser);
            $encoded64 = base64_encode($urlEncoded);
            //  var_dump($encoded64);

            $url = 'http://ecc.magento2.vm/epicor/file/request/file/' . $encoded64 . '/';
            $result = 'id ' . $testData['web_file_id'] . ' : ' . $url . PHP_EOL;
            file_put_contents('/var/www/html/ECC2/urltest.txt', $result, FILE_APPEND);

        }
        $testServerFiles1 = [ 'MzlFQ0NmaWxlMTIzNCE=', 'NDBFQ0NmaWxlMTIzNCE='];

        foreach ($testServerFiles1 as $data) {
            var_dump(base64_decode($data));
        }


       // unserialize($this->urlDecoder->decode(base64_decode($this->request->getParam('file'))));
        /*$head = '-START-START-START-START-START-START-START-START-START-START-START-START-START-START-START-START-';
        $end = "\n\r" . '-END-END-END-END-END-END-END-END-END-END-END-END-END-END-END-END-END-END-END-END-END-END-END-END-';
        $content = "\n\r" . '192.168.234.1 - - [19/Nov/2018:08:11:59 -0800] "GET /static/version1491217453/frontend/Magento/luma/en_US/jquery.js HTTP/1.1" 200 83944 "http://blank.magento2.vm/" "Mozilla/5.0 (Windows NT10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36"';
        $filePath = '/var/www/html/ECC2/var/log/test.log';
        file_put_contents($filePath, $head);
        $size = 0;
        $createFile = true;
        while ($createFile) {
            $size += file_put_contents($filePath, $content, FILE_APPEND);

            if($size > 1000000000){
                $createFile = false;
            }
        }
        file_put_contents($filePath, $end, FILE_APPEND);*/
    }
}
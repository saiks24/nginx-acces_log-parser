<?php


namespace Saiks24\Render;


class HttpRender implements RenderInterface
{

    public function render(array $parsedData): void
    {
        $outPutMessage = json_encode($parsedData,JSON_UNESCAPED_UNICODE);
        http_response_code(200);
        header('Content-Length: ' . strlen($outPutMessage));
        header('Content-Type: application/json');
        header('Cache-Control: private, no-cache, max-age=0, must-revalidate');
        echo $outPutMessage;
    }

}
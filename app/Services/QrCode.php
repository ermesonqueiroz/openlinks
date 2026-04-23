<?php

namespace App\Services;

use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Renderer\Color\Rgb;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\EyeFill;
use BaconQrCode\Renderer\RendererStyle\Fill;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Support\HtmlString;
use Imagick;

final readonly class QrCode
{
    public Rgb $backgroundColor;
    public Rgb $foregroundColor;

    public function __construct()
    {
        $this->backgroundColor = new Rgb(13, 18, 21);
        $this->foregroundColor = new Rgb(243, 250, 255);
    }

    public function generate(string $content): HtmlString
    {
        $qrCodeBinary = (new Writer(
            renderer: new ImageRenderer(
                rendererStyle: new RendererStyle(
                    size: 1024,
                    margin: 2,
                    fill: Fill::withForegroundColor($this->foregroundColor, $this->backgroundColor, EyeFill::inherit(), EyeFill::inherit(), EyeFill::inherit())
                ),
                imageBackEnd: new ImagickImageBackEnd()
            )
        ))->writeString(
            content: $content,
            ecLevel: ErrorCorrectionLevel::M()
        );

        $qrCodeImage = new Imagick();
        $qrCodeImage->readImageBlob($qrCodeBinary);
        $qrCodeImage->stripImage();

        return new HtmlString($qrCodeImage->getImageBlob());
    }
}

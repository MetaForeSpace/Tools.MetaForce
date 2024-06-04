<?php

namespace App\Http\Controllers;

use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function generateQrCode(string $url = null)
    {
        $str = request()->get('str');
        $url = $str ?? $url ?? 'https://meta-force.space';
        $logoPath = public_path('logo.png');

        try {
            $qrcode = QrCode::encoding('UTF-8')
                ->format('png')
                ->size(300)
                ->color(255, 255, 255)
//                ->style('round')
                ->errorCorrection('H')
//                ->merge($logoPath, .3, true)
                ->backgroundColor(0, 0, 0, 0)
                ->generate($url);

            // Создание изображения QR-кода
            $qrImage = imagecreatefromstring($qrcode);

            // Установка прозрачного фона для QR-кода
            $width = imagesx($qrImage);
            $height = imagesy($qrImage);
            $transparentImage = imagecreatetruecolor($width, $height);
            imagesavealpha($transparentImage, true);
            $transparency = imagecolorallocatealpha($transparentImage, 0, 0, 0, 127);
            imagefill($transparentImage, 0, 0, $transparency);
            imagecopy($transparentImage, $qrImage, 0, 0, 0, 0, $width, $height);
            imagedestroy($qrImage);
            $qrImage = $transparentImage;

            // Добавление логотипа
            if (!file_exists($logoPath)) {
                return response()->json(['error' => 'Logo file not found.'], 404);
            }

            // Создание изображения логотипа
            $logoImage = imagecreatefrompng($logoPath);

            // Получение размеров изображений
            $qrWidth = imagesx($qrImage);
            $qrHeight = imagesy($qrImage);
            $logoWidth = imagesx($logoImage);
            $logoHeight = imagesy($logoImage);

            // Расчет координат для размещения логотипа по центру
            $logoX = ($qrWidth - $logoWidth) / 2;
            $logoY = ($qrHeight - $logoHeight) / 2;

            // Наложение логотипа на QR-код
            imagecopy($qrImage, $logoImage, $logoX, $logoY, 0, 0, $logoWidth, $logoHeight);

            // Начало буферизации вывода
            ob_start();
            imagepng($qrImage);
            $imageData = ob_get_contents();
            ob_end_clean();

            // Освобождение памяти
            imagedestroy($qrImage);
            imagedestroy($logoImage);

            // Возврат изображения в формате PNG в ответе
            return response($imageData)->header('Content-Type', 'image/png');


        } catch (Exception $e) {
            return $e->getMessage();
        }

        //return response($qrcode)->header('Content-Type', 'image/png');
    }
}

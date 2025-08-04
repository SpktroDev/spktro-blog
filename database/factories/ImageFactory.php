<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Esta es una pocion si es que elmetodo faker falla en la creacion de las imagenes
        // Nombre único para la imagen
        $filename = 'posts/' . uniqid() . '.jpg';
        $path = storage_path('app/public/' . $filename);

        // Crear imagen 640x480
        $image = imagecreatetruecolor(640, 480);

        // Color de fondo aleatorio
        $bg = imagecolorallocate($image, rand(100, 200), rand(100, 200), rand(200, 255));
        imagefill($image, 0, 0, $bg);

        // Color del texto (negro)
        $textColor = imagecolorallocate($image, 0, 0, 0);

        // Texto generado con faker
        $text = $this->faker->words(2, true);

        // Ruta a la fuente TTF
        $fontPath = resource_path('fonts/Ruritania.ttf');

        // Tamaño de fuente
        $fontSize = 48;

        // Calcular tamaño de texto
        $bbox = imagettfbbox($fontSize, 0, $fontPath, $text);
        $textWidth = $bbox[2] - $bbox[0];
        $textHeight = $bbox[1] - $bbox[7];

        // Coordenadas para centrar texto
        $x = (imagesx($image) - $textWidth) / 2;
        $y = (imagesy($image) + $textHeight) / 2;

        // Escribir texto en la imagen
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $fontPath, $text);

        // Guardar imagen en disco
        imagejpeg($image, $path);

        // Liberar memoria
        imagedestroy($image);

        return [
            'url' => $filename //'posts/' . $this->faker->image('public/storage/posts', 640, 480, null, false)
        ];
    }
}

<?php

namespace App\Services;

class ImageService
{
    public static function storeImages(
        array|object $images,
        string $pathToStore,
        string|int $propertyKey = 'propertyKey',
        string|int $propertyValue = null
    ): array {
        // É apenas uma imagem (objeto de uma imagem 'upada')?
        if (is_object($images)) {
            // self::worksWithImage($images, $pathToStore);
        }

        // Temos uma array de imagens
        $uploadedImages = [];

        foreach ($images['images'] as $image) {
            $uploadedImages[] = [
                $propertyKey => $propertyValue,
                'image'      => self::worksWithImage($image, $pathToStore)
            ];
        }

        return $uploadedImages;
    }


    /**
     * Retorna as imagens relacionadas ao anúncio
     *
     * @param string $imagePath
     * @param string $image
     * @param string $sizeImage
     * @return void
     */
    public static function showImage(string $imagePath, string $image, string $sizeImage = 'regular')
    {
        if ($sizeImage == 'small') {
            $imagePath = WRITEPATH . "uploads/$imagePath/small/$image";
        } else {
            $imagePath = WRITEPATH . "uploads/$imagePath/$image";
        }

        $fileInfo = new \finfo(FILEINFO_MIME);

        $fileType = $fileInfo->file($imagePath);

        header("Content-Type: $fileType");

        header("Content-Length: " . filesize($imagePath));

        readfile($imagePath);

        exit;
    }


    /**
     * Deleta a imagem do diretorio Uploads
     *
     * @param string $pathToImage
     * @param string $imageToDestroy
     * @return void
     */
    public static function destroyImage(string $pathToImage, string $imageToDestroy)
    {
        $regularImageToDestroy  = WRITEPATH . "uploads/{$pathToImage}/{$imageToDestroy}";
        $smallImageToDestroy    = WRITEPATH . "uploads/{$pathToImage}/small/{$imageToDestroy}";

        if (is_file($regularImageToDestroy)) {

            unlink($regularImageToDestroy);
        }

        if (is_file($smallImageToDestroy)) {
            unlink($smallImageToDestroy);
        }
    }


    /**
     * Constroi o store da Imagem
     *
     * @param object $image
     * @param string $pathToStore
     * @return string
     */
    private static function worksWithImage(object $image, string $pathToStore): string
    {
        // Nesse ponto armazenamos a imagem no caminho informado.
        $imagePath = $image->store($pathToStore);

        // Fullpath de onde foi armazenado o arquivo
        $imagePath = WRITEPATH . "uploads/$imagePath";

        $imageSmallPath = WRITEPATH . "uploads/$pathToStore/small/";

        // Existe o diretório contido na variável $imageSmallPath?
        if (!is_dir($imageSmallPath)) {
            // Não existe. Então podemos criá-lo
            mkdir($imageSmallPath);
        }

        // Manulamos a imagem para criamos uma cópia um pouco menor que a original
        service('image')
            ->withFile($imagePath) // arquivo original
            ->resize(275, 275, true, 'center')
            ->save($imageSmallPath . $image->getName());


        return $image->getName();
    }
}

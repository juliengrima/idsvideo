<?php

namespace AppBundle\Services;

use AppBundle\Entity\Media;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ffmpeg_movie;

class mediaInterface extends Controller
{
	protected $container;

	public function __construct(Container $container) {
		$this->container = $container;

	}

// Uploads a media
	public function mediaUpload(Media $media)
	{
		$file = $media->getFile();
		if ($media->getPath() != null) {	// Si le média contenait déjà un fichier uploadé
			$tmp = explode('/', $media->getPath());
			$filename = end($tmp);    // On récupère le nom du fichier ({{media.name}}.extension

			// On supprime ce fichier de la mémoire
            if (file_exists ($filename)){
                unlink($this->container->getParameter('medias_directory') . '/' . $filename);
                $media->setPath(null);
            }

		}
		// Puis on upload le nouveau fichier
		$extension = $file->guessExtension();

        require '../../../vendor/autoload.php';

        $ffmpeg = FFMpeg\FFMpeg::create();
        $video = $ffmpeg->open($file);
        $video
            ->filters()
            ->resize(new FFMpeg\Coordinate\Dimension(400, 222))
            ->synchronize();
//        $video
//            ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(10))
//            ->save('frame.jpg');
        $video
            ->save(new FFMpeg\Format\Video\X264(), 'export-x264.mp4');

		$video->move($this->container->getParameter('medias_directory'), $media->getName().'.'.$extension);
		$media->setPath('assets/videos/'.$media->getName().'.'.$extension);
	}
}
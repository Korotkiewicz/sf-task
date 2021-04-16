<?php

namespace App\Controller;

use App\Service\FileFactoryInterface;
use App\Service\FileReaderInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/health", name="health", methods={"GET"})
     */
    public function health(): Response
    {
        return new Response('No content', Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route(
     *      "/file/{fileName}.{_format}", 
     *      name="file", 
     *      methods={"GET"}, 
     *      requirements={
     *         "_format": "txt|json",
     *     })
     */
    public function getFile(Request $request, FileFactoryInterface $factory, FileReaderInterface $reader, LoggerInterface $logger): Response
    {
        $fileName = $request->get('fileName') . '.' . $request->getRequestFormat();
        
        try {
            $factory->createIfNotExist($fileName);
            $file = $reader->getFile($fileName);

            return $this->file($file);
        } catch (\Exception $e) {
            $logger->error($e->getMessage());
            
            return new Response('Cannot retrive file ' . $fileName, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

<?php

namespace App\Controller;


use App\Entity\Branche;
use App\Entity\Course;
use App\Entity\Video;
use App\Form\VideoType;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    #[Route('/', name: 'home')]
    public function Home() {
        return $this->render('home/home.html.twig',

        );

    }

    //Insert actie voor videos
    #[Route('/addvideo', name: 'add-video')]
    public function showInsert(Request $request, EntityManagerInterface $em): Response
    {
        $video = $em->getRepository(Video::class)->findAll();
        $add = new Video();
        $form = $this->createForm(VideoType::class, $add);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form['filename']->getData();

            $destination = $this->getParameter('kernel.project_dir').'/public/uploads';

            $originalFileName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            $newFileName = $originalFileName.'-'. uniqid().'.'.$uploadedFile->guessExtension();

            $uploadedFile->move(
                $destination,
                $newFileName
            );

            $add->setFilename($newFileName);

            $em->persist($add);
            $em->flush();

            $this->addFlash(
                'success',
                'Het item is toegevoegd'
            );

            return $this->redirectToRoute('showVideos2');
        }

        return $this->renderForm('home/index.html.twig', [
            'form' => $form,
            'video'=> $video,
        ]);
    }



//Delete statement voor video
    #[Route('/delete/{id}', name: 'delete')]
    public function delete(VideoRepository $videoRepository, Video $video, EntityManagerInterface $em): Response
    {
        // Het pad naar de uploadmap ophalen
        $uploadDirectory = $this->getParameter('kernel.project_dir').'/public/uploads/';

        // Het bestand verwijderen
        $filename = $video->getFilename();
        $filePath = $uploadDirectory . $filename;
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Het video-object verwijderen uit de database
        $em->remove($video);
        $em->flush();

        $videos = $videoRepository->findAll();
        $this->addFlash('danger', 'Uw video is verwijderd');
        return $this->render('home/delete.html.twig', [
            'files' => $videos
        ]);
    }


    //Met deze functie OnlyVideo toont die de video zonder twig template te gebruiken op het moment
    #[Route('/Show1video/{id}', name: 'OnlyVideo')]
    public function OnlyVideo(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $video = $entityManager->getRepository(Video::class)->find($id);

        if (!$video) {
            throw $this->createNotFoundException('Video not found');
        }

//        // Assume Video entity has a method to get the file path, adjust accordingly
//        $videoPath = $this->getParameter('kernel.project_dir') . '/public/uploads/' . $video->getFilename();
//
//        // Create a BinaryFileResponse to serve the video
//        $response = new BinaryFileResponse($videoPath);
//        $response->headers->set('Content-Type', 'video/mp4');

        return $this->render('home/show.html.twig', [
            'video' => $video,
        ]);
    }

    //Met functie showVideos3 poging om video te laten zien op twig pagina doet nu niks
    #[Route('/videos3', name: 'showVideos3')]
    public function showVideos3(Request $request, EntityManagerInterface $entityManager, int $course_id): Response
    {
        $videos = $entityManager->getRepository(Video::class)->findBy(['course' => $course_id]);

        return $this->render('home/show.html.twig', [
            'videos' => $videos,
        ]);
    }

    //Hier laat die alle videos in een list zien en kan verwijderen
    #[Route('/videos2', name: 'showVideos2')]
    public function showVideos2(Request $request, EntityManagerInterface $entityManager): Response
    {
        $objects = $entityManager->getRepository(Video::class)->findAll();

        return $this->render('home/delete.html.twig', [
            'files' => $objects
        ]);
    }



    #[Route('/videos', name: 'showVideos')]
    public function showVideos(Request $request, EntityManagerInterface $entityManager): Response
    {
        $objects = $entityManager->getRepository(Video::class)->findAll();

        return $this->render('home/select.html.twig', [
            'files' => $objects
        ]);
    }

    //Alle Branches worden getoont
    #[Route('/branches', name: 'branches')]
    public function branches(Request $request, EntityManagerInterface $entityManager): Response
    {
        $objects = $entityManager->getRepository(Branche::class)->findAll();

        return $this->render('home/branches.html.twig', [
            'branches' => $objects
        ]);
    }



    //Alle Courses worden getoond bij de behoorde Branches
    #[Route('/courses/{id}', name: 'courses')]
    public function courses(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {

        $branch = $entityManager->getRepository(Branche::class)->find($id);

        return $this->render('home/courses.html.twig', [
            'branch' => $branch
        ]);
    }


}

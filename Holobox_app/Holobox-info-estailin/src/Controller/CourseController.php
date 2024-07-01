<?php

namespace App\Controller;

use App\Entity\Course;
use App\Form\CourseType;
use App\Repository\CourseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CourseController extends AbstractController
{
    #[Route('/course', name: 'course')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        $objects = $entityManager->getRepository(Course::class)->findAll();
        return $this->render('course/index.html.twig', [
            'courses' => $objects,
            'none' => "none",
        ]);
    }

    #[Route('/OnlyCourse/{id}', name: 'OnlyCourse')]
    public function onlyBranche(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {

        $objects = $entityManager->getRepository(Course::class)->find($id);
        return $this->render('course/img.html.twig', [
            'courses' => $objects,
        ]);
    }

    #[Route('/course-delete/{id}', name: 'course_delete')]
    public function delete(Course $course, CourseRepository $courseRepository): Response
    {
        // Het pad naar de uploadmap ophalen
        $uploadDirectory = $this->getParameter('kernel.project_dir').'/public/img_course/';

        // Het bestand verwijderen
        $filename = $course ->getImg();
        $filePath = $uploadDirectory . $filename;
        if (file_exists($filePath)) {
            unlink($filePath);
        }


        $courseRepository->remove($course);

        $course = $courseRepository->findAll();
        $this->addFlash('danger', 'Uw course is verwijderd');
        return $this->render('course/index.html.twig', [
            'courses' => $course,
        ]);
    }


    #[Route('/addcourse', name: 'add-course')]
    public function showInsert(Request $request, EntityManagerInterface $em): Response
    {
        $video = $em->getRepository(Course::class)->findAll();
        $add = new Course();
        $form = $this->createForm(CourseType::class, $add);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form['img']->getData();

            $destination = $this->getParameter('kernel.project_dir') . '/public/img_course';

            $originalFileName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            $newImg = $originalFileName . '-' . uniqid() . '.' . $uploadedFile->guessExtension();

            $uploadedFile->move(
                $destination,
                $newImg
            );

            $add->setImg($newImg);

            $em->persist($add);
            $em->flush();

            $this->addFlash(
                'success',
                'Het item is toegevoegd'
            );

            return $this->redirectToRoute('course');
        }

        return $this->renderForm('home/index.html.twig', [
            'form' => $form,
            'video' => $video,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Branche;
use App\Form\BrancheType;
use App\Repository\BrancheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BrancheController extends AbstractController
{
    #[Route('/branche', name: 'branche')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        $objects = $entityManager->getRepository(branche::class)->findAll();
        return $this->render('branche/index.html.twig', [
            'branches' => $objects,
        ]);
    }

    #[Route('/OnlyBranche/{id}', name: 'OnlyBranche')]
    public function onlyBranche(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {

        $objects = $entityManager->getRepository(Branche::class)->find($id);
        return $this->render('branche/img.html.twig', [
            'branches' => $objects,
        ]);
    }

    #[Route('/branche-delete/{id}', name: 'branche_delete')]
    public function delete(Branche $branche, BrancheRepository $brancheRepository): Response
    {
        // Het pad naar de uploadmap ophalen
        $uploadDirectory = $this->getParameter('kernel.project_dir').'/public/img_branche/';

        // Het bestand verwijderen
        $filename = $branche->getImg();
        $filePath = $uploadDirectory . $filename;
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $brancheRepository->remove($branche);

        $branche = $brancheRepository->findAll();
        $this->addFlash('danger', 'Uw branche is verwijderd');
        return $this->render('branche/index.html.twig', [
            'branches' => $branche,
        ]);
    }

    #[Route('/addbranche', name: 'add-branche')]
    public function showInsert(Request $request, EntityManagerInterface $em): Response
    {
        $video = $em->getRepository(Branche::class)->findAll();
        $add = new Branche();
        $form = $this->createForm(BrancheType::class, $add);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form['img']->getData();

            $destination = $this->getParameter('kernel.project_dir') . '/public/img_branche';

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

            return $this->redirectToRoute('branche');
        }

        return $this->renderForm('home/index.html.twig', [
            'form' => $form,
            'video' => $video,
        ]);
    }
}



<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Entity\User;
use App\Form\CandidateType;
use App\Repository\CandidateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/candidate')]
class CandidateController extends AbstractController
{



   

    #[Route('/edit', name: 'app_candidate_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request,UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $candidate = $user->getCandidate();
              
        $form = $this->createForm(CandidateType::class, $candidate);
        $form->handleRequest($request);
      
        if ($form->isSubmitted() && $form->isValid()) {
            $fileImage = $form->get('profil_picture')->getData();
            $fileCv = $form->get('cv')->getData();
           if($fileImage != null){
            $filename = $candidate->getId() . '.' . $fileImage->getClientOriginalExtension();
            $fileImage->move($this->getParameter('kernel.project_dir') . '/public/upload/image', $filename);
            $candidate->setProfilPicture($filename);
           }
           if($fileCv != null){
            
            $filenameCv = $candidate->getId() . '.' . $fileCv->getClientOriginalExtension();
            $fileCv->move($this->getParameter('kernel.project_dir') . '/public/upload/cv', $filenameCv);
            $candidate->setProfilPicture($filenameCv);
           }
            if($form->get('password')->getData() != null){
                $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            }
            
            $entityManager->flush();

            return $this->redirectToRoute('app_candidate_edit', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('candidate/edit.html.twig', [
            'candidate' => $candidate,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_candidate_delete', methods: ['POST'])]
    public function delete(Request $request, Candidate $candidate, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidate->getId(), $request->request->get('_token'))) {
            $entityManager->remove($candidate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_candidate_index', [], Response::HTTP_SEE_OTHER);
    }
}

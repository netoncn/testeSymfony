<?php

namespace App\Controller;

use App\Entity\Tecnicos;
use App\Form\TecnicosType;
use App\Repository\TecnicosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tecnicos")
 */
class TecnicosController extends AbstractController
{
    /**
     * @Route("/", name="tecnicos_index", methods={"GET"})
     */
    public function index(TecnicosRepository $tecnicosRepository): Response
    {
        return $this->render('tecnicos/index.html.twig', [
            'tecnicos' => $tecnicosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="tecnicos_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tecnico = new Tecnicos();
        $tecnicosRepository = $this->getDoctrine()->getRepository(Tecnicos::class);
        $form = $this->createForm(TecnicosType::class, $tecnico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $valid = $tecnicosRepository->validaForm($request->request->get('tecnicos'));

            if($valid === true){
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($tecnico);
                $entityManager->flush();
                return $this->redirectToRoute('tecnicos_index');
            } else{
                return $this->render('tecnicos/new.html.twig', [
                    'tecnico' => $tecnico,
                    'form' => $form->createView(),
                    'erro' => $valid,
                ]);
            } 
        }

        return $this->render('tecnicos/new.html.twig', [
            'tecnico' => $tecnico,
            'form' => $form->createView(),
            'erro' => false,
        ]);
    }

    /**
     * @Route("/{id}", name="tecnicos_show", methods={"GET"})
     */
    public function show(Tecnicos $tecnico): Response
    {
        return $this->render('tecnicos/show.html.twig', [
            'tecnico' => $tecnico,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tecnicos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tecnicos $tecnico): Response
    {
        $form = $this->createForm(TecnicosType::class, $tecnico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tecnicos_index', [
                'id' => $tecnico->getId(),
            ]);
        }

        return $this->render('tecnicos/edit.html.twig', [
            'tecnico' => $tecnico,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tecnicos_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Tecnicos $tecnico): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tecnico->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tecnico);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tecnicos_index');
    }
}

<?php

namespace App\Controller;

use App\Entity\Ferramentas;
use App\Form\FerramentasType;
use App\Repository\FerramentasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ferramentas")
 */
class FerramentasController extends AbstractController
{
    /**
     * @Route("/", name="ferramentas_index", methods={"GET"})
     */
    public function index(FerramentasRepository $ferramentasRepository): Response
    {
        return $this->render('ferramentas/index.html.twig', [
            'ferramentas' => $ferramentasRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ferramentas_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ferramenta = new Ferramentas();
        $ferramentasRepository = $this->getDoctrine()->getRepository(Ferramentas::class);
        $form = $this->createForm(FerramentasType::class, $ferramenta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $ferramenta = $ferramentasRepository->prepareForm($request->request->get('ferramentas'),$ferramenta);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ferramenta);
            $entityManager->flush();

            return $this->redirectToRoute('ferramentas_index');
        }

        return $this->render('ferramentas/new.html.twig', [
            'ferramenta' => $ferramenta,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ferramentas_show", methods={"GET"})
     */
    public function show(Ferramentas $ferramenta): Response
    {
        return $this->render('ferramentas/show.html.twig', [
            'ferramenta' => $ferramenta,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ferramentas_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ferramentas $ferramenta): Response
    {
        $form = $this->createForm(FerramentasType::class, $ferramenta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ferramentas_index', [
                'id' => $ferramenta->getId(),
            ]);
        }

        return $this->render('ferramentas/edit.html.twig', [
            'ferramenta' => $ferramenta,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ferramentas_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ferramentas $ferramenta): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ferramenta->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ferramenta);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ferramentas_index');
    }
}

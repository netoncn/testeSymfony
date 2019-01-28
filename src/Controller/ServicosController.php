<?php

namespace App\Controller;

use App\Entity\Servicos;
use App\Form\ServicosType;
use App\Repository\ServicosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/servicos")
 */
class ServicosController extends AbstractController
{
    /**
     * @Route("/", name="servicos_index", methods={"GET"})
     */
    public function index(ServicosRepository $servicosRepository): Response
    {
        return $this->render('servicos/index.html.twig', [
            'servicos' => $servicosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="servicos_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $servico = new Servicos();
        $servicosRepository = $this->getDoctrine()->getRepository(Servicos::class);
        $form = $this->createForm(ServicosType::class, $servico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $valid = $servicosRepository->validaForm($request->request->get('servicos'));

            if($valid === true){
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($servico);
                $entityManager->flush();
                return $this->redirectToRoute('servicos_index');
            } else{
                return $this->render('servicos/new.html.twig', [
                    'servico' => $servico,
                    'form' => $form->createView(),
                    'erro' => $valid,
                ]);
            }

            
        }

        return $this->render('servicos/new.html.twig', [
            'servico' => $servico,
            'form' => $form->createView(),
            'erro' => false,
        ]);
    }

    /**
     * @Route("/{id}", name="servicos_show", methods={"GET"})
     */
    public function show(Servicos $servico): Response
    {
        return $this->render('servicos/show.html.twig', [
            'servico' => $servico,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="servicos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Servicos $servico): Response
    {
        $form = $this->createForm(ServicosType::class, $servico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('servicos_index', [
                'id' => $servico->getId(),
            ]);
        }

        return $this->render('servicos/edit.html.twig', [
            'servico' => $servico,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="servicos_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Servicos $servico): Response
    {
        if ($this->isCsrfTokenValid('delete'.$servico->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($servico);
            $entityManager->flush();
        }

        return $this->redirectToRoute('servicos_index');
    }
}

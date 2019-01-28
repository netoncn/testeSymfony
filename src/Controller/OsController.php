<?php

namespace App\Controller;

use App\Entity\Os;
use App\Form\OsType;
use App\Repository\OsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/os")
 */
class OsController extends AbstractController
{
    /**
     * @Route("/", name="os_index", methods={"GET"})
     */
    public function index(OsRepository $osRepository): Response
    {
        return $this->render('os/index.html.twig', [
            'os' => $osRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="os_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $o = new Os();
        $osRepository = $this->getDoctrine()->getRepository(Os::class);
        $form = $this->createForm(OsType::class, $o);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $o = $osRepository->prepareForm($request->request->get('os'),$o);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($o);
            $entityManager->flush();

            return $this->redirectToRoute('os_index');
        }

        return $this->render('os/new.html.twig', [
            'o' => $o,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="os_show", methods={"GET"})
     */
    public function show(Os $o): Response
    {
        return $this->render('os/show.html.twig', [
            'o' => $o,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="os_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Os $o): Response
    {
        $form = $this->createForm(OsType::class, $o);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('os_index', [
                'id' => $o->getId(),
            ]);
        }

        return $this->render('os/edit.html.twig', [
            'o' => $o,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="os_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Os $o): Response
    {
        if ($this->isCsrfTokenValid('delete'.$o->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($o);
            $entityManager->flush();
        }

        return $this->redirectToRoute('os_index');
    }
}

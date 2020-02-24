<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use AppBundle\Form\AddressBookEntry;
use AppBundle\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddressBookController extends Controller
{
    /**
     * @var FileUploader
     */
    private $fileUploader;

    /**
     * AddressBookController constructor.
     * @param FileUploader $fileUploader
     */
    public function __construct(FileUploader $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function listAction()
    {
        $addresses = $this->getDoctrine()->getRepository(Address::class)->findAll();
        return $this->render('address-book/index.html.twig', ['addresses' => $addresses]);
    }

    /**
     * @Route("/address/create", name="createAddress")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(AddressBookEntry::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->processRequest($form);

            $this->addFlash('success', 'Address created!');
            return $this->redirect('/');
        }

        return $this->render('address-book/create.html.twig', ['addressEntry' => $form->createView()]);
    }

    /**
     * @Route("/address/{id}", name="showAddress")
     * @param Address $address
     * @return Response
     */
    public function show(Address $address)
    {
        // display a single address
        return $this->render('address-book/show.html.twig', ['address' => $address]);
    }

    /**
     * @Route("/address/{id}/edit", name="editAddress")
     * @param Request $request
     * @param Address $address
     * @return Response
     */
    public function edit(Request $request, Address $address)
    {
        $form = $this->createForm(AddressBookEntry::class, $address);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $this->processRequest($form);

            $this->addFlash('success', 'Address updated!');
            return $this->redirect('/');
        }
        return $this->render('address-book/edit.html.twig', ['addressEntry' => $form->createView()]);
    }

    /**
     * @Route("/address/delete/{id}", name="deleteAddress")
     * @param Address $address
     * @return RedirectResponse
     */
    public function destroy(Address $address)
    {
        // deletes an address from the database
        $em = $this->getDoctrine()->getManager();
        $em->remove($address);
        $em->flush();
        $this->addFlash('success', 'Address Deleted!');
        return $this->redirect("/");
    }

    /**
     * @param FormInterface $form
     */
    private function processRequest(FormInterface $form): void
    {
        $file = $form['photo']->getData();
        $newFileName = '';
        if ($file) {
            $newFileName = $this->fileUploader->upload($file);
        }

        $address = $form->getData();
        if ($newFileName !== '') {
            $address->setPhoto($newFileName);
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($address);
        $em->flush();
    }
}

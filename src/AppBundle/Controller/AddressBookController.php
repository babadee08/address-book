<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use AppBundle\Form\AddressBookEntry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddressBookController extends Controller
{
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
            // dump($form->getData());die;
            $file =  $form['photo']->getData();
            $newFileName = '';
            if ($file) {
                $actualFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $actualFileName);
                $newFileName = $safeFileName.'-'.uniqid().'.'.$file->guessExtension();
                try {
                    $file->move($this->getParameter('images_directory'), $newFileName);
                } catch (FileException $ex) {

                }
            }
            $address = $form->getData();
            if ($newFileName !== '') {
                $address->setPhoto($newFileName);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();

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

        if ($form->isSubmitted() && $form->isValid()) {

            $file =  $form['photo']->getData();
            $newFileName = '';
            if ($file) {
                $actualFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $actualFileName);
                $newFileName = $safeFileName.'-'.uniqid().'.'.$file->guessExtension();
                try {
                    $file->move($this->getParameter('images_directory'), $newFileName);
                } catch (FileException $ex) {

                }
            }

            $address = $form->getData();
            if ($newFileName !== '') {
                $address->setPhoto($newFileName);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();

            $this->addFlash('success', 'Address updated!');
        }
        return $this->render('address-book/edit.html.twig', ['addressEntry' => $form->createView()]);
    }

    /**
     * @Route("/address/delete/{id}", name="deleteAddress")
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        // deletes an address from the database
        return $this->redirect("/");
    }
}

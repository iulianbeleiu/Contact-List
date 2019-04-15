<?php
/**
 * Created by PhpStorm.
 * User: iulianbeleiu
 * Date: 2019-04-14
 * Time: 19:55
 */

namespace AppBundle\Controller;


use AppBundle\Form\ContactType;
use AppBundle\Services\FileUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Contact;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class ContactController extends Controller
{
    /**
     * @Route("/contacts", name="contact_list")
     */
    public function contactListAction()
    {
        $contacts = $this->getDoctrine()
            ->getRepository(Contact::class)
            ->findAll();

        return $this->render('contact/list.html.twig', [
            'contacts' => $contacts
        ]);
    }

    /**
     * @Route("/contact/edit/{id}", name="contact_edit")
     * @param Request $request
     * @param Contact $contact
     * @return Response
     */
    public function contactEditAction(Request $request, Contact $contact = null, FileUploader $fileUploader)
    {
        if (!$contact) {
            throw $this->createNotFoundException('Contact not found.');
        }

        $picturePath = null;
        if (!is_null($contact->getPicture())) {
            $contact->setPicture(
                new File($contact->getPicture())
            );

            $picturePath = $contact->getPicture();
        }

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            /** @var UploadedFile $picture */
            $picture = $contact->getPicture();
            $pictureName = $fileUploader->uploadFile($picture);

            $contact->setPicture($pictureName);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('contact_list');
        }

        return $this->render('contact/add.html.twig', [
            'contactForm' => $form->createView(),
            'picturePath' => $picturePath
        ]);
    }

    /**
     * @Route("/contact/add", name="contact_add")
     * @param Request $request
     * @return Response
     */
    public function contactAddAction(Request $request, FileUploader $fileUploader)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $picture = $contact->getPicture();
            $pictureName = $fileUploader->uploadFile($picture);

            $contact->setPicture($pictureName);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('contact_list');
        }

        return $this->render('contact/add.html.twig', [
            'contactForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/contact/delete/{id}", name="contact_delete")
     */
    public function contactDeleteAction(Contact $contact = null)
    {
        $entityManager = $this->getDoctrine()->getManager();

        if (!$contact) {
            throw $this->createNotFoundException('Contact not found.');
        }

        $entityManager->remove($contact);
        $entityManager->flush();

        return $this->redirectToRoute('contact_list');
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
}
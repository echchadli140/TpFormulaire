<?php

namespace App\Controller;

use App\Form\AddToCartType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ProductType extends AbstractController
{
    #[Route('/product', name:'product_show')]
        public function show(Request $request): Response
    {

        $product = [
            'name' => 'Premium Wireless Headphones',
            'price' => 129.99,
            'description' => 'Experience superior sound quality with our premium wireless headphones.',
            'brand' => 'AudioTech',
            'battery' => '30 hours',
            'connectivity' => 'Bluetooth 5.0',
            'image' => 'https://images.pexels.com/photos/90946/pexels-photo-90946.jpeg?auto=compress&cs=tinysrgb&w=800',
        ];


        $form = $this->createForm(AddToCartType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->addFlash('success', 'Produit ajouté au panier : ' . $data['quantity'] . ' x ' . $data['color']);
        }

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }
}

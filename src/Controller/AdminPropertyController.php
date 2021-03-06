<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Property;
use  Symfony\Component\Routing\Annotation\Route;
class AdminPropertyController extends AbstractController
{
	
	/**
	 * @var PropertyRepository
	 */
	private  $repository;
	public function __construct(PropertyRepository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * @Route("/admin",name="admin.property.index")
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function index()
	{
		$properties = $this->repository->findAll();
		return  $this->render('admin/property/index.html',compact("properties"));
	}

	/**
	 * @Route("/admin/{id}",name="admin.property.edit")
	 * @param Property $property
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function edit(Property $property)
	{
		return $this->render('admin/property/edit.html.twig',compact('property'));
	}

}
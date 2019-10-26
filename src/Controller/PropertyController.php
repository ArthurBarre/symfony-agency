<?php
namespace App\Controller;

use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Property;

class PropertyController extends AbstractController {
	/**
	 * @var PropertyRepository
	 */
	private $repository;
	/**
	 * @var ObjectManager
	 */
	private $em;

	public function  __construct(PropertyRepository $repository, ObjectManager $em)
	{
		$this->repository = $repository;
		$this->em = $em;
	}
	/**
	 * @Route("/biens",name="property.index")
	 * @return Response
	 */
		public function index():Response{
			// $property = new Property();
			// $property->setTitle("titre 2")
			// ->setRooms('2')
			// ->setBedrooms('4')
			// ->setDescription('this is a new desc')
			// ->setHeat(1)
			// ->setSurface(45)
			// ->setPrice(20)
			// ->setCity('Paris')
			// ->setPostalCode('75019');
			// $em = $this->getDoctrine()->getManager();
			// $em->persist($property);
			// $em->flush();
				return $this->render('property/index.html.twig',[
					'current_menu' => 'properties'
				]);
	}
	/**
	 * @Route("/biens/{slug}-{id}",name="property.show",requirements={"slug":"[a-z0-9\-]*"})
	 * @return Response
	 */
	public function show(Property $property,string $slug):Response{
		if($property->getSlug() !== $slug){
			return $this->redirectToRoute('property.show',[
				'id'=>$property->getId(),
				'slug'=>$property->getSlug(),
			],301);
		}
		return $this->render('property/show.html.twig',[
			'property'=>$property,
			'current_menu' => 'properties'
		]);
	}
}
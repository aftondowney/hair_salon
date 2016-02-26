<?php

		require_once __DIR__.'/../vendor/autoload.php';
		require_once __DIR__.'/../src/Stylist.php';
		require_once __DIR__.'/../src/Client.php';
		// use Symfony\Component\Debug\Debug;
		//     Debug::enable();

		$server = 'mysql:host=localhost;dbname=hair_salon';
		$username = 'root';
		$password = 'root';
		$DB = new PDO($server, $username, $password);

		$app = new Silex\Application();
		// $app['debug'] = true;

		$app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

		use Symfony\Component\HttpFoundation\Request;
		Request::enableHttpMethodParameterOverride();

		// Home page showing cuisines
		$app->get("/", function() use ($app)
		{
				return $app['twig']->render('home.html.twig', array('cuisines' => Stylist::getAll(), 'form' => false));
		});

		$app->post("/cuisines", function() use ($app)
		{
				$cuisine = new Stylist ($_POST['type']);
				$cuisine->save();
				return $app['twig']->render('home.html.twig', array('cuisines' => Stylist::getAll()));
		});

		$app->get("/cuisines/{id}/edit_form", function($id) use ($app)
		{
				$current_cuisine = Stylist::find($id);
				$cuisines = Stylist::getAll();
				return $app['twig']->render('home.html.twig', array('current_cuisine' => $current_cuisine, 'cuisines' => $cuisines, 'form' => true));
		});

		$app->patch("/cuisines/updated", function() use ($app)
		{
				$cuisine_to_edit = Stylist::find($_POST['current_cuisineId']);
				$cuisine_to_edit->update($_POST['type']);
				return $app['twig']->render('home.html.twig', array('cuisines' => Stylist::getAll()));
		});

		$app->delete("/cuisines/{id}/delete", function($id) use ($app)
		{
				$cuisine = Stylist::find($id);
				$cuisine->delete();
				return $app['twig']->render('home.html.twig', array('cuisines' => Stylist::getAll(), 'form' => false));
		});

		// Specific cuisine pages (show restaurants)
		$app->get("/cuisine/{id}", function($id) use ($app)
		{
				$cuisine = Stylist::find($id);
				return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getClients(), 'form' => false));
		});

		$app->post("/restaurants", function() use ($app)
		{
				$restaurant = new Client($_POST['name'], $_POST['address'], $_POST['cuisine_id'], $_POST['description']);
				$restaurant->save();
				$cuisine = Stylist::find($_POST['cuisine_id']);
				return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getClients()));
		});

		$app->get("/restaurant/{cid}/{rid}/edit_form", function($cid, $rid) use ($app)
		{
				$current_restaurant = Client::find($rid);
				$cuisine = Stylist::find($cid);
				return $app['twig']->render('cuisine.html.twig', array('current_restaurant' => $current_restaurant, 'cuisine' => $cuisine, 'restaurants' => $cuisine->getClients(), 'form' => true));
		});

		$app->patch("/restaurants/updated", function() use ($app)
		{
				$restaurant_to_edit = Client::find($_POST['current_restaurantId']);
				$restaurant_to_edit->update($_POST['name']);
				$cuisine = Stylist::find($_POST['cuisine_id']);
				return $app['twig']->render('cuisine.html.twig', array('restaurants' => $cuisine->getClients(), 'cuisine' => $cuisine));
		});

		$app->delete("/restaurants/{cuisine_id}/{restaurant_id}/delete", function($cuisine_id, $restaurant_id) use ($app)
		{
				$restaurant = Client::find($restaurant_id);
				$restaurant->delete();
				$cuisine = Stylist::find($cuisine_id);
				return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getClients()));
		});

		return $app;
?>

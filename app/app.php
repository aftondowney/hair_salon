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

		// Home page showing stylists
		$app->get("/", function() use ($app)
		{
				return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll(), 'form' => false));
		});

		$app->post("/stylists", function() use ($app)
		{
				$stylist = new Stylist ($_POST['name']);
				$stylist->save();
				return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
		});

		$app->get("/stylists/{id}/edit_form", function($id) use ($app)
		{
				$current_stylist = Stylist::find($id);
				$stylists = Stylist::getAll();
				return $app['twig']->render('index.html.twig', array('current_stylist' => $current_stylist, 'stylists' => $stylists, 'form' => true));
		});

		$app->patch("/stylists/updated", function() use ($app)
		{
				$stylist_to_edit = Stylist::find($_POST['current_stylistId']);
				$stylist_to_edit->update($_POST['name']);
				return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
		});

		$app->delete("/stylists/{id}/delete", function($id) use ($app)
		{
				$stylist = Stylist::find($id);
				$stylist->delete();
				return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll(), 'form' => false));
		});

		// Specific stylist pages (show clients)
		$app->get("/stylist/{id}", function($id) use ($app)
		{
				$stylist = Stylist::find($id);
				return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients(), 'form' => false));
		});

		$app->post("/clients", function() use ($app)
		{
				$client = new Client($_POST['name'], $_POST['phone_number'], $_POST['stylist_id']);
				$client->save();
				$stylist = Stylist::find($_POST['stylist_id']);
				return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
		});

		$app->get("/client/{cid}/{rid}/edit_form", function($cid, $rid) use ($app)
		{
				$current_client = Client::find($rid);
				$stylist = Stylist::find($cid);
				return $app['twig']->render('stylist.html.twig', array('current_client' => $current_client, 'stylist' => $stylist, 'clients' => $stylist->getClients(), 'form' => true));
		});

		$app->patch("/clients/updated", function() use ($app)
		{
				$client_to_edit = Client::find($_POST['current_clientId']);
				$client_to_edit->update($_POST['name']);
				$stylist = Stylist::find($_POST['stylist_id']);
				return $app['twig']->render('stylist.html.twig', array('clients' => $stylist->getClients(), 'stylist' => $stylist));
		});

		$app->delete("/clients/{stylist_id}/{client_id}/delete", function($stylist_id, $client_id) use ($app)
		{
				$client = Client::find($client_id);
				$client->delete();
				$stylist = Stylist::find($stylist_id);
				return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
		});

		return $app;
?>

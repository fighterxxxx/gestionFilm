<?php
namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
	    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }
	
    public function handle(Request $request, AccessDeniedException $accessDeniedException)
    {
        // ...
//var_dump('oooooooooooooo');
//exit();

//return $this->render('config/Noaccees.html.twig');
        //return new Response($content, 403);
		   $url = $this->router->generate('accessDenied');
		       return new RedirectResponse($url);
    }
}
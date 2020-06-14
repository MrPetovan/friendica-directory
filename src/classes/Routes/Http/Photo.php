<?php

namespace Friendica\Directory\Routes\Http;

/**
 * @author Hypolite Petovan <hypolite@mrpetovan.com>
 */
class Photo extends BaseRoute
{
	public function __invoke(\Slim\Http\Request $request, \Slim\Http\Response $response, array $args): \Slim\Http\Response
	{
		return (new \Friendica\Directory\Controllers\Api\Photo(
			$this->container->atlas
		))->render($request, $response, $args);
	}
}

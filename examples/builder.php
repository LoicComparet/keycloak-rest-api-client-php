<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

$builder = new \Fschmtt\Keycloak\Builder();

$grantType = new \Fschmtt\Keycloak\OAuth\GrantType\PasswordGrant(
    clientId: 'admin-cli',
    username: 'admin',
    password: 'admin',
);

$keycloak = $builder->withGrantType($grantType)
    ->withBaseUri($_SERVER['KEYCLOAK_BASE_URL'] ?? 'http://keycloak:8080')
    ->withTokenStorage(new \Fschmtt\Keycloak\OAuth\TokenStorage\Filesystem(__DIR__ . '/..'))
    ->build();

var_dump($keycloak->realms()->get('master'));


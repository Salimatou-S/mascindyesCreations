<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};

// contrôleur frontal: fichier d'entrée de notre application, toute requête va passer par ce fichier avant de continuer. Il réceptionne donc toutes les requêtes qui arrivent à notre application et renvoie la réponse adéquate au client.
<?php

use Leuz\JitsiBundle\DependencyInjection\JitsiExtension;
use Leuz\JitsiBundle\Entity\Features;
use Leuz\JitsiBundle\Entity\Payload;
use Leuz\JitsiBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerBuilder;
require_once __DIR__ . '/../vendor/autoload.php';

$configs = [['api_key'=>'vpaas-magic-cookie-3b3fbcd75def45c3928b8f7f9ff902a5/7ea96e', 'app_id'=>'vpaas-magic-cookie-3b3fbcd75def45c3928b8f7f9ff902a5']];

$container = new ContainerBuilder();
$extension = new JitsiExtension();
$extension->load($configs, $container);
$container->compile();

$user = (new User())
        ->setIsModerator(true)
        ->setEmail("eldji22@hotmail.fr")
        ->setAvatarURL("")
        ->setName("Kya")
        ->setId("b2c94a50-e53b-4afc-8bef-3132f3ec27dc");

$features = (new Features())
        ->setIsLiveStreaming(true)
        ->setIsRecording(true)
        ->setIsOutboundCall(true)
        ->setIsTranscription(true);

$payload = (new Payload())
        ->setExp(7200)
        ->setNBF(10);

$jitsi = $container->get('jitsi');
$token = $jitsi->buildToken($user, $features, $payload);
echo "The jitsi token is '$token'\n";
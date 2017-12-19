<?php

namespace Janborg\AmznPai\ContaoManager;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Janborg\AmznPai\JanborgAmznPaiBundle;
use Contao\CoreBundle\ContaoCoreBundle;

class Plugin implements BundlePluginInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function getBundles(ParserInterface $parser)
	{
		return [
			BundleConfig::create(JanborgAmznPaiBundle::class)
				->setLoadAfter(['Contao\CoreBundle\ContaoCoreBundle',
							'Contao\ContaoManager\ContaoManagerBundle',])
		];
	}
}

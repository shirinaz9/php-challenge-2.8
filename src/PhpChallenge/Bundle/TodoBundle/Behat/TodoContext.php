<?php
namespace PhpChallenge\Bundle\TodoBundle\Behat;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Mink\Driver\BrowserKitDriver;
use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Client;

class TodoContext extends RawMinkContext implements KernelAwareContext, Context, SnippetAcceptingContext
{
    use KernelDictionary;

    static $purgers = [];
    protected $serverParameters = [];

    /**
     * @Given I set header :header to :headerValue
     */
    public function iSetHeaderValue($header, $headerValue)
    {
        $this->serverParameters[$header] = $headerValue;
    }

    /**
     * Sends a HTTP request
     *
     * @When I send :method request to :path
     */
    public function iSendARequestTo($method, $path, $content = null)
    {
        /** @var BrowserKitDriver $driver */
        $driver = $this->getSession()->getDriver();

        /** @var Client $client */
        $client = $driver->getClient();

        // intercept redirection
        $client->followRedirects(false);

        $client->request(
            $method,
            $this->locatePath($path),
            [],
            [],
            $this->serverParameters,
            $content
        );

        $client->followRedirects(true);

        return $this->getSession()->getPage();
    }

    /**
     * Get service by id.
     *
     * @param string $id
     *
     * @return object
     */
    protected function getService($id)
    {
        $this->getKernel()->boot();
        return $this->getContainer()->get($id);
    }

    /**
     * Empty database.
     *
     * @database
     * @Given empty database
     */
    public function emptyDatabase()
    {
        /** @var EntityManager $em */
        $em = $this->getService('doctrine')->getManager();
        $em->getConnection()->query('SET foreign_key_checks = 0;');
        $purger = new ORMPurger($em);
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $purger->purge();
        $em->getConnection()->query('SET foreign_key_checks = 1;');
    }

}

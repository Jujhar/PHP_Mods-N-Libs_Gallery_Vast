<?php
namespace Tests\AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{

    // Generic test to see if page loads
    public function testLoad()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/item?name=Faker');
        $result = $crawler->filter('html:contains("Generates fake addresses, names, text and more")')->count();
        $expected = 0;
        $this->assertGreaterThan($expected, $result);

    }

    // Another simple test to see if page loads
    public function testLoad2()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/all');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    // Check if list is returning data
    public function testModuleListRetrieval()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/all');
        $result = $crawler->filter('li')->count();
        $expected = 3;
        $this->assertGreaterThan($expected, $result);
    }

    // Traversing and other asserts

    // $crawler->filter('h1') look for h1 tag
    // $crawler->filter('h1')->eq(0)->text(); first item
    // $this->assertRegExp('/from the Basics/', $p1Text);
    // $p1 = $crawler->filter('p')->first; first item
    // $p1->siblings()->eq(1); // can use children as well
    // $crawler->filterXpath('//p')->last(); // get last paragraph

    // $this->assertEquals
    // $this->assertNotEmpty(array("sdf","dsfd"));
    // $this->assertFalse($client->getResponse()->isSuccessful());
    // $this->assertTrue($client->getResponse()->isSuccessful());
    // $this->assertNotNull();
    // $this->assertRegExp('');
    // $this->assertFalse(
    //    $client->getResponse()->headers->contains(
    //    'Client-Type',
    //    'application/json'
    // )

    // Notes
    // phpunit -c app // config file load from app
    // phpunit -c app/ bundle --coverage-html=misc/
}
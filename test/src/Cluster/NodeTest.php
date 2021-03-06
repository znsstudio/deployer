<?php
/* (c) Anton Medvedev <anton@medv.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Deployer\Cluster;

use Deployer\Console\Application;
use Deployer\Deployer;
use PHPUnit\Framework\TestCase;

/**
 * @author Irfan Durmus (http://github.com/irfan) <irfandurmus@gmail.com>
 * @property Deployer $deployer
 */
class NodeTest extends TestCase
{
    /**
     * @var Deployer $deployer
     */
    protected $deployer = null;

    /**
     * setup
     */
    public function setUp()
    {
        $app = new Application();
        $input = $this->createMock('Symfony\Component\Console\Input\InputInterface');
        $output = $this->createMock('Symfony\Component\Console\Output\OutputInterface');

        $this->deployer = new Deployer($app, $input, $output);
    }

    /**
     * destroy
     */
    public function tearDown()
    {
        unset($this->deployer);
    }

    /**
     * test the initialize method
     */
    public function testInitialize()
    {
        $node = new Node();
        $node->setDeployer($this->deployer)
            ->setName('myClusterNode')
            ->setHost('domain.com')
            ->setPort(22)
            ->initialize();

        $this->assertInstanceOf('Deployer\Server\ServerInterface', $node->getServer());
        $this->assertInstanceOf('Deployer\Server\Builder', $node->getBuilder());
    }
}

<?php
require 'src/Collection.php';

class CollectionTest extends PHPUnit\Framework\TestCase
{
    /**
     * @var Collection
     */
    private $emptyCollection;
    /**
     * @var Collection
     */
    private $oneCollection;
    /**
     * @var Collection
     */
    private $manyCollection;

    public function setUp()
    {
        $this->emptyCollection = new Collection();
        $this->oneCollection = new Collection();
        $this->oneCollection->add('1');
        $this->manyCollection = new Collection();
        $this->manyCollection->add('1');
        $this->manyCollection->add('two');
        $this->manyCollection->add(3);
    }

    public function testIsEmpty()
    {
        $this->assertTrue($this->emptyCollection->isEmpty());
        $this->assertFalse($this->oneCollection->isEmpty());
        $this->assertFalse($this->manyCollection->isEmpty());
    }

    public function testSize()
    {
        $this->assertEquals(0, $this->emptyCollection->size());
        $this->assertEquals(1, $this->oneCollection->size());
        $this->assertEquals(3, $this->manyCollection->size());
    }

    public function testAdd()
    {
        $collection = new Collection();

        $this->assertEquals(0, $collection->size());

        $collection->add('first item');
        $this->assertEquals(1, $collection->size());

        $collection->add('another item');
        $this->assertEquals(2, $collection->size());
    }

    public function testContains()
    {
        $collection = new Collection();
        $collection->add('foo');
        $collection->add('bar');

        $this->assertTrue($collection->contains('foo'));
        $this->assertTrue($collection->contains('bar'));
        $this->assertFalse($collection->contains('baz'));
    }

    public function testRemove()
    {
        $collection = new Collection();
        $collection->add(1);
        $collection->add(2);

        $this->assertEquals(2, $collection->size());

        $collection->remove(1);
        $this->assertEquals(1, $collection->size());
        $this->assertTrue($collection->contains(2));

        $collection->remove(2);
        $this->assertEquals(0, $collection->size());
    }
}

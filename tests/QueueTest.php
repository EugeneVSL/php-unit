<?php

use PHPUnit\Framework\TestCase;
use SebastianBergmann\Type\VoidType;

class QueueTest extends TestCase
{
    protected static $queue;

    protected function setUp(): void
    {
        // $this->queue = new Queue;
        self::$queue->clear();
    }

    public static function setUpBeforeClass(): void
    {
        self::$queue = new Queue;
    }

    public static function tearDownAfterClass(): void
    {
        self::$queue = null;
    }

    public function testNewQueueIsEmpty()
    {
        $this->assertEquals(0, self::$queue->getCount());
    }

    public function testAnItemWasAddedTotheQueue()
    {
        self::$queue->push('green');
        $this->assertEquals(1, self::$queue->getCount());
    }

    public function testRemoveItemFromtheQueue()
    {
        self::$queue->push('green');
        $removedItem = self::$queue->pop();

        $this->assertEquals(0, self::$queue->getCount());
        $this->assertEquals('green' , $removedItem);
    }

    public function testItemIsRemovedFromtTheFrontOfTheQueue() 
    {
        self::$queue->push('first');
        self::$queue->push('second');

        $this->assertEquals('first', self::$queue->pop());
    }

    public function testMaxNumberOfItemsCanBeAdded()
    {

        for ($i = 0; $i < Queue::MAX_ITEMS; $i++) {

            self::$queue->push($i);
        }

        return $this->assertEquals(Queue::MAX_ITEMS, self::$queue->getCount());
    }
    
    
    public function testExceptionThrownWhenAddingAnItemToFullQueue() 
    {
        for ($i = 0; $i < Queue::MAX_ITEMS; $i++) {

            self::$queue->push($i);
        }

        $this->expectException(QueueException::class);
        $this->expectExceptionMessage('Queue is full.');

        self::$queue->push("new item");
    }

}
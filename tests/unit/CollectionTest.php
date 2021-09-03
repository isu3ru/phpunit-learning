<?php

use App\Support\Collection;
use PHPUnit\Framework\TestCase;

/**
 * CollectionTest
 */
class CollectionTest extends TestCase
{
    /** @test */
    public function empty_collection_returns_no_items()
    {
         $collection = new \App\Support\Collection;

         $this->assertEmpty($collection->all());
    }

    /** @test */
    public function count_is_correct()
    {
        $collection = new Collection([
            'one', 'two', 'three'
        ]);

        $this->assertEquals(3, $collection->count());

        $this->assertEquals('one', $collection->get(0));
    }

    /** @test */
    public function isEmpty_on_empty_collection_returns_true()
    {
        $collection = new Collection();

        $this->assertEquals(true, $collection->isEmpty());
    }
    
    /** @test */
    public function isEmpty_on_filled_collection_returns_false()
    {
        $collection = new Collection([
            1, 2, 3,
        ]);

        $this->assertEquals(false, $collection->isEmpty());
    }

    /** @test */
    public function collection_is_an_iteration_instance()
    {
        $collection = new Collection();

        $this->assertInstanceOf(IteratorAggregate::class, $collection);
    }

    /** @test */
    public function collection_can_be_iterated()
    {
        $collection = new Collection([
            'one', 'two', 'three'
        ]);

        $items = [];

        foreach($collection as $item) {
            $items[] = $item;
        }

        $this->assertCount(3, $items);

        $this->assertInstanceOf(ArrayIterator::class, $collection->getIterator());
    }
    

    /** @test */
    public function collection_can_be_merged_with_another_collection()
    {
        $collection1 = new Collection([
            'one', 'two', 'three',
        ]);

        $collection2 = new Collection([
            'four', 'five', 'six',
        ]);

        $collection1->merge($collection2);

        $this->assertCount(6, $collection1);
    }

    /** @test */
    public function items_are_added_to_collection_correctly()
    {
        $collection1 = new Collection([
            'one', 'two', 'three',
        ]);

        $collection1->add(['four', 'five']);

        $this->assertCount(5, $collection1);
    }
    
    /** @test */
    public function item_can_be_removed_from_collection_correctly()
    {
        $collection = new Collection([
            'one', 'two', 'three',
        ]);
        
        $collection->remove(2);

        $this->assertCount(2, $collection);
    }
    
    /** @test */
    public function returns_json_encoded_items_correctly()
    {
        $collection = new Collection([
            ['username' => 'isu3ru'],
            ['username' => 'isuru'],
        ]);
 
        $this->assertIsString($collection->toJson());
        $this->assertEquals('[{"username":"isu3ru"},{"username":"isuru"}]', $collection->toJson());
    }
    
    /** @test */
    public function collection_encoded_to_json_returns_json()
    {
        $collection = new Collection([
            ['username' => 'isu3ru'],
            ['username' => 'isuru'],
        ]);
 
        $json = json_encode($collection);

        $this->assertIsString($json);
        $this->assertEquals('[{"username":"isu3ru"},{"username":"isuru"}]', $json);
    }
    
}

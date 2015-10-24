<?php



class CategoryTest extends TestCase
{
    public function testController()
    {
        $this->call('GET', 'categories');
        
        $this->assertViewHas('categories');
    }
}

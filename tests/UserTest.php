<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    public function testReturnFullName()
    {

        $user = new User();

        $user->first_name = 'John';
        $user->last_name = 'Doe';

        $this->assertEquals('John Doe', $user->getFullName());
    }

    public function testFullNameIsEmptyByDefault()
    {
        
        $user = new User();

        $this->assertEquals('', $user->getFullName());
    }
}
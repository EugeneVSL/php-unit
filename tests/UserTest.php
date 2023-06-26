<?php

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\once;

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

    public function testNotificationIsSent()
    {

        $user = new User;
        $mock_mailer = $this->createMock(Mailer::class);

        $mock_mailer->expects($this->once())
                    ->method('sendMessage')
                    ->with($this->equalTo('dave@example.com'), $this->equalTo('Test'))
                    ->willReturn(true);
        
        $user->setMailer($mock_mailer);
        $user->email = 'dave@example.com';

        $this->assertTrue($user->notify('Test'));
    }

    public function testCannotNotifyUserWithNoEmailt()
    {

        $user = new User;
        $mock_mailer = $this->createMock(Mailer::class);

        $this->expectException(Exception::class);
        $user->notify("Hello");
    }
}
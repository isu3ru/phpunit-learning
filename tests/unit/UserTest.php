<?php

use PHPUnit\Framework\TestCase;

/**
 * UserTest
 */
class UserTest extends TestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
    
        $this->user = new \App\Models\User;

        $this->user->setFirstName('Isuru');
        $this->user->setLastName('Ranawaka');
        $this->user->setEmailAddress('isuru@mybooking.lk');
    }

    /** @test */
    public function that_we_can_get_first_name()
    {
        $this->assertEquals($this->user->getFirstName(), 'Isuru');
    }

    /** @test */
    public function that_we_can_get_last_name()
    {
        $this->assertEquals($this->user->getLastName(), 'Ranawaka');
    }

    /** @test */
    public function full_name_is_returned()
    {
        $this->assertEquals($this->user->getFullName(), 'Isuru Ranawaka');
    }
    
    /** @test */
    public function first_and_last_names_are_trimmed()
    {
        $this->assertEquals($this->user->getFirstName(), 'Isuru');
        $this->assertEquals($this->user->getLastName(), 'Ranawaka');
    }
    
    /** @test */
    public function email_adress_can_be_set()
    {
        $this->assertEquals($this->user->getEmailAddress(), 'isuru@mybooking.lk');
    }
    
    /** @test */
    public function email_variables_contain_values_correctly()
    {
        $emailVariables = $this->user->getEmailVariables();

        $this->assertArrayHasKey('full_name', $emailVariables);
        $this->assertArrayHasKey('email_address', $emailVariables);

        $this->assertEquals($emailVariables['full_name'], 'Isuru Ranawaka');
        $this->assertEquals($emailVariables['email_address'], 'isuru@mybooking.lk');
    }
    

}

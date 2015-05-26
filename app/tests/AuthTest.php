<?php

class AuthTest extends TestCase {

    public function testLoginOk()
    {
        $response = $this->action('POST','AuthController@login',array('email' => 'test@example.com','password' => 'test'));
        $this->assertResponseOk();
    }

    public function testLoginEmailRequired()
    {
        $response = $this->action('POST','AuthController@login',array('password' => 'bouyalol'));
        $this->assertEquals(json_decode($response->getContent())->flash,"Login field is required.");
    }

    public function testLoginPasswordRequired()
    {
        $response = $this->action('POST','AuthController@login',array('email' => 'e@mail.com'));
        $this->assertEquals(json_decode($response->getContent())->flash,"Password field is required.");
    }

    public function testLoginBadPassword()
    {
        $response = $this->action('POST','AuthController@login',array('email' => 'test@example.com','password' => 'badpassword'));
        $this->assertEquals(json_decode($response->getContent())->flash,"Wrong password, try again.");
    }

    public function testLoginUserNotFound()
    {
        $response = $this->action('POST','AuthController@login',array('email' => 'not@found.com','password' => 'pass'));
        $this->assertEquals(json_decode($response->getContent())->flash,"User was not found.");
    }
}
?>

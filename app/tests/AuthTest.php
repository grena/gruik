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
        $this->assertEquals("Login field is required.", json_decode($response->getContent())->flash);
    }

    public function testLoginPasswordRequired()
    {
        $response = $this->action('POST','AuthController@login',array('email' => 'e@mail.com'));
        $this->assertEquals("Password field is required.", json_decode($response->getContent())->flash);
    }

    public function testLoginBadPassword()
    {
        $response = $this->action('POST','AuthController@login',array('email' => 'test@example.com','password' => 'badpassword'));
        $this->assertEquals("Wrong password, try again.", json_decode($response->getContent())->flash);
    }

    public function testLoginUserNotFound()
    {
        $response = $this->action('POST','AuthController@login',array('email' => 'not@found.com','password' => 'pass'));
        $this->assertEquals(json_decode($response->getContent())->flash,"User was not found.");
        $this->assertEquals("User was not found.", json_decode($response->getContent())->flash);
    }

    public function testRegisterEmailRequired()
    {
        $response = $this->action('POST', 'AuthController@register', array('username' => 'exampleuser', 'password' => 'pass'));
        $this->assertEquals("The email field is required.", json_decode($response->getContent())->flash);
    }

    public function testRegisterLoginRequired()
    {
        $response = $this->action('POST', 'AuthController@register', array('email' => 'example@email.com', 'password' => 'pass'));
        $this->assertEquals("The username field is required.", json_decode($response->getContent())->flash);
    }

    public function testRegisterPasswordRequired()
    {
        $response = $this->action('POST', 'AuthController@register', array('email' => 'example@email.com', 'username' => 'exampleuser'));
        $this->assertEquals("The password field is required.", json_decode($response->getContent())->flash);
    }

    public function testRegisterEmailAlreadyTaken()
    {
        $response = $this->action('POST', 'AuthController@register', array('email' => 'test@example.com', 'username' => 'exampleuser', 'password' => 'pass'));
        $this->assertEquals("The email has already been taken.", json_decode($response->getContent())->flash);
    }

    public function testRegisterUsernameAlreadyTaken()
    {
        $response = $this->action('POST', 'AuthController@register', array('email' => 'example@email.com', 'username' => 'test', 'password' => 'pass')); 
        $this->assertEquals("The username has already been taken.", json_decode($response->getContent())->flash);
    }

    public function testRegisterOk()
    {
        $response = $this->action('POST', 'AuthController@register', array('email' => 'example@email.com', 'username' => 'example', 'password' => 'pass'));
        $this->assertResponseOk();
    }
}
?>

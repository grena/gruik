<?php

class ApiTest extends TestCase {

    public function testLogin() 
    {
        $response = $this->action('GET','AuthController@login',array('email' => 'test@example.com','password' => 'test'));
        // $this->assertEquals(200,$response->getStatusCode());
        $this->assertResponseStatus(200);
    }

    public function testEmailRequired()
    {
        $response = $this->action('GET','AuthController@login',array('email' => 'not@found.com'));
        $this->assertResponseStatus(400);
    }

    public function testLoginFail()
    {
        $response = $this->action('GET','AuthController@login',array('email' => 'test@example.com','password' => 'badpassword'));
        $this->assertResponseStatus(400);
    }
}
?>

<?php
require_once dirname (__FILE__) . '/../testHelper.php';

class ConfigurationTest extends PHPUnit_Framework_TestCase {
	public function testDefaults () {
    $_ENV['BOLETOSIMPLES_ENV'] = null;
    $_ENV['BOLETOSIMPLES_APP_ID'] = null;
    $_ENV['BOLETOSIMPLES_APP_SECRET'] = null;
    $_ENV['BOLETOSIMPLES_ACCESS_TOKEN'] = null;
    $this->subject = new BoletoSimples\Configuration();
    $this->assertEquals ($this->subject->environment, 'sandbox');
    $this->assertNull ($this->subject->application_id);
    $this->assertNull ($this->subject->application_secret);
    $this->assertNull ($this->subject->access_token);
    $this->assertEquals ($this->subject->baseUri(), 'https://sandbox.boletosimples.com.br/api/v1');
    $this->assertFalse ($this->subject->hasAccessToken());
	}
  public function testUserAgent() {
    $this->subject = new BoletoSimples\Configuration();
    $this->assertEquals ($this->subject->userAgent(), "BoletoSimples PHP Client v0.0.1 (contato@boletosimples.com.br)");
  }
  public function testEnvironmentVariables() {
    $_ENV['BOLETOSIMPLES_ENV'] = 'production';
    $_ENV['BOLETOSIMPLES_APP_ID'] = 'app-id';
    $_ENV['BOLETOSIMPLES_APP_SECRET'] = 'app-secret';
    $_ENV['BOLETOSIMPLES_ACCESS_TOKEN'] = 'access-token';
    $this->subject = new BoletoSimples\Configuration();
    $this->assertEquals ($this->subject->environment, 'production');
    $this->assertEquals ($this->subject->application_id, 'app-id');
    $this->assertEquals ($this->subject->application_secret, 'app-secret');
    $this->assertEquals ($this->subject->access_token, 'access-token');
    $this->assertEquals ($this->subject->baseUri(), 'https://boletosimples.com.br/api/v1');
    $this->assertTrue ($this->subject->hasAccessToken());
  }
  public function testConfiguration() {
    BoletoSimples::configure([
      "environment" => 'production',
      "application_id" => 'app-id',
      "application_secret" => 'app-secret',
      "access_token" => 'access-token'
    ]);
    $this->subject = BoletoSimples::$configuration;
    $this->assertEquals ($this->subject->environment, 'production');
    $this->assertEquals ($this->subject->application_id, 'app-id');
    $this->assertEquals ($this->subject->application_secret, 'app-secret');
    $this->assertEquals ($this->subject->access_token, 'access-token');
    $this->assertEquals ($this->subject->baseUri(), 'https://boletosimples.com.br/api/v1');
    $this->assertTrue ($this->subject->hasAccessToken());
  }
}

?>
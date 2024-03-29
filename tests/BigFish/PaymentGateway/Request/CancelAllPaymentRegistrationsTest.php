<?php

namespace BigFish\Tests\PaymentGateway\Request;


use BigFish\PaymentGateway;
use BigFish\PaymentGateway\Request\CancelAllPaymentRegistrations;
use BigFish\PaymentGateway\Request\RequestInterface;

class CancelAllPaymentRegistrationsTest extends SimpleTransactionRequestAbstract
{

	protected function getRequest(string $transactionId): RequestInterface
	{
		return (new CancelAllPaymentRegistrations())->setProviderName(PaymentGateway::PROVIDER_BORGUN2)->setUserId('14741');
	}

	protected function getDataKeys(): array
	{
		return array(
			'providerName' => PaymentGateway::PROVIDER_BORGUN2,
			'userId' => '14741'
		);
	}

	/**
	 * @test
	 * @dataProvider dataProviderFor_parameterTest
	 * @param $testData
	 * @param $method
	 */
	public function parameterSetTest($testData, $method)
	{
		$init = $this->getRequest('transactionId');
		$result = $init->$method($testData);

		$variableName = lcfirst(substr($method, 3));

		// test chain
		$this->assertInstanceOf(get_class($init), $result);
		$this->assertArrayHasKey($variableName, $init->getData());
		$this->assertEquals($testData, $init->getData()[$variableName]);
	}

	/**
	 * @return array
	 */
	public function dataProviderFor_parameterTest()
	{
		return array(
			array('TestStore', 'setStoreName'),
		);
	}
}
